<?php

class Model_applicants extends CI_Model
{
	public function __construct(){
        $this->load->database();
    }

    public function applicant_insert($values){
		$this->db->insert('applicants', $values);
		return $this->db->insert_id();
	}

	public function applicant_delete($where){
		$this->db->where($where)
			->delete('applicants');
		return $this->db->count_all_results();
	}

	public function applicant_update($where, $values){
		$this->db->where($where)
			->update('applicants', $values);
		return $this->db->count_all_results();
	}

	public function applicants($where = null){
		$this->db->select('*')->from('applicant_organizations')
			->join('applicants', 'applicant_organizations.applicant_id = applicants.applicant_id', 'left')
			->join('organizations', 'applicant_organizations.organization_id = organizations.organization_id', 'left');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function applicants_table($where = null){
		$this->table->set_heading('Org. Name', 'Fullname', 'Address', 'Mobile', 'Email Address', 'Requirements', 'Status', 'Action');
		$template = array(
	        'table_open'            => '<table class="table table-striped table-hover datatable" style="width:100%">',
	        'heading_cell_start'    => '<th class="text-center">'
		);
		$this->table->set_template($template);
		foreach ($this->applicants($where) as $row) {
			$this->table->add_row(
				$row->organization_name,
				$row->applicant_lastname.", ".$row->applicant_firstname." ".$row->applicant_middlename,
				$row->applicant_address,
				$row->applicant_mobile,
				$row->applicant_email_address,
				$this->applicant_requirement_details(['applicant_organization_id' => $row->applicant_organization_id, 'organization_id' => $row->organization_id]),
				$row->applicant_organization_status == 'Approved' ? '<b style="color: green;">'. $row->applicant_organization_status .'</b>':($row->applicant_organization_status == 'Disapproved' ? '<b style="color: orange;">'. $row->applicant_organization_status .'</b>':$row->applicant_organization_status),
				'<center>'.
					($row->applicant_organization_status == 'Approved' ? 
						'<button type="button" class="btn btn-default btn-xs" style="width: 90px;">
	                		<i class="fa fa-thumbs-up"></i> Approve
	                	</button>':
						'<a class="applicant_approve_btn" id="'.$row->applicant_organization_id.'" value="'.$row->applicant_id.'">
		                	<button type="button" class="btn btn-primary btn-xs" style="width: 90px;">
		                		<i class="fa fa-thumbs-up"></i> Approve
		                	</button>
		                </a>').
					($row->applicant_organization_status == 'Disapproved' ? 
						'<button type="button" class="btn btn-default btn-xs" style="width: 90px;">
		                		<i class="fa fa-thumbs-down"></i> Disapprove
		                	</button>':
						'<a class="applicant_disapprove_btn" id="'.$row->applicant_organization_id.'" value="'.$row->applicant_id.'">
		                	<button type="button" class="btn btn-warning btn-xs" style="width: 90px;">
		                		<i class="fa fa-thumbs-down"></i> Disapprove
		                	</button>
		                </a>').
	                '<a class="applicant_upd_btn" id="'.$row->applicant_id.'">
	                	<button type="button" class="btn btn-info btn-xs" style="width: 90px;">
	                		<i class="fa fa-edit"></i> Update
	                	</button>
	                </a>
					
	            </center>'
			);
		}
		return $this->table->generate();
	}

	public function applicants_for($where = null){
		$this->db->select('*')
			->from('applicants');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function applicant_value($where){
		$result = [];
		foreach ($this->applicants_for($where) as $row) {
			$result = [
				'applicant_id' => $row->applicant_id,
				'applicant_firstname' => $row->applicant_firstname,
				'applicant_middlename' => $row->applicant_middlename,
				'applicant_lastname' => $row->applicant_lastname,
				'applicant_gender' => $row->applicant_gender,
				'applicant_birthdate' => $row->applicant_birthdate,
				'applicant_address' => $row->applicant_address,
				'applicant_mobile' => $row->applicant_mobile,
				'applicant_email_address' => $row->applicant_email_address,
				'applicant_date_registered' => $row->applicant_date_registered,
				'applicant_username' => $row->applicant_username,
			];
		}
		return $result;
	}

	public function applicant_requirement_insert($values){
		$this->db->insert('applicant_requirements', $values);
		return $this->db->insert_id();
	}

	public function applicant_requirement_delete($where){
		$this->db->where($where)
			->delete('applicant_requirements');
		return $this->db->count_all_results();
	}

	public function applicant_requirement_update($where, $values){
		$this->db->where($where)
			->update('applicant_requirements', $values);
		return $this->db->count_all_results();
	}

	public function applicant_requirements($where = null){
		$this->db->select('*')->from('applicant_requirements');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function applicant_requirement_details($where = null){
		$description = [];
		foreach ($this->organization_requirements(['organization_id' => $where['organization_id']]) as $row) {
			array_push($description, $row->organization_requirement_description);
		}
		$requirements = ''; $count = 0;
		foreach ($this->applicant_requirements(['applicant_organization_id' => $where['applicant_organization_id']]) as $row) {
			$requirements .= '* '. $description[$count] .' <a href="'. base_url('assets/upload/'. $row->applicant_requirement_file_path) .'">'. $row->applicant_requirement_file_path .'</a> <br>';
			$count++;
		}
		return $requirements;
	}

	public function organization_requirements($where = null){
		$this->db->select('*')->from('organization_requirements');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	//APPLICANT ORGANIZATIONS
	public function applicant_organization_insert($values){
		$this->db->insert('applicant_organizations', $values);
		return $this->db->insert_id();
	}

	public function applicant_organization_delete($where){
		$this->db->where($where)
			->delete('applicant_organizations');
		return $this->db->count_all_results();
	}

	public function applicant_organization_update($where, $values){
		$this->db->where($where)
			->update('applicant_organizations', $values);
		return $this->db->count_all_results();
	}

	//APPLICANT ORGANIZATION MESSAGES
	public function applicant_organization_message_insert($values){
		$this->db->insert('applicant_organization_messages', $values);
		return $this->db->insert_id();
	}

	public function applicant_organization_message_delete($where){
		$this->db->where($where)
			->delete('applicant_organization_messages');
		return $this->db->count_all_results();
	}

	public function applicant_organization_message_update($where, $values){
		$this->db->where($where)
			->update('applicant_organization_messages', $values);
		return $this->db->count_all_results();
	}

	public function applicant_organization_messages($where = null){
		$this->db->select('*')->from('applicant_organization_messages');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

}

?>