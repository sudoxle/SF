<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Organization_users extends Core_Controller  {

	public function __construct() {
		parent::__construct();
		$this->load->model('model_system');
		$this->model_system->is_accessible();
		$this->load->model('organizations/model_organization_users');
	}

	public function index(){
		$data = [
			'web_title' => 'Scholarship Finder System | Organization Users',
			'modules' => $this->model_system->user_modules(['user_id' => $this->session->login_id]),
			'organization_users_table' => $this->model_organization_users->organization_users_table(),
			'organization_user_form_open' => $this->layout->modal_form_open('Organization User', 'organizations/organization_users/insert'),
			'organization_user_form_close' => $this->layout->modal_form_close(),
			'organization_user_del_modal' => $this->layout->confirmation('Organization User Delete', 'Are you sure you want to remove?')
		];
		$this->load->view('interface/system/organizations/main_organization_users', $data);
	}

	private function validate(){
		$this->form_validation->set_rules('organization_user_username', 'Username', 'trim|required|alpha_numeric|min_length[5]');
		$this->form_validation->set_rules('organization_user_password', 'Password', 'trim|required|min_length[5]|alpha_numeric');
		$this->form_validation->set_rules('organization_user_fullname', 'Fullname', 'trim|required');
		$this->form_validation->set_rules('organization_user_gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('organization_user_birthdate', 'Birthdate', 'trim|required');
		$this->form_validation->set_rules('organization_user_address', 'Address', 'trim');
		$this->form_validation->set_rules('organization_user_mobile', 'Contact No.', 'trim|numeric');
		$this->form_validation->set_rules('organization_user_email_address', 'Email Address', 'trim|required|valid_email');
		if ($this->form_validation->run() == TRUE) {
			return [
				'organization_user_username' => $this->input->post('organization_user_username'),
				'organization_user_password' => $this->input->post('organization_user_password'),
				'organization_user_fullname' => $this->input->post('organization_user_fullname'),
				'organization_user_gender' => $this->input->post('organization_user_gender'),
				'organization_user_birthdate' => $this->input->post('organization_user_birthdate'),
				'organization_user_address' => $this->input->post('organization_user_address'),
				'organization_user_mobile' => $this->input->post('organization_user_mobile'),
				'organization_user_email_address' => $this->input->post('organization_user_email_address'),
				'organization_id' => $this->input->post('organization_id'),
			];
		}else{
			return validation_errors();
		}
	}

	public function insert(){
		$result = [];
		if(is_array($this->validate())){
			$this->model_organization_users->organization_user_insert($this->validate());
			$result = [
				'organization_users_table' => $this->model_organization_users->organization_users_table(),
				'notification' => $this->layout->notification(1, 'Successfully added a organization user.')
			];
		}else{
			$result['notification'] = $this->layout->notification(2, $this->validate());
		}
		echo json_encode($result);
	}

	public function update(){
		$result = [];
		if(is_array($this->validate())){
			$this->model_organization_users->organization_user_update(['organization_user_id' => $this->input->post('organization_user_id')], $this->validate());
			$result = [
				'organization_users_table' => $this->model_organization_users->organization_users_table(),
				'notification' => $this->layout->notification(1, 'Successfully updated a organization user.')
			];
		}else{
			$result['notification'] = $this->layout->notification(2, $this->validate());
		}
		echo json_encode($result);
	}

	public function delete(){
		$result = [];
		if($this->input->post('organization_user_id')){
			$this->model_organization_users->organization_user_delete(['organization_user_id' => $this->input->post('organization_user_id')]);
			$result = [
				'organization_users_table' => $this->model_organization_users->organization_users_table(),
				'notification' => $this->layout->notification(1, 'Successfully deleted a organization user.')
			];
		}
		echo json_encode($result);
	}

	public function ajax(){
		//ORGANIZATION USER VALUE
		if($this->input->post('organization_user_id')){
			echo json_encode($this->model_organization_users->organization_user_value(['organization_user_id' => $this->input->post('organization_user_id')]));
		}
		//ORGANIZATIONS SELECTION
		else if($this->input->post('organizations_selection')){
			$result = '<option value="">Choose Organization</option>';
			$this->load->model('organizations/model_organizations');
			foreach ($this->model_organizations->organizations() as $row) {
				$result .= '<option value="'.$row->organization_id.'">'.$row->organization_name.'</option>';
			}
			echo $result;
		}
	}

}
