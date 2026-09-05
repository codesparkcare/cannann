<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// Load the URL helper for site_url() function and database library
		$this->load->helper('url');
		$this->load->database();
	}

	public function index()
	{
		// Load the index view instead of welcome_message
		$this->load->view('index');
	}

	public function save_enquiry()
	{
		// Retrieve form data
		$data = array(
			'name'    => $this->input->post('name'),
			'email'   => $this->input->post('email'),
			'phone'   => $this->input->post('phone'),
			'message' => $this->input->post('message')
		);

		// Insert data into 'enquiries' table
		$this->db->insert('enquiries', $data);

		echo "Enquiry Submitted Successfully. <a href='".site_url('welcome')."'>Go back</a>";
	}
}
