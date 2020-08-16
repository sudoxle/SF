<?php

class Model_system extends CI_Model
{
	public function __construct(){
        $this->load->database();
    }

	public function is_accessible(){
		if(!$this->session->has_userdata('login_id') && $this->uri->segment(1)!='home'){
			redirect('home');
		}
		else if($this->session->has_userdata('login_id') && $this->uri->segment(1)!='home'){
			$flag = false;
			foreach ($this->user_modules(['user_id' => $this->session->login_id]) as $key => $value) {
				$url = str_replace(site_url(), "", current_url());
				if(strpos($url, $value)!==false){
					$flag = true;
					break;
				}
			}
			if($flag == false){
				redirect('system');
			}
		}
	}

    public function user_modules($where){
		$result = [];
		$query = $this->db->select('*')
			->from('user_modules')
			->where($where)
			->get();
		foreach($query->result() as $row){
			$data = explode('/', $row->user_module);
			$result[$data[count($data)-1]] = $row->user_module;
		}
		return $result;
	}

	//APPLICANTS
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
		$this->table->set_heading('Date', 'Fullname', 'Address', 'Mobile', 'Email Address', 'Requirements', 'Status', 'Action');
		$template = array(
	        'table_open'            => '<table class="table table-striped table-hover datatable-applicants" style="width:100%">',
	        'heading_cell_start'    => '<th class="text-center">'
		);
		$this->table->set_template($template);
		foreach ($this->applicants($where) as $row) {
			$this->table->add_row(
				$row->applicant_date_registered,
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
					($row->applicant_organization_status == 'Disapproved' ? '':
						'<a class="applicant_disapprove_btn" id="'.$row->applicant_organization_id.'" value="'.$row->applicant_id.'">
		                	<button type="button" class="btn btn-warning btn-xs" style="width: 90px;">
		                		<i class="fa fa-thumbs-down"></i> Disapprove
		                	</button>
		                </a>').
	                '<a class="applicant_upd_btn" id="'.$row->applicant_id.'">
	                	<button type="button" class="btn btn-info btn-xs" style="width: 90px;">
	                		<i class="fa fa-edit"></i> Update
	                	</button>
	                </a>'.
	                ($row->applicant_organization_status == 'Disapproved' ? 
						'<a class="applicant_del_btn" id="'.$row->applicant_id.'" value="'.$row->organization_id.'-'.$row->applicant_organization_id.'">
	                	<button type="button" class="btn btn-danger btn-xs" style="width: 90px;">
	                		<i class="fa fa-trash"></i> Remove
	                	</button>
	                </a>':'').
	            '</center>'
			);
		}
		return $this->table->generate();
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

	//ORGANIZATIONS
	public function organizations($where = null){
		$this->db->select('*')->from('organizations')
			->order_by('organization_name', 'ASC');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function organizations_table($where = null){
		$this->table->set_heading('Org. Name', 'Org. Type', 'Org. Courses', 'Org. Requirements', 'Action');
		$template = array(
	        'table_open'            => '<table class="table table-striped table-hover datatable-organization" style="width:100%">',
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

	public function organization_requirements($where = null){
		$this->db->select('*')->from('organization_requirements');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function organization_requirement_details($where = null){
		$details = '';
		foreach ($this->organization_requirements($where) as $row) {
			$details .=  '* ' . $row->organization_requirement_description . '<br>';
		}
		return $details;
	}

	public function organization_courses($where = null){
		$this->db->select('*')->from('organization_courses');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function organization_course_details($where = null){
		$details = '';
		foreach ($this->organization_courses($where) as $row) {
			$details .=  '* <b>' . $row->organization_course . '</b> (' . $row->organization_course_type . ') <br>';
		}
		return $details;
	}

	//ORGANIZATION IMAGES
	public function organization_images($where = null){
		$this->db->select('*')->from('organization_images');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function organization_images_count($where = null){
		if($where!=null){
			$this->db->where($where);
		}
		$this->db->from('organization_images');
		return $this->db->count_all_results();
	}

	private function organization_image_file_path($where = null){
		$file_path = '';
		foreach($this->organization_images($where) as $row){
			$file_path = $row->organization_image_file_path; 
		}
		return $file_path;
	}

	//ORGANIZATION USERS
	public function organization_users($where = null){
		$this->db->select('*')->from('organization_users')
			->join('organizations', 'organization_users.organization_id = organizations.organization_id', 'left');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function organization_users_table($where = null){
		$this->table->set_heading('Fullname', 'Gender', 'Birthdate', 'Mobile', 'Email Address', 'Username', 'Action');
		$template = array(
	        'table_open'            => '<table class="table table-striped table-hover datatable-organization-users" style="width:100%">',
	        'heading_cell_start'    => '<th class="text-center">'
		);
		$this->table->set_template($template);
		foreach ($this->organization_users($where) as $row) {
			$this->table->add_row(
				$row->organization_user_fullname,
				$row->organization_user_gender,
				$row->organization_user_birthdate,
				$row->organization_user_mobile,
				$row->organization_user_email_address,
				$row->organization_user_username,
				'<center>
					<a class="organization_user_upd_btn" id="'.$row->organization_user_id.'">
	                	<button type="button" class="btn btn-info btn-xs">
	                		<i class="fa fa-edit"></i> Update
	                	</button>
	                </a>
	            </center>'
			);
		}
		return $this->table->generate();
	}

	//APPLICANT ORGANIZATIONS
	public function applicant_organizations($where = null){
		$this->db->select('*')->from('applicant_organizations')
			->join('organizations', 'applicant_organizations.organization_id = organizations.organization_id', 'left');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function applicant_organizations_list($where = null){
		$display = '';
		foreach ($this->applicant_organizations($where) as $row) {
			$display .= $this->organization_grid_html_list([
				'organization_id' => $row->organization_id,
				'organization_name' => $row->organization_name,
				'organization_type' => $row->organization_type,
				'organization_contact_no' => $row->organization_contact_no,
				'organization_email_address' => $row->organization_email_address,
				'organization_address' => $row->organization_address,
				'applicant_organization_date_applied' => $row->applicant_organization_date_applied,
				'applicant_organization_id' => $row->applicant_organization_id,
				'applicant_organization_status' => $row->applicant_organization_status,
			]);
		}
		return $display;
	}

	private function organization_grid_html_list($values){
		$display = '<div class="feed-element">
                <a href="#" class="pull-left">
                    <img src="'. ($this->organization_images_count(['organization_id' => $values['organization_id']]) >= 1 ? base_url('assets/upload/'.$this->organization_image_file_path(['organization_id' => $values['organization_id']])):
                    			base_url('assets/images/default.png')) .'" class="img-responsive" style="height: 65px; width: 65px;">
                </a>
                <div class="media-body">
                	<small class="pull-right">'. $values['applicant_organization_date_applied'] .'</small>
                    <a href="'. site_url('home/organization/'. $values['organization_id']) .'">
                    	<strong>'. $values['organization_name'] .'</strong> <br>
                	</a>
                    <small class="text-muted">'.
                        $values['organization_type']
                    .'</small> <br>'.
                		'* '. $values['organization_contact_no'] .'<br>'.
                    	'* '. $values['organization_email_address'] .'<br>'.
                        '* '. $values['organization_address']
                    .'<div class="well">
                    	<h5>Status (with Message):</h5>';
                    	foreach ($this->applicant_organization_messages(['applicant_organization_id' => $values['applicant_organization_id']]) as $row) {
                    		$display .= '* '. $row->applicant_organization_message_status .': <p>'. $row->applicant_organization_message .'</p> <small class="text-muted"> - '. $row->applicant_organization_message_date .'</small>
                    		<hr>';
                    	}
        $display .= (($values['applicant_organization_status'] == 'Disapproved') ? 
                        '<a class="applicant_apply_btn pull-right" id="'. $values['organization_id'] .'" value="'. $values['applicant_organization_id'] .'">
                            <button class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Re-Apply
                            </button>
                        </a><br><br>':'')
        			.'</div>
                </div>
            </div>';
		return $display;
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