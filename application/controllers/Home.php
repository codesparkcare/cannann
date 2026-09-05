<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Settings_model');
        $this->load->model('Slider_model');
        $this->load->model('Room_model');
        $this->load->model('Facility_model');
        $this->load->model('Restaurant_model');
        $this->load->model('Blog_model');
        $this->load->model('Gallery_model');
        $this->load->model('Promotion_model');
        $this->load->model('Booking_model');
        $this->load->model('Contact_model');
        $this->load->model('Testimonial_model');
    }

    private function get_common_data($page_title = '', $meta_title = '', $meta_desc = '', $meta_keywords = '') {
        $settings = $this->Settings_model->get_settings();
        $data['settings'] = $settings;
        $data['page_title'] = $page_title ? $page_title . ' | ' . ($settings['hotel_name'] ?? 'Grand Cannann') : ($settings['meta_title'] ?? 'Grand Cannann | Luxury Hotel & Resort');
        $data['meta_title'] = $meta_title ?: ($settings['meta_title'] ?? 'Grand Cannann Resort');
        $data['meta_desc'] = $meta_desc ?: ($settings['meta_description'] ?? 'Experience luxury stays, fine dining, and coastal serenity.');
        $data['meta_keywords'] = $meta_keywords ?: ($settings['meta_keywords'] ?? 'hotel, resort, luxury stay, suites, restaurant');
        $data['room_categories'] = $this->Room_model->get_active_categories();
        return $data;
    }

    private function should_show_opening_page($settings) {
        if (!empty($settings['is_opening_enabled']) && $settings['is_opening_enabled'] == 1 && ($settings['opening_mode'] ?? 'countdown_page') === 'countdown_page') {
            $is_admin = $this->session->userdata('admin_logged_in');
            $admin_preview_full = $this->session->userdata('admin_preview_full_site');
            if ($is_admin && $admin_preview_full) {
                return false;
            }
            return true;
        }
        return false;
    }

    public function preview_full_site() {
        if ($this->session->userdata('admin_logged_in')) {
            $this->session->set_userdata('admin_preview_full_site', TRUE);
        }
        redirect('');
    }

    public function preview_opening_page() {
        if ($this->session->userdata('admin_logged_in')) {
            $this->session->unset_userdata('admin_preview_full_site');
        }
        redirect('');
    }

    public function index() {
        $data = $this->get_common_data('Luxury Boutique Hotel & Resort');
        if ($this->should_show_opening_page($data['settings'])) {
            $this->load->view('frontend/opening_countdown', $data);
            return;
        }

        $data['sliders'] = $this->Slider_model->get_active_sliders();
        $data['featured_rooms'] = $this->Room_model->get_featured_rooms(6);
        $data['facilities'] = $this->Facility_model->get_active_facilities();
        $data['restaurant_categories'] = $this->Restaurant_model->get_active_categories();
        $data['special_dishes'] = $this->Restaurant_model->get_special_items(6);
        $data['promotions'] = $this->Promotion_model->get_active_promotions();
        $data['blogs'] = $this->Blog_model->get_published_blogs(3);
        $data['testimonials'] = $this->Testimonial_model->get_active_testimonials();
        $data['gallery'] = $this->Gallery_model->get_active_gallery();

        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/layout/navbar', $data);
        $this->load->view('frontend/home', $data);
        $this->load->view('frontend/layout/footer', $data);
    }

    public function about() {
        $data = $this->get_common_data('About Our Heritage & Hospitality');
        if ($this->should_show_opening_page($data['settings'])) {
            $this->load->view('frontend/opening_countdown', $data);
            return;
        }

        $data['facilities'] = $this->Facility_model->get_active_facilities();
        $data['testimonials'] = $this->Testimonial_model->get_active_testimonials();

        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/layout/navbar', $data);
        $this->load->view('frontend/about', $data);
        $this->load->view('frontend/layout/footer', $data);
    }

    public function rooms() {
        $data = $this->get_common_data('Rooms & Luxury Suites');
        if ($this->should_show_opening_page($data['settings'])) {
            $this->load->view('frontend/opening_countdown', $data);
            return;
        }

        $category_id = $this->input->get('category');
        $data['rooms'] = $this->Room_model->get_all_rooms($category_id);
        $data['selected_category'] = $category_id;
        $data['categories'] = $this->Room_model->get_active_categories();

        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/layout/navbar', $data);
        $this->load->view('frontend/rooms', $data);
        $this->load->view('frontend/layout/footer', $data);
    }

    public function room_detail($slug = '') {
        if (!$slug) {
            redirect('rooms');
        }
        $room = $this->Room_model->get_room_by_slug($slug);
        if (!$room) {
            show_404();
        }

        $page_title = $room['title'];
        $meta_title = $room['title'] . ' | ' . ($room['category_name'] ?? 'Luxury Suite') . ' - Grand Cannann';
        $meta_desc = substr(strip_tags($room['short_description'] ?: $room['long_description']), 0, 160);
        $meta_keywords = 'room booking, ' . strtolower($room['title']) . ', ' . strtolower($room['category_name'] ?? '') . ', luxury suites';

        $data = $this->get_common_data($page_title, $meta_title, $meta_desc, $meta_keywords);
        if ($this->should_show_opening_page($data['settings'])) {
            $this->load->view('frontend/opening_countdown', $data);
            return;
        }

        $data['room'] = $room;
        $data['related_rooms'] = $this->Room_model->get_related_rooms($room['category_id'], $room['id'], 3);

        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/layout/navbar', $data);
        $this->load->view('frontend/room_detail', $data);
        $this->load->view('frontend/layout/footer', $data);
    }

    public function restaurant() {
        $data = $this->get_common_data('The Sapphire Fine Dining & Bar');
        if ($this->should_show_opening_page($data['settings'])) {
            $this->load->view('frontend/opening_countdown', $data);
            return;
        }

        $data['categories'] = $this->Restaurant_model->get_active_categories();
        $data['all_items'] = $this->Restaurant_model->get_all_items();
        $data['special_items'] = $this->Restaurant_model->get_special_items(8);

        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/layout/navbar', $data);
        $this->load->view('frontend/restaurant', $data);
        $this->load->view('frontend/layout/footer', $data);
    }

    public function facilities() {
        $data = $this->get_common_data('Hotel Facilities & Wellness');
        if ($this->should_show_opening_page($data['settings'])) {
            $this->load->view('frontend/opening_countdown', $data);
            return;
        }

        $data['facilities'] = $this->Facility_model->get_active_facilities();

        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/layout/navbar', $data);
        $this->load->view('frontend/facilities', $data);
        $this->load->view('frontend/layout/footer', $data);
    }

    public function gallery() {
        $data = $this->get_common_data('Photo Gallery & Resort Moments');
        if ($this->should_show_opening_page($data['settings'])) {
            $this->load->view('frontend/opening_countdown', $data);
            return;
        }

        $category = $this->input->get('category');
        $data['gallery'] = $this->Gallery_model->get_active_gallery($category);
        $data['current_category'] = $category ?: 'all';

        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/layout/navbar', $data);
        $this->load->view('frontend/gallery', $data);
        $this->load->view('frontend/layout/footer', $data);
    }

    public function blogs() {
        $data = $this->get_common_data('Tourist Guides, Travel Stories & News');
        if ($this->should_show_opening_page($data['settings'])) {
            $this->load->view('frontend/opening_countdown', $data);
            return;
        }

        $data['blogs'] = $this->Blog_model->get_published_blogs();
        $data['recent_blogs'] = $this->Blog_model->get_recent_blogs(null, 4);

        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/layout/navbar', $data);
        $this->load->view('frontend/blogs', $data);
        $this->load->view('frontend/layout/footer', $data);
    }

    public function blog_detail($slug = '') {
        if (!$slug) {
            redirect('blogs');
        }
        $blog = $this->Blog_model->get_blog_by_slug($slug);
        if (!$blog) {
            show_404();
        }

        // FULL DYNAMIC SEO SETUP
        $page_title = $blog['title'];
        $meta_title = $blog['meta_title'] ?: ($blog['title'] . ' | Grand Cannann Travel Guide');
        $meta_desc = $blog['meta_description'] ?: substr(strip_tags($blog['summary'] ?: $blog['content']), 0, 160);
        $meta_keywords = $blog['meta_keywords'] ?: 'tourist guide, hotel blog, luxury travel, chennai resort attractions';

        $data = $this->get_common_data($page_title, $meta_title, $meta_desc, $meta_keywords);
        if ($this->should_show_opening_page($data['settings'])) {
            $this->load->view('frontend/opening_countdown', $data);
            return;
        }

        $data['blog'] = $blog;
        $data['recent_blogs'] = $this->Blog_model->get_recent_blogs($blog['id'], 3);
        $data['og_image'] = $blog['featured_image'];

        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/layout/navbar', $data);
        $this->load->view('frontend/blog_detail', $data);
        $this->load->view('frontend/layout/footer', $data);
    }

    public function contact() {
        $data = $this->get_common_data('Contact Us & Location');
        if ($this->should_show_opening_page($data['settings'])) {
            $this->load->view('frontend/opening_countdown', $data);
            return;
        }

        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/layout/navbar', $data);
        $this->load->view('frontend/contact', $data);
        $this->load->view('frontend/layout/footer', $data);
    }

    // Booking Submission Handler
    public function book_room() {
        $this->form_validation->set_rules('guest_name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|trim');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim');
        $this->form_validation->set_rules('check_in', 'Check-In Date', 'required|trim');
        $this->form_validation->set_rules('check_out', 'Check-Out Date', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => validation_errors()]);
                return;
            }
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER'] ?? 'rooms');
        }

        $booking_number = 'GC-' . strtoupper(substr(uniqid(), 7, 6));
        $room_id = $this->input->post('room_id') ? intval($this->input->post('room_id')) : null;
        $room_category_id = $this->input->post('room_category_id') ? intval($this->input->post('room_category_id')) : null;

        $total_amount = 0.00;
        if ($room_id) {
            $room = $this->Room_model->get_room($room_id);
            if ($room) {
                $price_per_night = $room['discounted_price'] > 0 ? $room['discounted_price'] : $room['price'];
                $checkin = new DateTime($this->input->post('check_in'));
                $checkout = new DateTime($this->input->post('check_out'));
                $nights = max(1, $checkin->diff($checkout)->days);
                $total_amount = $price_per_night * $nights;
            }
        }

        $data = array(
            'booking_number'   => $booking_number,
            'room_id'          => $room_id,
            'room_category_id' => $room_category_id,
            'check_in'         => $this->input->post('check_in'),
            'check_out'        => $this->input->post('check_out'),
            'adults'           => $this->input->post('adults') ?: 2,
            'children'         => $this->input->post('children') ?: 0,
            'guest_name'       => $this->input->post('guest_name'),
            'email'            => $this->input->post('email'),
            'phone'            => $this->input->post('phone'),
            'total_amount'     => $total_amount,
            'special_requests' => $this->input->post('special_requests'),
            'status'           => 'pending'
        );

        $this->Booking_model->create_booking($data);

        // Send Email notification
        $this->send_notification_email('New Room Booking Request: ' . $booking_number, "
            <h2>New Booking Request Received</h2>
            <p><strong>Booking Ref:</strong> {$booking_number}</p>
            <p><strong>Guest Name:</strong> {$data['guest_name']}</p>
            <p><strong>Email:</strong> {$data['email']}</p>
            <p><strong>Phone:</strong> {$data['phone']}</p>
            <p><strong>Check-In:</strong> {$data['check_in']}</p>
            <p><strong>Check-Out:</strong> {$data['check_out']}</p>
            <p><strong>Estimated Total:</strong> ₹" . number_format($total_amount, 2) . "</p>
            <p><strong>Special Requests:</strong> {$data['special_requests']}</p>
        ", $data['email']);

        if ($this->input->is_ajax_request()) {
            echo json_encode([
                'status' => 'success',
                'booking_number' => $booking_number,
                'message' => "Thank you {$data['guest_name']}! Your reservation request (Ref: #{$booking_number}) has been received. Our team will contact you shortly."
            ]);
            return;
        }

        $this->session->set_flashdata('success', "Booking request #{$booking_number} submitted successfully! We will confirm shortly.");
        redirect($_SERVER['HTTP_REFERER'] ?? 'rooms');
    }

    // Table Reservation Handler
    public function reserve_table() {
        $this->form_validation->set_rules('guest_name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|trim');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim');
        $this->form_validation->set_rules('reservation_date', 'Date', 'required|trim');
        $this->form_validation->set_rules('reservation_time', 'Time', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => validation_errors()]);
                return;
            }
            $this->session->set_flashdata('error', validation_errors());
            redirect('restaurant');
        }

        $data = array(
            'guest_name'       => $this->input->post('guest_name'),
            'email'            => $this->input->post('email'),
            'phone'            => $this->input->post('phone'),
            'reservation_date' => $this->input->post('reservation_date'),
            'reservation_time' => $this->input->post('reservation_time'),
            'guest_count'      => $this->input->post('guest_count') ?: 2,
            'table_preference' => $this->input->post('table_preference') ?: 'Indoor Romantic',
            'special_notes'    => $this->input->post('special_notes'),
            'status'           => 'pending'
        );

        $this->Restaurant_model->add_reservation($data);

        // Send Email
        $this->send_notification_email('New Dining Table Reservation Request', "
            <h2>New Table Reservation at The Sapphire</h2>
            <p><strong>Guest Name:</strong> {$data['guest_name']}</p>
            <p><strong>Email:</strong> {$data['email']}</p>
            <p><strong>Phone:</strong> {$data['phone']}</p>
            <p><strong>Date & Time:</strong> {$data['reservation_date']} at {$data['reservation_time']}</p>
            <p><strong>Guests:</strong> {$data['guest_count']}</p>
            <p><strong>Preference:</strong> {$data['table_preference']}</p>
            <p><strong>Special Notes:</strong> {$data['special_notes']}</p>
        ", $data['email']);

        if ($this->input->is_ajax_request()) {
            echo json_encode([
                'status' => 'success',
                'message' => "Table reservation request for {$data['guest_name']} submitted successfully! We look forward to hosting you."
            ]);
            return;
        }

        $this->session->set_flashdata('success', 'Your table reservation has been received. We will confirm shortly!');
        redirect('restaurant');
    }

    // Contact Submission Handler
    public function submit_contact() {
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|trim');
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim');
        $this->form_validation->set_rules('message', 'Message', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => validation_errors()]);
                return;
            }
            $this->session->set_flashdata('error', validation_errors());
            redirect('contact');
        }

        $data = array(
            'name'    => $this->input->post('name'),
            'email'   => $this->input->post('email'),
            'phone'   => $this->input->post('phone'),
            'subject' => $this->input->post('subject'),
            'message' => $this->input->post('message'),
            'status'  => 'unread'
        );

        $this->Contact_model->add_contact($data);

        // Send Email
        $this->send_notification_email('New Contact Inquiry: ' . $data['subject'], "
            <h2>New Inquiry from Website Contact Page</h2>
            <p><strong>From:</strong> {$data['name']} ({$data['email']})</p>
            <p><strong>Phone:</strong> {$data['phone']}</p>
            <p><strong>Subject:</strong> {$data['subject']}</p>
            <p><strong>Message:</strong></p>
            <p>" . nl2br(htmlspecialchars($data['message'])) . "</p>
        ", $data['email']);

        if ($this->input->is_ajax_request()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Thank you for reaching out! Your message has been sent to our concierge team.'
            ]);
            return;
        }

        $this->session->set_flashdata('success', 'Thank you! Your message has been sent successfully.');
        redirect('contact');
    }

    // SMTP Email Notification helper
    private function send_notification_email($subject, $body_html, $reply_to = null) {
        $settings = $this->Settings_model->get_settings();
        if (empty($settings['smtp_host']) || empty($settings['smtp_user'])) {
            return false;
        }

        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => $settings['smtp_host'],
            'smtp_port' => $settings['smtp_port'] ?: 587,
            'smtp_user' => $settings['smtp_user'],
            'smtp_pass' => $settings['smtp_pass'],
            'smtp_crypto' => $settings['smtp_crypto'] ?: 'tls',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n",
            'wordwrap'  => TRUE
        );

        $this->email->initialize($config);
        $this->email->from($settings['smtp_from_email'] ?: 'noreply@grandcannann.com', $settings['smtp_from_name'] ?: 'Grand Cannann Resort');
        $this->email->to($settings['hotel_email'] ?: 'contact@grandcannann.com');
        if ($reply_to) {
            $this->email->reply_to($reply_to);
        }
        $this->email->subject($subject);
        $this->email->message($body_html);
        return @$this->email->send();
    }
}
