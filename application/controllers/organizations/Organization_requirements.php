<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Organization_requirements extends Core_Controller  {

	public function __construct() {
		parent::__construct();
		$this->load->model('model_system');
		$this->model_system->is_accessible();
		$this->load->model('organizations/model_organization_requirements');
	}

	public function index(){
		$data = [
			'web_title' => 'Scholarship Finder System | Organization Requirements & Courses',
			'modules' => $this->model_system->user_modules(['user_id' => $this->session->login_id]),
			'organizations_table' => $this->model_organization_requirements->organizations_table(),
			'organization_requirement_form_open' => $this->layout->modal_form_open('Organization Requirement', 'organizations/organization_requirements/update'),
			'organization_requirement_form_close' => $this->layout->modal_form_close(),
		];
		$this->load->view('interface/system/organizations/main_organization_requirements', $data);
	}

	public function update(){
		$result = [];
		if($this->input->post('organization_id')){
			//Delete Requirements & Courses
			$this->model_organization_requirements->organization_course_delete(['organization_id' => $this->input->post('organization_id')]);
			$this->model_organization_requirements->organization_requirement_delete(['organization_id' => $this->input->post('organization_id')]);
			//Insert Requirements & Courses
			$count = 0;
			foreach ($this->input->post('organization_course[]') as $organization_course) {
				$this->model_organization_requirements->organization_course_insert([
					'organization_course' => $organization_course .'; ('. $this->input->post('organization_school[]')[$count] .')',
					'organization_course_type' => $this->input->post('organization_course_type[]')[$count],
					'organization_id' => $this->input->post('organization_id')
				]);
				$count++;
			}
			$count = 0;
			foreach ($this->input->post('organization_requirement_description[]') as $organization_requirement_description) {
				$this->model_organization_requirements->organization_requirement_insert([
					'organization_requirement_description' => $organization_requirement_description,
					'organization_requirement_is_uploadable' => empty($this->input->post('organization_requirement_is_uploadable[]')[$count]) ? '':$this->input->post('organization_requirement_is_uploadable[]')[$count],
					'organization_id' => $this->input->post('organization_id')
				]);
				$count++;
			}
			$result = [
				'organizations_table' => $this->model_organization_requirements->organizations_table(),
				'notification' => $this->layout->notification(1, 'Successfully updated an organization requirements and courses.')
			];
		}
		echo json_encode($result);
	}

	public function ajax(){
		//ORGANIZATION REQUIREMENT & COURSE VALUE
		if($this->input->post('organization_id')){
			$organization_course_array = $this->model_organization_requirements->organization_course_value(['organization_id' => $this->input->post('organization_id')]);
			$organization_requirement_array = $this->model_organization_requirements->organization_requirement_value(['organization_id' => $this->input->post('organization_id')]);
			echo json_encode([
				'organization_course' => $organization_course_array, 
				'organization_requirement' => $organization_requirement_array, 
			]);
		}
	}

}
