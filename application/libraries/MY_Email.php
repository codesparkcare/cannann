<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Custom MY_Email Library extending CI_Email
 * 
 * Features & Fixes:
 * 1. SSL/TLS Stream Context: Bypasses strict local SSL verification issues (especially on Windows/XAMPP with IP hosts or self-signed certs).
 * 2. Modern TLS Negotiation: Negotiates TLS 1.2 / 1.3 seamlessly.
 * 3. Prevents socket cipher text corruption / garbled binary characters during STARTTLS negotiation.
 * 4. Clear and actionable diagnostic error messaging.
 */
class MY_Email extends CI_Email {

    public function __construct(array $config = array()) {
        parent::__construct($config);
    }

    /**
     * SMTP Connect with enhanced SSL/TLS stream context
     *
     * @return bool
     */
    protected function _smtp_connect()
    {
        if (is_resource($this->_smtp_connect))
        {
            return TRUE;
        }

        $ssl = ($this->smtp_crypto === 'ssl') ? 'ssl://' : '';

        // Configure SSL stream context
        $context_options = array(
            'ssl' => array(
                'verify_peer'       => FALSE,
                'verify_peer_name'  => FALSE,
                'allow_self_signed' => TRUE
            )
        );

        $context = stream_context_create($context_options);

        $this->_smtp_connect = @stream_socket_client(
            $ssl . $this->smtp_host . ':' . $this->smtp_port,
            $errno,
            $errstr,
            $this->smtp_timeout,
            STREAM_CLIENT_CONNECT,
            $context
        );

        if ( ! is_resource($this->_smtp_connect))
        {
            $this->_set_error_message('lang:email_smtp_error', $errno . ' ' . $errstr);
            return FALSE;
        }

        stream_set_timeout($this->_smtp_connect, $this->smtp_timeout);
        $this->_set_error_message($this->_get_smtp_data());

        if ($this->smtp_crypto === 'tls')
        {
            if ( ! $this->_send_command('hello'))
            {
                return FALSE;
            }

            if ( ! $this->_send_command('starttls'))
            {
                return FALSE;
            }

            $method = STREAM_CRYPTO_METHOD_TLS_CLIENT;
            if (defined('STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT')) {
                $method |= STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT;
            }
            if (defined('STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT')) {
                $method |= STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT;
            }

            $crypto = @stream_socket_enable_crypto($this->_smtp_connect, TRUE, $method);

            if ($crypto !== TRUE)
            {
                $this->_set_error_message('SMTP TLS handshake failed. Please verify that your SMTP server supports TLS on port ' . $this->smtp_port);
                return FALSE;
            }
        }

        return $this->_send_command('hello');
    }

    /**
     * Override _set_error_message for safe fallback outside CI controller context
     *
     * @param string $msg
     * @param string $val
     * @return void
     */
    protected function _set_error_message($msg, $val = '')
    {
        // Filter out unprintable binary/control characters from raw socket buffer errors
        $clean_msg = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F-\xFF]/', '', (string)$msg);
        $clean_val = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F-\xFF]/', '', (string)$val);

        if (function_exists('get_instance'))
        {
            $CI =& get_instance();
            if (isset($CI->lang))
            {
                $CI->lang->load('email');
                if (sscanf($clean_msg, 'lang:%s', $line) === 1 && FALSE !== ($line = $CI->lang->line($line)))
                {
                    $this->_debug_msg[] = str_replace('%s', $clean_val, $line) . '<br />';
                    return;
                }
            }
        }

        $this->_debug_msg[] = str_replace('%s', $clean_val, $clean_msg) . '<br />';
    }
}
