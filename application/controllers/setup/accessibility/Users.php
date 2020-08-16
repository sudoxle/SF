<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Core_Controller  {

	public function __construct() {
		parent::__construct();
		$this->load->model('model_system');
		$this->model_system->is_accessible();
		$this->load->model('setup/accessibility/model_users');
	}

	public function index(){
		$data = [
			'web_title' => 'Scholarship Finder System | Users',
			'modules' => $this->model_system->user_modules(['user_id' => $this->session->login_id]),
			'users_table' => $this->model_users->users_table(),
			'user_form_open' => $this->layout->modal_form_open('User', 'setup/accessibility/users/insert_user'),
			'user_form_close' => $this->layout->modal_form_close(),
			'user_del_modal' => $this->layout->confirmation('User Delete', 'Are you sure you want to remove?'),
			'persons_table' => $this->model_users->persons_table(),
			'person_form_open' => $this->layout->modal_form_open('Person', 'setup/accessibility/persons/insert_person'),
			'person_form_close' => $this->layout->modal_form_close(),
			'person_del_modal' => $this->layout->confirmation('Person Delete', 'Are you sure you want to remove?'),
			'user_roles_table' => $this->model_users->user_roles_table(),
			'user_role_form_open' => $this->layout->modal_form_open('User Role', 'setup/accessibility/users/insert_user_role'),
			'user_role_form_close' => $this->layout->modal_form_close(),
			'user_role_del_modal' => $this->layout->confirmation('User Role Delete', 'Are you sure you want to remove?'),
		];
		$this->load->view('interface/system/setup/accessibility/main_users', $data);
	}

	public function modules(){
		if(is_numeric($this->uri->segment(5))){
			$data = [
				'web_title' => 'Scholarship Finder System | User Modules',
				'modules' => $this->model_system->user_modules(['user_id' => $this->session->login_id]),
				'user_value' => $this->model_users->user_value(['user_id' => $this->uri->segment(5)]),
				'user_modules' => $this->model_system->user_modules(['user_id' => $this->uri->segment(5)]),
			];
			$this->load->view('interface/system/setup/accessibility/form_modules', $data);
		}else{
			redirect('setup/accessibility/users');
		}
	}

	public function update_user_module(){
		$this->model_users->user_module_delete(['user_id' => $this->input->post('user_id')]);
		if(count($this->input->post('modules')) >= 1){
			foreach ($this->input->post('modules') as $modules){
				$values = [
					'user_module' => $modules,
					'user_id' => $this->input->post('user_id')
				];
				$this->model_users->user_module_insert($values);
			}
		}
		echo json_encode([
			'notification' => $this->layout->notification(1, 'Successfully updated module.')
		]);
	}

	//USER
	private function validate_user(){
		$this->form_validation->set_rules('persons_selection', 'Person', 'trim|numeric|required');
		$this->form_validation->set_rules('user_roles_selection', 'User Role', 'trim|numeric|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[5]');
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|alpha_numeric');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|matches[password1]');
		if ($this->form_validation->run() == TRUE) {
			return [
				'person_id' => $this->input->post('persons_selection'),
				'user_role_id' => $this->input->post('user_roles_selection'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password1'),
			];
		}else{
			return validation_errors();
		}
	}

	public function insert_user(){
		$result = [];
		if(is_array($this->validate_user())){
			$this->model_users->user_insert($this->validate_user());
			$result = [
				'users_table' => $this->model_users->users_table(),
				'notification' => $this->layout->notification(1, 'Successfully added a user.')
			];
		}else{
			$result['notification'] = $this->layout->notification(2, $this->validate_user());
		}
		echo json_encode($result);
	}

	public function update_user(){
		$result = [];
		if(is_array($this->validate_user())){
			$this->model_users->user_update(['user_id' => $this->input->post('user_id')], $this->validate_user());
			$result = [
				'users_table' => $this->model_users->users_table(),
				'notification' => $this->layout->notification(1, 'Successfully updated a user.')
			];
		}else{
			$result['notification'] = $this->layout->notification(2, $this->validate_user());
		}
		echo json_encode($result);
	}

	public function delete_user(){
		$result = [];
		if($this->model_users->user_delete(['user_id' => $this->input->post('user_id')]) >= 1){
			$result = [
				'users_table' => $this->model_users->users_table(),
				'notification' => $this->layout->notification(1, 'Successfully deleted a user.')
			];
		}
		echo json_encode($result);
	}

	//PERSON
	private function validate_person(){
		$this->form_validation->set_rules('firstname', 'Firstname', 'trim|alpha_numeric_spaces|required');
		$this->form_validation->set_rules('middlename', 'Middlename', 'trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('lastname', 'Lastname', 'trim|alpha_numeric_spaces|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required|alpha');
		$this->form_validation->set_rules('birthdate', 'Birthdate', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|numeric');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		if ($this->form_validation->run() == TRUE) {
			return [
				'firstname' => $this->input->post('firstname'),
				'middlename' => $this->input->post('middlename'),
				'lastname' => $this->input->post('lastname'),
				'gender' => $this->input->post('gender'),
				'birthdate' => $this->input->post('birthdate'),
				'address' => $this->input->post('address'),
				'mobile' => $this->input->post('mobile'),
				'email_address' => $this->input->post('email_address')
			];
		}else{
			return validation_errors();
		}
	}

	public function insert_person(){
		$result = [];
		if(is_array($this->validate_person())){
			$this->model_users->person_insert($this->validate_person());
			$result = [
				'persons_table' => $this->model_users->persons_table(),
				'notification' => $this->layout->notification(1, 'Successfully added a person.')
			];
		}else{
			$result['notification'] = $this->layout->notification(2, $this->validate_person());
		}
		echo json_encode($result);
	}

	public function update_person(){
		$result = [];
		if(is_array($this->validate_person())){
			$this->model_users->person_update(['person_id' => $this->input->post('person_id')], $this->validate_person());
			$result = [
				'persons_table' => $this->model_users->persons_table(),
				'notification' => $this->layout->notification(1, 'Successfully updated a person.')
			];
		}else{
			$result['notification'] = $this->layout->notification(2, $this->validate_person());
		}
		echo json_encode($result);
	}

	public function delete_person(){
		$result = [];
		if($this->model_users->person_delete(['person_id' => $this->input->post('person_id')]) >= 1){
			$result = [
				'persons_table' => $this->model_users->persons_table(),
				'notification' => $this->layout->notification(1, 'Successfully deleted a person.')
			];
		}
		echo json_encode($result);
	}

	//USER ROLE
	private function validate_user_role(){
		$this->form_validation->set_rules('user_role', 'User Role', 'trim|alpha_numeric_spaces|required');
		if ($this->form_validation->run() == TRUE) {
			return [
				'user_role' => ucfirst($this->input->post('user_role'))
			];
		}else{
			return validation_errors();
		}
	}

	public function insert_user_role(){
		$result = [];
		if(is_array($this->validate_user_role())){
			$this->model_users->user_role_insert($this->validate_user_role());
			$result = [
				'user_roles_table' => $this->model_users->user_roles_table(),
				'notification' => $this->layout->notification(1, 'Successfully added a user role.')
			];
		}else{
			$result['notification'] = $this->layout->notification(2, $this->validate_user_role());
		}
		echo json_encode($result);
	}

	public function update_user_role(){
		$result = [];
		if(is_array($this->validate_user_role())){
			$this->model_users->user_role_update(['user_role_id' => $this->input->post('user_role_id')], $this->validate_user_role());
			$result = [
				'user_roles_table' => $this->model_users->user_roles_table(),
				'notification' => $this->layout->notification(1, 'Successfully updated a user role.')
			];
		}else{
			$result['notification'] = $this->layout->notification(2, $this->validate_user_role());
		}
		echo json_encode($result);
	}

	public function delete_user_role(){
		$result = [];
		if($this->model_users->user_role_delete(['user_role_id' => $this->input->post('user_role_id')]) >= 1){
			$result = [
				'user_roles_table' => $this->model_users->user_roles_table(),
				'notification' => $this->layout->notification(1, 'Successfully deleted a user role.')
			];
		}
		echo json_encode($result);
	}

	public function ajax(){
		//USER VALUE
		if($this->input->post('user_id')){
			echo json_encode($this->model_users->user_value(['user_id' => $this->input->post('user_id')]));
		}
		//PERSON VALUE
		else if($this->input->post('person_id')){
			echo json_encode($this->model_users->person_value(['person_id' => $this->input->post('person_id')]));
		}
		//USER ROLE VALUE
		else if($this->input->post('user_role_id')){
			echo json_encode($this->model_users->user_role_value(['user_role_id' => $this->input->post('user_role_id')]));
		}
		//USER ROLES SELECTION
		else if($this->input->post('user_roles_selection')){
			$result = '<option value="">Choose User Role</option>';
			foreach ($this->model_users->user_roles() as $row) {
				$result .= '<option value="'.$row->user_role_id.'">'.$row->user_role.'</option>';
			}
			echo $result;
		}
		//PERSONS SELECTION
		else if($this->input->post('persons_selection')){
			$result = '<option value="">Choose Person</option>';
			foreach ($this->model_users->persons() as $row) {
				$result .= '<option value="'.$row->person_id.'">'.$row->lastname.', '.$row->firstname.' '.$row->middlename.'</option>';
			}
			echo $result;
		}
	}

}