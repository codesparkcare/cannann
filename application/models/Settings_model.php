<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->ensure_opening_columns();
    }

    private function ensure_opening_columns() {
        if ($this->db->table_exists('site_settings')) {
            $fields_to_check = array(
                'is_opening_enabled'  => "ALTER TABLE `site_settings` ADD `is_opening_enabled` TINYINT(1) NOT NULL DEFAULT 0",
                'opening_date'        => "ALTER TABLE `site_settings` ADD `opening_date` DATETIME NULL",
                'opening_mode'        => "ALTER TABLE `site_settings` ADD `opening_mode` VARCHAR(50) NOT NULL DEFAULT 'countdown_page'",
                'opening_title'       => "ALTER TABLE `site_settings` ADD `opening_title` VARCHAR(255) NULL",
                'opening_subtitle'    => "ALTER TABLE `site_settings` ADD `opening_subtitle` TEXT NULL",
                'opening_banner_text' => "ALTER TABLE `site_settings` ADD `opening_banner_text` VARCHAR(255) NULL"
            );

            foreach ($fields_to_check as $col => $sql) {
                if (!$this->db->field_exists($col, 'site_settings')) {
                    @$this->db->query($sql);
                }
            }
        }
    }

    public function get_settings() {
        $query = $this->db->get('site_settings');
        $settings = $query ? $query->row_array() : array();
        if (!empty($settings)) {
            if (empty($settings['opening_date'])) {
                $settings['opening_date'] = '2026-09-12 09:00:00';
            }
            if (empty($settings['opening_title'])) {
                $settings['opening_title'] = 'Grand Opening — September 12, 2026';
            }
            if (empty($settings['opening_subtitle'])) {
                $settings['opening_subtitle'] = 'A new sanctuary of coastal luxury, bespoke suites, and Michelin-inspired culinary artistry arrives soon in Nagercoil.';
            } else {
                $settings['opening_subtitle'] = str_ireplace('Chennai', 'Nagercoil', $settings['opening_subtitle']);
            }
            if (empty($settings['opening_banner_text'])) {
                $settings['opening_banner_text'] = 'Grand Opening on September 12, 2026 — Pre-Bookings Now Open!';
            }
            if (!empty($settings['hotel_address'])) {
                $settings['hotel_address'] = str_ireplace('Chennai', 'Nagercoil', $settings['hotel_address']);
            }
        }
        return $settings;
    }

    public function update_settings($data) {
        $this->db->where('id', 1);
        return $this->db->update('site_settings', $data);
    }
}
