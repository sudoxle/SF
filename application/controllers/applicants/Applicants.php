<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Applicants extends Core_Controller  {

	public function __construct() {
		parent::__construct();
		$this->load->model('model_system');
		$this->model_system->is_accessible();
		$this->load->model('applicants/model_applicants');
	}

	public function index(){
		$data = [
			'web_title' => 'Scholarship Finder System | Applicants',
			'modules' => $this->model_system->user_modules(['user_id' => $this->session->login_id]),
			'applicants_table' => $this->model_applicants->applicants_table(),
			'applicant_form_open' => $this->layout->modal_form_open('Applicant', ''),
			'applicant_form_close' => $this->layout->modal_form_close(),
			'applicant_del_modal' => $this->layout->confirmation('Applicant Delete', 'Are you sure you want to remove?'),
			'applicant_approve_form_open' => $this->layout->modal_form_open('Applicant Approve', 'applicants/applicants/approve'),
			'applicant_approve_form_close' => $this->layout->modal_form_close('Approve'),
			'applicant_disapprove_form_open' => $this->layout->modal_form_open('Applicant Disapprove', 'applicants/applicants/disapprove'),
			'applicant_disapprove_form_close' => $this->layout->modal_form_close('Disapprove'),
		];
		$this->load->view('interface/system/applicants/main_applicants', $data);
	}

	private function validate(){
		$this->form_validation->set_rules('applicant_firstname', 'First Name', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('applicant_middlename', 'Middle Name', 'trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('applicant_lastname', 'Last Name', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('applicant_gender', 'Gender', 'trim|required|alpha');
		$this->form_validation->set_rules('applicant_birthdate', 'Birthdate', 'trim|required');
		$this->form_validation->set_rules('applicant_address', 'Address', 'trim');
		$this->form_validation->set_rules('applicant_mobile', 'Mobile', 'trim|numeric');
		$this->form_validation->set_rules('applicant_email_address', 'Email Address', 'trim|required|valid_email');
		if ($this->form_validation->run() == TRUE) {
			return [
				'applicant_firstname' => $this->input->post('applicant_firstname'),
				'applicant_middlename' => $this->input->post('applicant_middlename'),
				'applicant_lastname' => $this->input->post('applicant_lastname'),
				'applicant_gender' => $this->input->post('applicant_gender'),
				'applicant_birthdate' => $this->input->post('applicant_birthdate'),
				'applicant_address' => $this->input->post('applicant_address'),
				'applicant_mobile' => $this->input->post('applicant_mobile'),
				'applicant_email_address' => $this->input->post('applicant_email_address'),
			];
		}else{
			return validation_errors();
		}
	}

	public function update(){
		$result = [];
		if(is_array($this->validate())){
			$this->model_applicants->applicant_update(['applicant_id' => $this->input->post('applicant_id')], $this->validate());
			$result = [
				'applicants_table' => $this->model_applicants->applicants_table(),
				'notification' => $this->layout->notification(1, 'Successfully updated an applicant.')
			];
		}else{
			$result['notification'] = $this->layout->notification(2, $this->validate());
		}
		echo json_encode($result);
	}

	public function delete(){
		$result = [];
		if($this->input->post('applicant_id')){
			//Delete Applicant Organization Messages
			$this->model_applicants->applicant_organization_message_delete(['applicant_organization_id' => $this->input->post('applicant_organization_id')]);
			//Delete Applicant Requirements
			$this->load->helper('file');
			foreach ($this->model_applicants->applicant_requirements(['applicant_organization_id' => $this->input->post('applicant_organization_id'), 'organization_id' => $this->input->post('organization_id')]) as $row) {
				unlink('./assets/upload/'. $row->applicant_requirement_file_path);
			}
			$this->model_applicants->applicant_requirement_delete(['applicant_organization_id' => $this->input->post('applicant_organization_id'), 'organization_id' => $this->input->post('organization_id')]);
			//Delete Applicant Organization
			$this->model_applicants->applicant_organization_delete(['applicant_id' => $this->input->post('applicant_id'), 'organization_id' => $this->input->post('organization_id')]);
			//Delete Applicant
			//$this->model_applicants->applicant_delete(['applicant_id' => $this->input->post('applicant_id')]);
			$result = [
				'applicants_table' => $this->model_applicants->applicants_table(),
				'notification' => $this->layout->notification(1, 'Successfully deleted an applicant.')
			];
		}
		echo json_encode($result);
	}

	public function approve(){
		$result = [];
		if($this->input->post('applicant_id')){
			if($this->is_internet_connected()){
				//Send Email to Notify
				$is_sent = false;
				foreach ($this->model_applicants->applicants(['applicant_organization_id' => $this->input->post('applicant_organization_id')]) as $row) {
					$config = [
						'fullname' => 'Scholarship Finder',
						'email_to' => $row->applicant_email_address,
						'subject' => $row->organization_name .': Scholarship Approved',
						'message' => $this->input->post('message')
					];
					$is_sent = $this->email($config) ? true:false;
					if($is_sent){
						$this->model_applicants->applicant_organization_message_insert([
							'applicant_organization_message' => $config['message'],
							'applicant_organization_message_status' => 'Approved',
							'applicant_organization_id' => $this->input->post('applicant_organization_id'),
						]);
					}
				}
				//Update Applicant
				if($is_sent){
					$this->model_applicants->applicant_organization_update(['applicant_organization_id' => $this->input->post('applicant_organization_id')], ['applicant_organization_status' => 'Approved']);
					$result = [
						'applicants_table' => $this->model_applicants->applicants_table(),
						'notification' => $this->layout->notification(1, 'Successfully approved an applicant. Email notification sent.')
					];
				}else{
					$result['notification'] = $this->layout->notification(2, 'Failed to approve due to Email Notification Failed to sent. Please check Network.');
				}
			}else{
				$result['notification'] = $this->layout->notification(2, 'Failed to approve due to No Internet Connection.');
			}
		}
		echo json_encode($result);
	}

	public function disapprove(){
		$result = [];
		if($this->input->post('applicant_id')){
			if($this->is_internet_connected()){
				//Send Email to Notify
				$is_sent = false;
				foreach ($this->model_applicants->applicants(['applicant_organization_id' => $this->input->post('applicant_organization_id')]) as $row) {
					$config = [
						'fullname' => 'Scholarship Finder',
						'email_to' => $row->applicant_email_address,
						'subject' => $row->organization_name .': Scholarship Disapproved',
						'message' => $this->input->post('message')
					];
					$is_sent = $this->email($config) ? true:false;
					if($is_sent){
						$this->model_applicants->applicant_organization_message_insert([
							'applicant_organization_message' => $config['message'],
							'applicant_organization_message_status' => 'Disapproved',
							'applicant_organization_id' => $this->input->post('applicant_organization_id'),
						]);
					}
				}
				//Update Applicant
				if($is_sent){
					$this->model_applicants->applicant_organization_update(['applicant_organization_id' => $this->input->post('applicant_organization_id')], ['applicant_organization_status' => 'Disapproved']);
					$result = [
						'applicants_table' => $this->model_applicants->applicants_table(),
						'notification' => $this->layout->notification(1, 'Successfully disapproved an applicant. Email notification sent.')
					];
				}else{
					$result['notification'] = $this->layout->notification(2, 'Failed to disapprove due to Email Notification Failed to sent. Please check Network.');
				}
			}else{
				$result['notification'] = $this->layout->notification(2, 'Failed to disapprove due to No Internet Connection.');
			}
		}
		echo json_encode($result);
	}

	public function ajax(){
		// APPLICANT VALUE
		if($this->input->post('applicant_id')){
			echo json_encode($this->model_applicants->applicant_value(['applicant_id' => $this->input->post('applicant_id')]));
		}
		// APPLICANTS TABLE
		else if($this->input->post('status_filter')){
			if($this->input->post('status_filter') == 'all'){
				echo $this->model_applicants->applicants_table();
			}else{
				echo $this->model_applicants->applicants_table(['applicant_organization_status' => $this->input->post('status_filter')]);
			}
		}
	}

}