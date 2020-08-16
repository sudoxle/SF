<?php

class Model_home extends CI_Model
{
	public function __construct(){
        $this->load->database();
    }
	
	public function is_logged_in($where){
		$query = $this->db->select('*')
			->from('users')
			->join('user_roles', 'users.user_role_id = user_roles.user_role_id', 'left')
			->join('persons', 'users.person_id = persons.person_id', 'left')
			->where($where)
			->get();
		if($row = $query->row()){
			$this->session->set_userdata([
	            'login_id'  => $row->user_id,
	            'login_alias' => $row->firstname,
	            'login_type' => $row->user_role
	        ]);
	        return true;
		}else{
			$query = $this->db->select('*')
				->from('organization_users')
				->join('organizations', 'organization_users.organization_id = organizations.organization_id', 'left')
				->where([
					'organization_user_username' => $where['username'],
					'organization_user_password' => $where['password']])
				->get();
			if($row = $query->row()){
				$this->session->set_userdata([
		            'login_id'  => $row->organization_user_id,
		            'login_alias' => $row->organization_user_fullname,
		            'login_type' => 'Organization Admin',
		            'organization_id' => $row->organization_id,
		            'organization_name' => $row->organization_name
		        ]);
		        return true;
			}else{
				$query = $this->db->select('*')
					->from('applicants')
					->where([
						'applicant_username' => $where['username'],
						'applicant_password' => $where['password']])
					->get();
				if($row = $query->row()){
					$this->session->set_userdata([
			            'login_id'  => $row->applicant_id,
			            'login_alias' => $row->applicant_firstname,
			            'login_type' => 'Applicant',
			        ]);
			        return true;
				}else{	
					return false;
				}
			}
		}
	}

	public function user_update($where, $values){
		$count = 0;
		$query = $this->db->select('person_id')
			->from('persons')
			->where($where)
			->get();
		if($row = $query->row()){
			$this->db->where('person_id', $row->person_id)
				->update('users', $values);
			$count = $this->db->count_all_results();
		}
		return $count;
	}

