<?php

class Model_organization_requirements extends CI_Model
{
	public function __construct(){
        $this->load->database();
    }

	public function organizations($where = null){
		$this->db->select('*')->from('organizations');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function organizations_table($where = null){
		$this->table->set_heading('Org. Name', 'Org. Type', 'Org. Courses', 'Org. Requirements', 'Action');
		$template = array(
	        'table_open'            => '<table class="table table-striped table-hover datatable" style="width:100%">',
	        'heading_cell_start'    => '<th class="text-center">'
		);
		$this->table->set_template($template);
		foreach ($this->organizations($where) as $row) {
			$this->table->add_row(
				$row->organization_name,
				$row->organization_type,
				$this->organization_course_details(['organization_id' => $row->organization_id]),
				$this->organization_requirement_details(['organization_id' => $row->organization_id]),
				'<center>
					<a class="organization_upd_btn" id="'.$row->organization_id.'">
	                	<button type="button" class="btn btn-info btn-xs">
	                		<i class="fa fa-edit"></i> Update
	                	</button>
	                </a>
	            </center>'
			);
		}
		return $this->table->generate();
	}

	public function organization_requirement_insert($values){
		$this->db->insert('organization_requirements', $values);
		return $this->db->insert_id();
	}

	public function organization_requirement_delete($where){
		$this->db->where($where)
			->delete('organization_requirements');
		return $this->db->count_all_results();
	}

	public function organization_requirements($where = null){
		$this->db->select('*')->from('organization_requirements');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function organization_requirement_value($where){
		$result = [];
		foreach ($this->organization_requirements($where) as $row) {
			array_push($result, [
				'organization_requirement_id' => $row->organization_requirement_id,
				'organization_requirement_description' => $row->organization_requirement_description,
				'organization_requirement_is_uploadable' => $row->organization_requirement_is_uploadable,
				'organization_id' => $row->organization_id,
			]);
		}
		return $result;
	}

	public function organization_requirement_details($where = null){
		$details = '';
		foreach ($this->organization_requirements($where) as $row) {
			$details .=  '* ' . $row->organization_requirement_description . '<br>';
		}
		return $details;
	}

	public function organization_course_insert($values){
		$this->db->insert('organization_courses', $values);
		return $this->db->insert_id();
	}

	public function organization_course_delete($where){
		$this->db->where($where)
			->delete('organization_courses');
		return $this->db->count_all_results();
	}

	public function organization_courses($where = null){
		$this->db->select('*')->from('organization_courses');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function organization_course_value($where){
		$result = [];
		foreach ($this->organization_courses($where) as $row) {
			array_push($result, [
				'organization_course_id' => $row->organization_course_id,
				'organization_course' => $row->organization_course,
				'organization_course_type' => $row->organization_course_type,
				'organization_id' => $row->organization_id,
			]);
		}
		return $result;
	}

	public function organization_course_details($where = null){
		$details = '';
		foreach ($this->organization_courses($where) as $row) {
			$details .=  '* <b>' . $row->organization_course . '</b> (' . $row->organization_course_type . ') <br>';
		}
		return $details;
	}

}

?>