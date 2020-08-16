<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Organizations extends Core_Controller  {

	public function __construct() {
		parent::__construct();
		$this->load->model('model_system');
		$this->model_system->is_accessible();
		$this->load->model('organizations/model_organizations');
	}

	public function index(){
		$data = [
			'web_title' => 'Scholarship Finder System | Organizations',
			'modules' => $this->model_system->user_modules(['user_id' => $this->session->login_id]),
			'organization_form_open' => $this->layout->modal_form_open('Organization', 'organizations/organizations/insert'),
			'organization_form_close' => $this->layout->modal_form_close(),
			'organization_image_form_open' => $this->layout->modal_form_open('Organization Image', 'organizations/organizations', true),
			'organization_image_form_close' => $this->layout->modal_form_close(),
			'organization_del_modal' => $this->layout->confirmation('Organization Delete', 'Are you sure you want to remove?'),
		];
		//Image Upload
		if(isset($_FILES['organization_image_file_path'])){
			$upload = $this->upload($this->input->post('organization_id').'.png', 'organization_image_file_path');
			if(is_array($upload)){
				if($this->model_organizations->organization_images_count(['organization_id' => $this->input->post('organization_id')]) == 0){
					$this->model_organizations->organization_image_insert([
						'organization_id' => $this->input->post('organization_id'),
						'organization_image_file_path' => $upload['file_name']
					]);
				}
				$data['notification'] = $this->layout->notification(1, 'Successfully updated organization image.');
			}else{
				$data['notification'] = $this->layout->notification(2, $upload);
			}
		}
		$data['organizations_table'] = $this->model_organizations->organizations_table();
		$this->load->view('interface/system/organizations/main_organizations', $data);
	}

	public function preview(){
		if(is_numeric($this->uri->segment(4))){
			$this->load->model('model_home');
			$data = [
				'web_title' => 'Scholarship Finder System | Organizations Preview',
				'modules' => $this->model_system->user_modules(['user_id' => $this->session->login_id]),
				'organization_value' => $this->model_home->organization_value(['organization_id' => $this->uri->segment(4)]),
				'applicants_count' => $this->model_home->applicant_organizations_count(['organization_id' => $this->uri->segment(4), 'applicant_organization_status' => 'Pending'])
			];
		}
		$this->load->view('interface/system/organizations/form_organizations', $data);
	}

	private function validate(){
		$this->form_validation->set_rules('organization_name', 'Organization Name', 'trim|required');
		$this->form_validation->set_rules('organization_address', 'Address', 'trim|required');
		$this->form_validation->set_rules('organization_contact_no', 'Contact No.', 'trim|required');
		$this->form_validation->set_rules('organization_email_address', 'Email Address', 'trim|valid_email');
		$this->form_validation->set_rules('organization_type', 'Org. Type', 'trim|required');
		$this->form_validation->set_rules('organization_scholarship_description', 'Scholarship Description', 'trim');
		if ($this->form_validation->run() == TRUE) {
			return [
				'organization_name' => $this->input->post('organization_name'),
				'organization_address' => $this->input->post('organization_address'),
				'organization_contact_no' => $this->input->post('organization_contact_no'),
				'organization_email_address' => $this->input->post('organization_email_address'),
				'organization_type' => $this->input->post('organization_type'),
				'organization_scholarship_description' => $this->input->post('organization_scholarship_description'),
				'user_id' => $this->session->login_id,
			];
		}else{
			return validation_errors();
		}
	}

	public function insert(){
		$result = [];
		if(is_array($this->validate())){
			$this->model_organizations->organization_insert($this->validate());
			$result = [
				'organizations_table' => $this->model_organizations->organizations_table(),
				'notification' => $this->layout->notification(1, 'Successfully added a organization.')
			];
		}else{
			$result['notification'] = $this->layout->notification(2, $this->validate());
		}
		echo json_encode($result);
	}

	public function update(){
		$result = [];
		if(is_array($this->validate())){
			$this->model_organizations->organization_update(['organization_id' => $this->input->post('organization_id')], $this->validate());
			$result = [
				'organizations_table' => $this->model_organizations->organizations_table(),
				'notification' => $this->layout->notification(1, 'Successfully updated a organization.')
			];
		}else{
			$result['notification'] = $this->layout->notification(2, $this->validate());
		}
		echo json_encode($result);
	}

	public function delete(){
		$result = [];
		if($this->input->post('organization_id')){
			// Delete Organization Image
			$this->model_organizations->organization_image_delete(['organization_id' => $this->input->post('organization_id')]);
			$this->load->helper('file');
			unlink('./assets/upload/'. $this->input->post('organization_id').'.png');
			// Delete Organization
			$this->model_organizations->organization_delete(['organization_id' => $this->input->post('organization_id')]);
			$result = [
				'organizations_table' => $this->model_organizations->organizations_table(),
				'notification' => $this->layout->notification(1, 'Successfully deleted a organization.')
			];
		}
		echo json_encode($result);
	}

	public function ajax(){
		if($this->input->post('organization_id')){
			echo json_encode($this->model_organizations->organization_value(['organization_id' => $this->input->post('organization_id')]));
		}
	}

}