	public function user_count($where = null){
		if($where!=null){
			$this->db->where($where);
		}
		$this->db->from('users')
			->join('persons', 'users.person_id = persons.person_id', 'left');
		return $this->db->count_all_results();
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

	public function organization_value($where){
		$result = [];
		foreach ($this->organizations($where) as $row) {
			$result = [
				'organization_id' => $row->organization_id,
				'organization_name' => $row->organization_name,
				'organization_address' => $row->organization_address,
				'organization_contact_no' => $row->organization_contact_no,
				'organization_email_address' => $row->organization_email_address,
				'organization_type' => $row->organization_type,
				'organization_scholarship_description' => $row->organization_scholarship_description,
			];
		}
		$image = [];
		foreach ($this->organization_images($where) as $row) {
			$image = [
				'organization_image_file_path' => $row->organization_image_file_path
			];
		}
		$courses = [];
		foreach ($this->organization_courses($where) as $row) {
			array_push($courses, [
				'organization_course' => $row->organization_course,
				'organization_course_type' => $row->organization_course_type,
			]);
		}
		$requirements = [];
		foreach ($this->organization_requirements($where) as $row) {
			array_push($requirements, [
				'organization_requirement_id' => $row->organization_requirement_id,
				'organization_requirement_description' => $row->organization_requirement_description,
				'organization_requirement_is_uploadable' => $row->organization_requirement_is_uploadable,
			]);
		}
		return array_merge($result, $image, ['organization_courses' => $courses], ['organization_requirements' => $requirements]);
	}

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

	public function organization_courses($where = null){
		$this->db->select('*')->from('organization_courses');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function organization_requirements($where = null){
		$this->db->select('*')->from('organization_requirements');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	//ORGANIZATION COURSES
	public function organization_courses_like($where1 = null, $where2 = null, $like = ''){
		$this->db->distinct()
			->select('organizations.organization_name, organizations.organization_type, organizations.organization_contact_no, organizations.organization_email_address, organizations.organization_address, organizations.organization_id')->from('organization_courses')
			->join('organizations', 'organization_courses.organization_id = organizations.organization_id', 'right');
		if($where1!=null){
			$this->db->group_start();
				$this->db->where($where1);
			$this->db->group_end();
		}
		if($where2!=null){
			$this->db->group_start();
				$this->db->where($where2);
			$this->db->group_end();
		}
		if($like!=''){
			$this->db->group_start();
				$this->db->like('organization_course', $like);
				$this->db->or_like('organizations.organization_name', $like);
				$this->db->or_like('organization_courses.organization_course', $like);
			$this->db->group_end();
		}
		$this->db->order_by('organizations.organization_name', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function organizations_grid($where = null){
		$display = '';
		foreach ($this->organizations($where) as $row) {
			$display .= $this->organization_grid_html([
				'organization_id' => $row->organization_id,
				'organization_name' => $row->organization_name,
				'organization_type' => $row->organization_type,
				'organization_contact_no' => $row->organization_contact_no,
				'organization_email_address' => $row->organization_email_address,
				'organization_address' => $row->organization_address,
			]);
		}
		return $display;
	}

	public function organization_courses_grid($where1 = null, $where2 = null, $like = ''){
		$display = '';
		foreach ($this->organization_courses_like($where1, $where2, $like) as $row) {
			$display .= $this->organization_grid_html_list([
				'organization_id' => $row->organization_id,
				'organization_name' => $row->organization_name,
				'organization_type' => $row->organization_type,
				'organization_contact_no' => $row->organization_contact_no,
				'organization_email_address' => $row->organization_email_address,
				'organization_address' => $row->organization_address,
			]);
		}
		return $display;
	}

	private function organization_grid_html($values){
		$display = '<div class="col-sm-3" style="height: 500px;">
				<a href="'. site_url('home/organization/'. $values['organization_id']) .'">
	                <div class="ibox">
	                    <div class="ibox-content product-box">
	                        <div class="product-imitation">
	                        	<center>
	                        		<img src="'. ($this->organization_images_count(['organization_id' => $values['organization_id']]) >= 1 ? base_url('assets/upload/'.$this->organization_image_file_path(['organization_id' => $values['organization_id']])):
	                        			base_url('assets/images/default.png')) .'" class="img-responsive" style="height: 164px; width: 164px;">
	                        	</center>
	                        </div>
	                        <div class="product-desc">
	                            <span class="product-price" style="width: 100%;">'.
	                                $values['organization_name']
	                            .'</span>
	                            <small class="text-muted">'.
	                                $values['organization_type']
	                            .'</small>
	                            <a href="#" class="product-name">'.
	                                $values['organization_contact_no']
	                            .'</a>
	                            <div class="small m-t-xs">'.
	                            	'* '. $values['organization_email_address'] .'<br>'.
	                                '* '. $values['organization_address']
	                            .'</div>
	                        </div>
	                    </div>
	                </div>
	            </a>
            </div>';
		return $display;
	}

	private function organization_grid_html_list($values){
		$display = '<div class="feed-element">
                <a href="#" class="pull-left">
                    <img src="'. ($this->organization_images_count(['organization_id' => $values['organization_id']]) >= 1 ? base_url('assets/upload/'.$this->organization_image_file_path(['organization_id' => $values['organization_id']])):
                    			base_url('assets/images/default.png')) .'" class="img-responsive" style="height: 65px; width: 65px;">
                </a>
                <div class="media-body ">
                    <a href="'. site_url('home/organization/'. $values['organization_id']) .'">
                    	<strong>'. $values['organization_name'] .'</strong> <br>
                	</a>
                    <small class="text-muted">'.
                        $values['organization_type']
                    .'</small>
                    <div class="well">'.
                    		'* '. $values['organization_contact_no'] .'<br>'.
                        	'* '. $values['organization_email_address'] .'<br>'.
                            '* '. $values['organization_address']
                    .'</div>
                </div>
            </div>';
		return $display;
	}

	//APPLICANTS
	public function applicants_count($where = null){
		if($where!=null){
			$this->db->where($where);
		}
		$this->db->from('applicants');
		return $this->db->count_all_results();
	}

	//APPLICANT ORGANIZATIONS
	public function applicant_organizations_count($where = null){
		if($where!=null){
			$this->db->where($where);
		}
		$this->db->from('applicant_organizations');
		return $this->db->count_all_results();
	}

}

?>