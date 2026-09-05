<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Sync_model');
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
        $this->load->library('upload');

        $current_method = $this->router->fetch_method();
        $exempt_methods = array('login', 'logout');

        if (!in_array($current_method, $exempt_methods)) {
            if (!$this->session->userdata('admin_logged_in')) {
                redirect('admin/login');
            }
        }
    }

    private function handle_file_upload($field_name, $sub_folder = '') {
        if (!empty($_FILES[$field_name]['name'])) {
            $config['upload_path']   = './uploads/' . ($sub_folder ? $sub_folder . '/' : '');
            $config['allowed_types'] = 'gif|jpg|png|jpeg|webp|svg|ico';
            $config['max_size']      = 5120; // 5MB
            $config['encrypt_name']  = TRUE;

            $this->upload->initialize($config);

            if ($this->upload->do_upload($field_name)) {
                $data = $this->upload->data();
                $full_path = $data['full_path'];
                if ($data['file_ext'] === '.png' && function_exists('imagecreatefrompng')) {
                    $this->trim_png_whitespace($full_path);
                }
                return base_url('uploads/' . ($sub_folder ? $sub_folder . '/' : '') . $data['file_name']);
            }
        }
        return false;
    }

    private function trim_png_whitespace($file_path) {
        if (!file_exists($file_path)) return;
        $im = @imagecreatefrompng($file_path);
        if (!$im) return;
        $w = imagesx($im);
        $h = imagesy($im);
        $top = $h; $bottom = 0; $left = $w; $right = 0;
        $has_pixels = false;
        for($x = 0; $x < $w; $x++) {
            for($y = 0; $y < $h; $y++) {
                $rgba = imagecolorat($im, $x, $y);
                $alpha = ($rgba >> 24) & 0x7F;
                if ($alpha < 120) {
                    if ($x < $left) $left = $x;
                    if ($x > $right) $right = $x;
                    if ($y < $top) $top = $y;
                    if ($y > $bottom) $bottom = $y;
                    $has_pixels = true;
                }
            }
        }
        if ($has_pixels && ($left > 10 || $top > 10 || ($w - 1 - $right) > 10 || ($h - 1 - $bottom) > 10)) {
            $pad = 6;
            $left = max(0, $left - $pad);
            $top = max(0, $top - $pad);
            $right = min($w - 1, $right + $pad);
            $bottom = min($h - 1, $bottom + $pad);
            $crop_w = $right - $left + 1;
            $crop_h = $bottom - $top + 1;
            $cropped = imagecreatetruecolor($crop_w, $crop_h);
            imagealphablending($cropped, false);
            imagesavealpha($cropped, true);
            $transparent = imagecolorallocatealpha($cropped, 255, 255, 255, 127);
            imagefilledrectangle($cropped, 0, 0, $crop_w, $crop_h, $transparent);
            imagecopyresampled($cropped, $im, 0, 0, $left, $top, $crop_w, $crop_h, $crop_w, $crop_h);
            imagepng($cropped, $file_path);
            imagedestroy($cropped);
        }
        imagedestroy($im);
    }

    // AUTHENTICATION
    public function login() {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/index');
        }

        if ($this->input->post()) {
            $username = trim($this->input->post('username', TRUE));
            $password = $this->input->post('password');

            if (!empty($username) && !empty($password)) {
                $user = $this->Admin_model->authenticate($username, $password);
                if ($user) {
                    $session_data = array(
                        'admin_logged_in' => TRUE,
                        'admin_id'        => $user['id'],
                        'admin_username'  => $user['username'],
                        'admin_email'     => $user['email'],
                        'admin_name'      => $user['name'] ?? 'Admin Manager',
                        'admin_role'      => $user['role'] ?? 'superadmin'
                    );
                    $this->session->set_userdata($session_data);
                    $this->session->set_flashdata('success', 'Welcome back, ' . ($user['name'] ?? 'Admin') . '!');
                    redirect('admin/index');
                } else {
                    $this->session->set_flashdata('error', 'Invalid username or password. Please try again.');
                    redirect('admin/login');
                }
            } else {
                $this->session->set_flashdata('error', 'Please provide both username/email and password.');
                redirect('admin/login');
            }
        }

        $data['settings'] = $this->Settings_model->get_settings();
        $this->load->view('admin/login', $data);
    }

    public function logout() {
        $this->session->unset_userdata(array('admin_logged_in', 'admin_id', 'admin_username', 'admin_email', 'admin_name', 'admin_role'));
        $this->session->sess_destroy();
        redirect('admin/login');
    }

    // DASHBOARD
    public function index() {
        $data['total_rooms'] = count($this->Room_model->get_all_rooms());
        $data['total_bookings'] = count($this->Booking_model->get_all_bookings());
        $data['total_reservations'] = count($this->Restaurant_model->get_all_reservations());
        $data['total_blogs'] = count($this->Blog_model->get_all_blogs());
        $data['total_contacts'] = count($this->Contact_model->get_all_contacts());

        $data['recent_bookings'] = array_slice($this->Booking_model->get_all_bookings(), 0, 5);
        $data['recent_reservations'] = array_slice($this->Restaurant_model->get_all_reservations(), 0, 5);
        $data['recent_contacts'] = array_slice($this->Contact_model->get_all_contacts(), 0, 5);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    // ==========================================
    // 1. SLIDERS MANAGEMENT
    // ==========================================
    public function sliders() {
        $data['sliders'] = $this->Slider_model->get_all_sliders();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/sliders', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function add_slider() {
        if ($this->input->post()) {
            $image_url = $this->handle_file_upload('image', 'sliders');
            if (!$image_url) {
                $image_url = $this->input->post('image_url') ?: 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1920&q=85';
            }

            $data = array(
                'title'              => $this->input->post('title'),
                'subtitle'           => $this->input->post('subtitle'),
                'tag'                => $this->input->post('tag') ?: 'LUXURY EXPERIENCE',
                'button_text'        => $this->input->post('button_text') ?: 'Book Your Stay',
                'button_link'        => $this->input->post('button_link') ?: 'rooms',
                'secondary_btn_text' => $this->input->post('secondary_btn_text') ?: 'Explore Suites',
                'secondary_btn_link' => $this->input->post('secondary_btn_link') ?: 'rooms',
                'image'              => $image_url,
                'sort_order'         => (int)$this->input->post('sort_order'),
                'status'             => $this->input->post('status') ?: 'active'
            );
            $this->Slider_model->add_slider($data);
            $this->session->set_flashdata('success', 'Hero slide added successfully!');
            redirect('admin/sliders');
        }
    }

    public function edit_slider() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $uploaded_image = $this->handle_file_upload('image', 'sliders');
            
            $data = array(
                'title'              => $this->input->post('title'),
                'subtitle'           => $this->input->post('subtitle'),
                'tag'                => $this->input->post('tag'),
                'button_text'        => $this->input->post('button_text'),
                'button_link'        => $this->input->post('button_link'),
                'secondary_btn_text' => $this->input->post('secondary_btn_text'),
                'secondary_btn_link' => $this->input->post('secondary_btn_link'),
                'sort_order'         => (int)$this->input->post('sort_order'),
                'status'             => $this->input->post('status')
            );
            if ($uploaded_image) {
                $data['image'] = $uploaded_image;
            } elseif ($this->input->post('image_url')) {
                $data['image'] = $this->input->post('image_url');
            }

            $this->Slider_model->update_slider($id, $data);
            $this->session->set_flashdata('success', 'Slide updated successfully!');
            redirect('admin/sliders');
        }
    }

    public function delete_slider($id) {
        $this->Slider_model->delete_slider($id);
        $this->session->set_flashdata('success', 'Slide deleted successfully!');
        redirect('admin/sliders');
    }

    // ==========================================
    // 2. ROOM CATEGORIES MANAGEMENT
    // ==========================================
    public function room_categories() {
        $data['categories'] = $this->Room_model->get_all_categories();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/room_categories', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function add_category() {
        if ($this->input->post()) {
            $image_url = $this->handle_file_upload('image', 'rooms');
            if (!$image_url) {
                $image_url = $this->input->post('image_url') ?: 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80';
            }
            $slug = url_title($this->input->post('name'), 'dash', TRUE);

            $data = array(
                'name'        => $this->input->post('name'),
                'slug'        => $slug,
                'description' => $this->input->post('description'),
                'badge'       => $this->input->post('badge') ?: 'Popular',
                'image'       => $image_url,
                'status'      => $this->input->post('status') ?: 'active'
            );
            $this->Room_model->add_category($data);
            $this->session->set_flashdata('success', 'Room category created successfully!');
            redirect('admin/room_categories');
        }
    }

    public function edit_category() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $uploaded_image = $this->handle_file_upload('image', 'rooms');
            $slug = url_title($this->input->post('name'), 'dash', TRUE);

            $data = array(
                'name'        => $this->input->post('name'),
                'slug'        => $slug,
                'description' => $this->input->post('description'),
                'badge'       => $this->input->post('badge'),
                'status'      => $this->input->post('status')
            );
            if ($uploaded_image) {
                $data['image'] = $uploaded_image;
            } elseif ($this->input->post('image_url')) {
                $data['image'] = $this->input->post('image_url');
            }

            $this->Room_model->update_category($id, $data);
            $this->session->set_flashdata('success', 'Room category updated successfully!');
            redirect('admin/room_categories');
        }
    }

    public function delete_category($id) {
        $this->Room_model->delete_category($id);
        $this->session->set_flashdata('success', 'Room category deleted successfully!');
        redirect('admin/room_categories');
    }

    // ==========================================
    // 3. ROOMS MANAGEMENT
    // ==========================================
    public function rooms() {
        $data['rooms'] = $this->Room_model->get_all_rooms();
        $data['categories'] = $this->Room_model->get_active_categories();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/rooms', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function add_room() {
        if ($this->input->post()) {
            $image_url = $this->handle_file_upload('featured_image', 'rooms');
            if (!$image_url) {
                $image_url = $this->input->post('featured_image_url') ?: 'https://images.unsplash.com/photo-1591088398332-8a7791972843?auto=format&fit=crop&w=1000&q=85';
            }
            $slug = url_title($this->input->post('title'), 'dash', TRUE);

            $data = array(
                'category_id'       => $this->input->post('category_id'),
                'title'             => $this->input->post('title'),
                'slug'              => $slug,
                'price'             => (float)$this->input->post('price'),
                'discounted_price'  => $this->input->post('discounted_price') ? (float)$this->input->post('discounted_price') : null,
                'max_adults'        => (int)$this->input->post('max_adults') ?: 2,
                'max_children'      => (int)$this->input->post('max_children') ?: 0,
                'bed_type'          => $this->input->post('bed_type') ?: 'King Size Bed',
                'room_size'         => $this->input->post('room_size') ?: '450 sq.ft',
                'view_type'         => $this->input->post('view_type') ?: 'Ocean View',
                'amenities'         => $this->input->post('amenities'),
                'featured_image'    => $image_url,
                'gallery_images'    => $this->input->post('gallery_images') ?: $image_url,
                'short_description' => $this->input->post('short_description'),
                'long_description'  => $this->input->post('long_description'),
                'is_featured'       => $this->input->post('is_featured') ? 1 : 0,
                'status'            => $this->input->post('status') ?: 'available'
            );

            $this->Room_model->add_room($data);
            $this->session->set_flashdata('success', 'Room added successfully!');
            redirect('admin/rooms');
        }
    }

    public function edit_room() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $uploaded_image = $this->handle_file_upload('featured_image', 'rooms');
            $slug = url_title($this->input->post('title'), 'dash', TRUE);

            $data = array(
                'category_id'       => $this->input->post('category_id'),
                'title'             => $this->input->post('title'),
                'slug'              => $slug,
                'price'             => (float)$this->input->post('price'),
                'discounted_price'  => $this->input->post('discounted_price') ? (float)$this->input->post('discounted_price') : null,
                'max_adults'        => (int)$this->input->post('max_adults'),
                'max_children'      => (int)$this->input->post('max_children'),
                'bed_type'          => $this->input->post('bed_type'),
                'room_size'         => $this->input->post('room_size'),
                'view_type'         => $this->input->post('view_type'),
                'amenities'         => $this->input->post('amenities'),
                'short_description' => $this->input->post('short_description'),
                'long_description'  => $this->input->post('long_description'),
                'is_featured'       => $this->input->post('is_featured') ? 1 : 0,
                'status'            => $this->input->post('status')
            );
            if ($uploaded_image) {
                $data['featured_image'] = $uploaded_image;
            } elseif ($this->input->post('featured_image_url')) {
                $data['featured_image'] = $this->input->post('featured_image_url');
            }
            if ($this->input->post('gallery_images')) {
                $data['gallery_images'] = $this->input->post('gallery_images');
            }

            $this->Room_model->update_room($id, $data);
            $this->session->set_flashdata('success', 'Room details updated successfully!');
            redirect('admin/rooms');
        }
    }

    public function delete_room($id) {
        $this->Room_model->delete_room($id);
        $this->session->set_flashdata('success', 'Room deleted successfully!');
        redirect('admin/rooms');
    }

    // ==========================================
    // 4. FACILITIES MANAGEMENT
    // ==========================================
    public function facilities() {
        $data['facilities'] = $this->Facility_model->get_all_facilities();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/facilities', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function add_facility() {
        if ($this->input->post()) {
            $image_url = $this->handle_file_upload('image', 'facilities');
            if (!$image_url) {
                $image_url = $this->input->post('image_url') ?: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80';
            }

            $data = array(
                'title'             => $this->input->post('title'),
                'icon'              => $this->input->post('icon') ?: 'fa-solid fa-hotel',
                'short_description' => $this->input->post('short_description'),
                'full_description'  => $this->input->post('full_description'),
                'image'             => $image_url,
                'sort_order'        => (int)$this->input->post('sort_order'),
                'status'            => $this->input->post('status') ?: 'active'
            );
            $this->Facility_model->add_facility($data);
            $this->session->set_flashdata('success', 'Hotel facility added successfully!');
            redirect('admin/facilities');
        }
    }

    public function edit_facility() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $uploaded_image = $this->handle_file_upload('image', 'facilities');

            $data = array(
                'title'             => $this->input->post('title'),
                'icon'              => $this->input->post('icon'),
                'short_description' => $this->input->post('short_description'),
                'full_description'  => $this->input->post('full_description'),
                'sort_order'        => (int)$this->input->post('sort_order'),
                'status'            => $this->input->post('status')
            );
            if ($uploaded_image) {
                $data['image'] = $uploaded_image;
            } elseif ($this->input->post('image_url')) {
                $data['image'] = $this->input->post('image_url');
            }

            $this->Facility_model->update_facility($id, $data);
            $this->session->set_flashdata('success', 'Facility updated successfully!');
            redirect('admin/facilities');
        }
    }

    public function delete_facility($id) {
        $this->Facility_model->delete_facility($id);
        $this->session->set_flashdata('success', 'Facility deleted successfully!');
        redirect('admin/facilities');
    }

    // ==========================================
    // 5. RESTAURANT & MENUS MANAGEMENT
    // ==========================================
    public function restaurant() {
        $data['categories'] = $this->Restaurant_model->get_all_categories();
        $data['items'] = $this->Restaurant_model->get_all_items();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/restaurant', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function add_restaurant_category() {
        if ($this->input->post()) {
            $slug = url_title($this->input->post('name'), 'dash', TRUE);
            $data = array(
                'name'        => $this->input->post('name'),
                'slug'        => $slug,
                'description' => $this->input->post('description'),
                'sort_order'  => (int)$this->input->post('sort_order'),
                'status'      => $this->input->post('status') ?: 'active'
            );
            $this->Restaurant_model->add_category($data);
            $this->session->set_flashdata('success', 'Menu category added successfully!');
            redirect('admin/restaurant');
        }
    }

    public function edit_restaurant_category() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $slug = url_title($this->input->post('name'), 'dash', TRUE);
            $data = array(
                'name'        => $this->input->post('name'),
                'slug'        => $slug,
                'description' => $this->input->post('description'),
                'sort_order'  => (int)$this->input->post('sort_order'),
                'status'      => $this->input->post('status')
            );
            $this->Restaurant_model->update_category($id, $data);
            $this->session->set_flashdata('success', 'Menu category updated successfully!');
            redirect('admin/restaurant');
        }
    }

    public function delete_restaurant_category($id) {
        $this->Restaurant_model->delete_category($id);
        $this->session->set_flashdata('success', 'Menu category deleted successfully!');
        redirect('admin/restaurant');
    }

    public function add_menu_item() {
        if ($this->input->post()) {
            $image_url = $this->handle_file_upload('image', 'restaurant');
            if (!$image_url) {
                $image_url = $this->input->post('image_url') ?: 'https://images.unsplash.com/photo-1533777857889-4be7c70b33f7?auto=format&fit=crop&w=600&q=80';
            }

            $data = array(
                'category_id'  => $this->input->post('category_id'),
                'name'         => $this->input->post('name'),
                'description'  => $this->input->post('description'),
                'price'        => (float)$this->input->post('price'),
                'dietary_type' => $this->input->post('dietary_type') ?: 'non-veg',
                'badge'        => $this->input->post('badge'),
                'image'        => $image_url,
                'is_special'   => $this->input->post('is_special') ? 1 : 0,
                'status'       => $this->input->post('status') ?: 'active'
            );
            $this->Restaurant_model->add_item($data);
            $this->session->set_flashdata('success', 'Dish added to dining menu!');
            redirect('admin/restaurant');
        }
    }

    public function edit_menu_item() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $uploaded_image = $this->handle_file_upload('image', 'restaurant');

            $data = array(
                'category_id'  => $this->input->post('category_id'),
                'name'         => $this->input->post('name'),
                'description'  => $this->input->post('description'),
                'price'        => (float)$this->input->post('price'),
                'dietary_type' => $this->input->post('dietary_type'),
                'badge'        => $this->input->post('badge'),
                'is_special'   => $this->input->post('is_special') ? 1 : 0,
                'status'       => $this->input->post('status')
            );
            if ($uploaded_image) {
                $data['image'] = $uploaded_image;
            } elseif ($this->input->post('image_url')) {
                $data['image'] = $this->input->post('image_url');
            }

            $this->Restaurant_model->update_item($id, $data);
            $this->session->set_flashdata('success', 'Menu dish updated successfully!');
            redirect('admin/restaurant');
        }
    }

    public function delete_menu_item($id) {
        $this->Restaurant_model->delete_item($id);
        $this->session->set_flashdata('success', 'Menu dish deleted successfully!');
        redirect('admin/restaurant');
    }

    // ==========================================
    // 6. TOURIST BLOGS & FULL SEO MANAGEMENT
    // ==========================================
    public function blogs() {
        $data['blogs'] = $this->Blog_model->get_all_blogs();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/blogs', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function add_blog() {
        if ($this->input->post()) {
            $image_url = $this->handle_file_upload('featured_image', 'blogs');
            if (!$image_url) {
                $image_url = $this->input->post('featured_image_url') ?: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1000&q=85';
            }
            $slug = url_title($this->input->post('title'), 'dash', TRUE);

            $data = array(
                'title'            => $this->input->post('title'),
                'slug'             => $slug,
                'category'         => $this->input->post('category') ?: 'Tourist Guide',
                'featured_image'   => $image_url,
                'author_name'      => $this->input->post('author_name') ?: 'Chief Concierge',
                'read_time'        => $this->input->post('read_time') ?: '5 min read',
                'summary'          => $this->input->post('summary'),
                'content'          => $this->input->post('content'),
                // DYNAMIC SEO FIELDS
                'meta_title'       => $this->input->post('meta_title') ?: $this->input->post('title'),
                'meta_keywords'    => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'is_featured'      => $this->input->post('is_featured') ? 1 : 0,
                'status'           => $this->input->post('status') ?: 'published'
            );

            $this->Blog_model->add_blog($data);
            $this->session->set_flashdata('success', 'Tourist blog article published with SEO setup!');
            redirect('admin/blogs');
        }
    }

    public function edit_blog() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $uploaded_image = $this->handle_file_upload('featured_image', 'blogs');
            $slug = url_title($this->input->post('title'), 'dash', TRUE);

            $data = array(
                'title'            => $this->input->post('title'),
                'slug'             => $slug,
                'category'         => $this->input->post('category'),
                'author_name'      => $this->input->post('author_name'),
                'read_time'        => $this->input->post('read_time'),
                'summary'          => $this->input->post('summary'),
                'content'          => $this->input->post('content'),
                // DYNAMIC SEO FIELDS
                'meta_title'       => $this->input->post('meta_title'),
                'meta_keywords'    => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'is_featured'      => $this->input->post('is_featured') ? 1 : 0,
                'status'           => $this->input->post('status')
            );
            if ($uploaded_image) {
                $data['featured_image'] = $uploaded_image;
            } elseif ($this->input->post('featured_image_url')) {
                $data['featured_image'] = $this->input->post('featured_image_url');
            }

            $this->Blog_model->update_blog($id, $data);
            $this->session->set_flashdata('success', 'Blog article and SEO meta updated successfully!');
            redirect('admin/blogs');
        }
    }

    public function delete_blog($id) {
        $this->Blog_model->delete_blog($id);
        $this->session->set_flashdata('success', 'Blog article deleted successfully!');
        redirect('admin/blogs');
    }

    // ==========================================
    // 7. PROMOTIONS MANAGEMENT
    // ==========================================
    public function promotions() {
        $data['promotions'] = $this->Promotion_model->get_all_promotions();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/promotions', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function add_promotion() {
        if ($this->input->post()) {
            $image_url = $this->handle_file_upload('banner_image', 'promotions');
            if (!$image_url) {
                $image_url = $this->input->post('banner_image_url') ?: 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=1000&q=85';
            }

            $data = array(
                'title'         => $this->input->post('title'),
                'badge'         => $this->input->post('badge') ?: 'Special Offer',
                'discount_text' => $this->input->post('discount_text'),
                'promo_code'    => $this->input->post('promo_code'),
                'banner_image'  => $image_url,
                'description'   => $this->input->post('description'),
                'valid_until'   => $this->input->post('valid_until'),
                'status'        => $this->input->post('status') ?: 'active'
            );
            $this->Promotion_model->add_promotion($data);
            $this->session->set_flashdata('success', 'Promotion offer published!');
            redirect('admin/promotions');
        }
    }

    public function edit_promotion() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $uploaded_image = $this->handle_file_upload('banner_image', 'promotions');

            $data = array(
                'title'         => $this->input->post('title'),
                'badge'         => $this->input->post('badge'),
                'discount_text' => $this->input->post('discount_text'),
                'promo_code'    => $this->input->post('promo_code'),
                'description'   => $this->input->post('description'),
                'valid_until'   => $this->input->post('valid_until'),
                'status'        => $this->input->post('status')
            );
            if ($uploaded_image) {
                $data['banner_image'] = $uploaded_image;
            } elseif ($this->input->post('banner_image_url')) {
                $data['banner_image'] = $this->input->post('banner_image_url');
            }

            $this->Promotion_model->update_promotion($id, $data);
            $this->session->set_flashdata('success', 'Promotion updated successfully!');
            redirect('admin/promotions');
        }
    }

    public function delete_promotion($id) {
        $this->Promotion_model->delete_promotion($id);
        $this->session->set_flashdata('success', 'Promotion deleted!');
        redirect('admin/promotions');
    }

    // ==========================================
    // 8. GALLERY MANAGEMENT
    // ==========================================
    public function gallery() {
        $data['gallery'] = $this->Gallery_model->get_all_gallery();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/gallery', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function add_gallery() {
        if ($this->input->post()) {
            $image_url = $this->handle_file_upload('image', 'gallery');
            if (!$image_url) {
                $image_url = $this->input->post('image_url') ?: 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=800&q=80';
            }

            $data = array(
                'title'      => $this->input->post('title'),
                'category'   => $this->input->post('category') ?: 'hotel',
                'image'      => $image_url,
                'caption'    => $this->input->post('caption'),
                'sort_order' => (int)$this->input->post('sort_order'),
                'status'     => $this->input->post('status') ?: 'active'
            );
            $this->Gallery_model->add_gallery($data);
            $this->session->set_flashdata('success', 'Photo added to gallery!');
            redirect('admin/gallery');
        }
    }

    public function delete_gallery($id) {
        $this->Gallery_model->delete_gallery($id);
        $this->session->set_flashdata('success', 'Photo deleted from gallery!');
        redirect('admin/gallery');
    }

    // ==========================================
    // 9. BOOKINGS MANAGEMENT
    // ==========================================
    public function bookings() {
        $data['bookings'] = $this->Booking_model->get_all_bookings();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/bookings', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function update_booking_status() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            $this->Booking_model->update_status($id, $status);
            $this->session->set_flashdata('success', 'Booking status updated to ' . ucfirst($status));
            redirect('admin/bookings');
        }
    }

    public function delete_booking($id) {
        $this->Booking_model->delete_booking($id);
        $this->session->set_flashdata('success', 'Booking record deleted!');
        redirect('admin/bookings');
    }

    // ==========================================
    // 10. TABLE RESERVATIONS MANAGEMENT
    // ==========================================
    public function reservations() {
        $data['reservations'] = $this->Restaurant_model->get_all_reservations();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/reservations', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function update_reservation_status() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            $this->Restaurant_model->update_reservation_status($id, $status);
            $this->session->set_flashdata('success', 'Table reservation status updated!');
            redirect('admin/reservations');
        }
    }

    public function delete_reservation($id) {
        $this->Restaurant_model->delete_reservation($id);
        $this->session->set_flashdata('success', 'Reservation deleted!');
        redirect('admin/reservations');
    }

    // ==========================================
    // 11. CONTACT MESSAGES MANAGEMENT
    // ==========================================
    public function contacts() {
        $data['contacts'] = $this->Contact_model->get_all_contacts();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/contacts', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function update_contact_status() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            $this->Contact_model->update_status($id, $status);
            $this->session->set_flashdata('success', 'Inquiry status updated!');
            redirect('admin/contacts');
        }
    }

    public function delete_contact($id) {
        $this->Contact_model->delete_contact($id);
        $this->session->set_flashdata('success', 'Inquiry deleted!');
        redirect('admin/contacts');
    }

    // ==========================================
    // 12. TESTIMONIALS MANAGEMENT
    // ==========================================
    public function testimonials() {
        $data['testimonials'] = $this->Testimonial_model->get_all_testimonials();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/testimonials', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function add_testimonial() {
        if ($this->input->post()) {
            $avatar = $this->handle_file_upload('avatar', 'settings');
            if (!$avatar) {
                $avatar = $this->input->post('avatar_url') ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80';
            }
            $data = array(
                'guest_name'  => $this->input->post('guest_name'),
                'designation' => $this->input->post('designation') ?: 'Verified Guest',
                'location'    => $this->input->post('location') ?: 'International Traveler',
                'rating'      => (int)$this->input->post('rating') ?: 5,
                'review'      => $this->input->post('review'),
                'avatar'      => $avatar,
                'status'      => $this->input->post('status') ?: 'active'
            );
            $this->Testimonial_model->add_testimonial($data);
            $this->session->set_flashdata('success', 'Guest testimonial added successfully!');
            redirect('admin/testimonials');
        }
    }

    public function edit_testimonial() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $avatar = $this->handle_file_upload('avatar', 'settings');

            $data = array(
                'guest_name'  => $this->input->post('guest_name'),
                'designation' => $this->input->post('designation'),
                'location'    => $this->input->post('location'),
                'rating'      => (int)$this->input->post('rating'),
                'review'      => $this->input->post('review'),
                'status'      => $this->input->post('status')
            );
            if ($avatar) {
                $data['avatar'] = $avatar;
            } elseif ($this->input->post('avatar_url')) {
                $data['avatar'] = $this->input->post('avatar_url');
            }

            $this->Testimonial_model->update_testimonial($id, $data);
            $this->session->set_flashdata('success', 'Guest testimonial updated successfully!');
            redirect('admin/testimonials');
        }
    }

    public function delete_testimonial($id) {
        $this->Testimonial_model->delete_testimonial($id);
        $this->session->set_flashdata('success', 'Guest testimonial deleted!');
        redirect('admin/testimonials');
    }

    public function settings() {
        $admin_id = $this->session->userdata('admin_id');
        $data['admin_user'] = $this->Admin_model->get_user_by_id($admin_id);
        $data['settings'] = $this->Settings_model->get_settings();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/settings', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function update_admin_profile() {
        if ($this->input->post()) {
            $admin_id = $this->session->userdata('admin_id');
            $name = trim($this->input->post('admin_name', TRUE));
            $username = trim($this->input->post('admin_username', TRUE));
            $email = trim($this->input->post('admin_email', TRUE));
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');

            $update_data = array();
            if (!empty($name)) $update_data['name'] = $name;
            if (!empty($username)) $update_data['username'] = $username;
            if (!empty($email)) $update_data['email'] = $email;

            if (!empty($update_data)) {
                $this->Admin_model->update_profile($admin_id, $update_data);
                $this->session->set_userdata(array(
                    'admin_name'     => $name ?: $this->session->userdata('admin_name'),
                    'admin_username' => $username ?: $this->session->userdata('admin_username'),
                    'admin_email'    => $email ?: $this->session->userdata('admin_email')
                ));
            }

            if (!empty($new_password)) {
                if ($new_password === $confirm_password) {
                    $this->Admin_model->update_password($admin_id, $new_password);
                    $this->session->set_flashdata('success', 'Admin profile and password updated successfully!');
                } else {
                    $this->session->set_flashdata('error', 'Profile updated, but password was not changed because passwords did not match.');
                    redirect('admin/settings');
                }
            } else {
                $this->session->set_flashdata('success', 'Admin profile updated successfully!');
            }
            redirect('admin/settings');
        }
    }

    public function update_settings() {
        if ($this->input->post()) {
            $logo_url = $this->handle_file_upload('hotel_logo', 'settings');
            $favicon_url = $this->handle_file_upload('hotel_favicon', 'settings');

            $data = array(
                'hotel_name'        => $this->input->post('hotel_name'),
                'hotel_tagline'     => $this->input->post('hotel_tagline'),
                'hotel_email'       => $this->input->post('hotel_email'),
                'hotel_phone'       => $this->input->post('hotel_phone'),
                'hotel_alt_phone'   => $this->input->post('hotel_alt_phone'),
                'hotel_address'     => $this->input->post('hotel_address'),
                'map_iframe'        => $this->input->post('map_iframe'),
                'facebook_url'      => $this->input->post('facebook_url'),
                'instagram_url'     => $this->input->post('instagram_url'),
                'twitter_url'       => $this->input->post('twitter_url'),
                'tripadvisor_url'   => $this->input->post('tripadvisor_url'),
                'meta_title'        => $this->input->post('meta_title'),
                'meta_description'  => $this->input->post('meta_description'),
                'meta_keywords'     => $this->input->post('meta_keywords'),
                // Grand Opening & Countdown Controls
                'is_opening_enabled'  => $this->input->post('is_opening_enabled') ? 1 : 0,
                'opening_date'        => $this->input->post('opening_date') ?: '2026-09-12 09:00:00',
                'opening_mode'        => $this->input->post('opening_mode') ?: 'countdown_page',
                'opening_title'       => $this->input->post('opening_title') ?: 'Grand Opening — September 12, 2026',
                'opening_subtitle'    => $this->input->post('opening_subtitle'),
                'opening_banner_text' => $this->input->post('opening_banner_text') ?: '🎉 Grand Opening on September 12, 2026 — Pre-Bookings Now Open!',
                // SMTP Settings
                'smtp_host'         => $this->input->post('smtp_host'),
                'smtp_port'         => (int)$this->input->post('smtp_port') ?: 587,
                'smtp_user'         => $this->input->post('smtp_user'),
                'smtp_pass'         => $this->input->post('smtp_pass'),
                'smtp_crypto'       => $this->input->post('smtp_crypto') ?: 'tls',
                'smtp_from_email'   => $this->input->post('smtp_from_email'),
                'smtp_from_name'    => $this->input->post('smtp_from_name')
            );
            if ($logo_url) {
                $data['hotel_logo'] = $logo_url;
            } elseif ($this->input->post('remove_hotel_logo')) {
                $data['hotel_logo'] = '';
            }

            if ($favicon_url) {
                $data['hotel_favicon'] = $favicon_url;
            } elseif ($this->input->post('remove_hotel_favicon')) {
                $data['hotel_favicon'] = '';
            }

            $this->Settings_model->update_settings($data);
            $this->session->set_flashdata('success', 'Site settings & branding updated successfully!');
            redirect('admin/settings');
        }
    }

    public function send_test_email() {
        if ($this->input->post()) {
            $to_email = $this->input->post('test_email');
            $settings = $this->Settings_model->get_settings();

            $config = array(
                'protocol'    => 'smtp',
                'smtp_host'   => $settings['smtp_host'],
                'smtp_port'   => $settings['smtp_port'] ?: 587,
                'smtp_user'   => $settings['smtp_user'],
                'smtp_pass'   => $settings['smtp_pass'],
                'smtp_crypto' => $settings['smtp_crypto'] ?: 'tls',
                'mailtype'    => 'html',
                'charset'     => 'utf-8',
                'newline'     => "\r\n"
            );

            $this->email->initialize($config);
            $this->email->from($settings['smtp_from_email'] ?: 'noreply@grandcannann.com', $settings['smtp_from_name'] ?: 'Grand Cannann Resort');
            $this->email->to($to_email);
            $this->email->subject('Grand Cannann SMTP Test Email');
            $this->email->message('<h3>SMTP Configuration Test</h3><p>Congratulations! Your SMTP settings for <strong>' . $settings['hotel_name'] . '</strong> are functioning correctly.</p>');

            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'Test email sent successfully to ' . $to_email);
            } else {
                $this->session->set_flashdata('error', 'Failed to send test email. Error details: ' . $this->email->print_debugger());
            }
            redirect('admin/settings');
        }
    }

    // ==========================================
    // 14. DATABASE SYNC & MAINTENANCE TOOL
    // ==========================================
    public function db_sync() {
        $data['tables_overview'] = $this->Sync_model->get_tables_overview();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/database_sync', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function sync_database_schema() {
        $results = $this->Sync_model->sync_all_schemas();
        $created_count = 0;
        foreach ($results as $r) {
            if (!$r['existed']) $created_count++;
        }
        $msg = 'Database schema sync completed successfully! All 17 hotel tables are verified and active.';
        if ($created_count > 0) {
            $msg .= " ($created_count missing tables were automatically initialized).";
        }
        $this->session->set_flashdata('success', $msg);
        redirect('admin/db_sync');
    }

    public function export_database() {
        $this->load->helper('download');
        $backup = $this->Sync_model->export_sql_dump();
        $filename = 'cannann_backup_' . date('Y-m-d_His') . '.sql';
        force_download($filename, $backup);
    }

    public function import_database_sql() {
        if (!empty($_FILES['sql_file']['name'])) {
            $file_tmp = $_FILES['sql_file']['tmp_name'];
            $file_ext = strtolower(pathinfo($_FILES['sql_file']['name'], PATHINFO_EXTENSION));

            if ($file_ext === 'sql') {
                $sql_content = file_get_contents($file_tmp);
                if (!empty($sql_content)) {
                    $res = $this->Sync_model->import_sql_script($sql_content);
                    if ($res['success']) {
                        $this->session->set_flashdata('success', 'Database SQL dump imported successfully! (' . $res['executed'] . ' statements executed).');
                    } else {
                        $err_str = !empty($res['errors']) ? implode('<br>', array_slice($res['errors'], 0, 3)) : 'Unknown SQL execution error';
                        $this->session->set_flashdata('error', 'SQL import encountered errors: ' . $err_str);
                    }
                } else {
                    $this->session->set_flashdata('error', 'Uploaded SQL file was empty.');
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid file type. Please upload a valid .sql file.');
            }
        } else {
            $this->session->set_flashdata('error', 'No file was uploaded.');
        }
        redirect('admin/db_sync');
    }

    public function optimize_database_tables() {
        $tables = $this->Sync_model->optimize_all_tables();
        $this->session->set_flashdata('success', 'Optimized ' . count($tables) . ' database tables successfully! Table overhead and indexes defragmented.');
        redirect('admin/db_sync');
    }

    public function seed_database_defaults() {
        $seeded = $this->Sync_model->seed_sample_data();
        if (!empty($seeded)) {
            $this->session->set_flashdata('success', 'Seeded baseline hotel data: ' . implode(', ', $seeded));
        } else {
            $this->session->set_flashdata('success', 'Tables already contain records. No duplicate seeding needed.');
        }
        redirect('admin/db_sync');
    }
}
