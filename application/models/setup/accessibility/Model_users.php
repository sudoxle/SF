<?php

class Model_users extends CI_Model
{
	public function __construct(){
        $this->load->database();
    }

    //USERS
    public function user_insert($values){
		$this->db->insert('users', $values);
		return $this->db->insert_id();
	}

	public function user_delete($where){
		$this->db->where($where)
			->delete('users');
		return $this->db->count_all_results();
	}

	public function user_update($where, $values){
		$this->db->where($where)
			->update('users', $values);
		return $this->db->count_all_results();
	}
	
	public function users($where = null){
		$this->db->select('*')->from('users')
			->join('persons', 'users.person_id = persons.person_id', 'left')
			->join('user_roles', 'users.user_role_id = user_roles.user_role_id', 'left');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function users_table($where = null){
		$this->table->set_heading('Fullname', 'Username', 'User Role', 'Date Registered', 'Action');
		$template = array(
	        'table_open'            => '<table class="table table-striped table-hover datatable-users" style="width: 100%;">',
	        'heading_cell_start'    => '<th class="text-center">'
		);
		$this->table->set_template($template);
		foreach ($this->users($where) as $row) {
			if($row->user_id >= 2){
				$this->table->add_row(
					$row->lastname.", ".$row->firstname." ".$row->middlename,
					$row->username,
					$row->user_role,
					$row->date_reg,
					'<center>
						<a class="user_upd_btn" id="'.$row->user_id.'">
		                	<button type="button" class="btn btn-info btn-xs">
		                		<i class="fa fa-edit"></i> Update
		                	</button>
		                </a>
		                <a href="'.site_url('setup/accessibility/users/modules/'.$row->user_id).'">
		                	<button type="button" class="btn btn-primary btn-xs">
		                		<i class="fa fa-gears"></i> Modules
		                	</button>
		                </a>
						<a class="user_del_btn" id="'.$row->user_id.'">
		                	<button type="button" class="btn btn-danger btn-xs">
		                		<i class="fa fa-trash"></i> Remove
		                	</button>
		                </a>
		            </center>'
				);
			}
		}
		return $this->table->generate();
	}

	public function user_value($where){
		$result = [];
		foreach ($this->users($where) as $row) {
			$result = [
				'user_id' => $row->user_id,
				'username' => $row->username,
				'password' => $row->password,
				'user_role_id' => $row->user_role_id,
				'user_role' => $row->user_role,
				'person_id' => $row->person_id,
				'firstname' => $row->firstname,
				'middlename' => $row->middlename,
				'lastname' => $row->lastname,
				'email_address' => $row->email_address,
			];
		}
		return $result;
	}

	//PERSONS
	public function person_insert($values){
		$this->db->insert('persons', $values);
		return $this->db->insert_id();
	}

	public function person_delete($where){
		$this->db->where($where)
			->delete('persons');
		return $this->db->count_all_results();
	}

	public function person_update($where, $values){
		$this->db->where($where)
			->update('persons', $values);
		return $this->db->count_all_results();
	}

	public function persons($where = null){
		$this->db->select('*')->from('persons');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function persons_table($where = null){
		$this->table->set_heading('Fullname', 'Address', 'Mobile', 'Email Address', 'Action');
		$template = array(
	        'table_open'            => '<table class="table table-striped table-hover datatable-persons" style="width: 100%;">',
	        'heading_cell_start'    => '<th class="text-center">'
		);
		$this->table->set_template($template);
		foreach ($this->persons($where) as $row) {
			$this->table->add_row(
				$row->lastname.", ".$row->firstname." ".$row->middlename,
				$row->address,
				$row->mobile,
				$row->email_address,
				'<center>
					<a class="person_upd_btn" id="'.$row->person_id.'">
	                	<button type="button" class="btn btn-info btn-xs">
	                		<i class="fa fa-edit"></i> Update
	                	</button>
	                </a>
					<a class="person_del_btn" id="'.$row->person_id.'">
	                	<button type="button" class="btn btn-danger btn-xs">
	                		<i class="fa fa-trash"></i> Remove
	                	</button>
	                </a>
	            </center>'
			);
		}
		return $this->table->generate();
	}

	public function person_value($where){
		$result = [];
		foreach ($this->persons($where) as $row) {
			$result = [
				'person_id' => $row->person_id,
				'firstname' => $row->firstname,
				'middlename' => $row->middlename,
				'lastname' => $row->lastname,
				'gender' => $row->gender,
				'birthdate' => $row->birthdate,
				'address' => $row->address,
				'mobile' => $row->mobile,
				'email_address' => $row->email_address
			];
		}
		return $result;
	}

	//USER ROLES
	public function user_role_insert($values){
		$this->db->insert('user_roles', $values);
		return $this->db->insert_id();
	}

	public function user_role_delete($where){
		$this->db->where($where)
			->delete('user_roles');
		return $this->db->count_all_results();
	}

	public function user_role_update($where, $values){
		$this->db->where($where)
			->update('user_roles', $values);
		return $this->db->count_all_results();
	}

	public function user_roles($where = null){
		$this->db->select('*')->from('user_roles');
		if($where!=null){
			$this->db->where($where);	
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function user_roles_table($where = null){
		$this->table->set_heading('User Role', 'Action');
		$template = array(
	        'table_open'            => '<table class="table table-striped table-hover datatable-user-roles" style="width: 100%;">',
	        'heading_cell_start'    => '<th class="text-center">'
		);
		$this->table->set_template($template);
		foreach ($this->user_roles($where) as $row) {
			if($row->user_role_id >= 2){
				$this->table->add_row(
					$row->user_role,
					'<center>
						<a class="user_role_upd_btn" id="'.$row->user_role_id.'">
		                	<button type="button" class="btn btn-info btn-xs">
		                		<i class="fa fa-edit"></i> Update
		                	</button>
		                </a>
						<a class="user_role_del_btn" id="'.$row->user_role_id.'">
		                	<button type="button" class="btn btn-danger btn-xs">
		                		<i class="fa fa-trash"></i> Remove
		                	</button>
		                </a>
		            </center>'
				);
			}
		}
		return $this->table->generate();
	}

	public function user_role_value($where){
		$result = [];
		foreach ($this->user_roles($where) as $row) {
			$result = [
				'user_role_id' => $row->user_role_id,
				'user_role' => $row->user_role
			];
		}
		return $result;
	}

	public function user_module_insert($values){
		$this->db->insert('user_modules', $values);
		return $this->db->insert_id();
	}

	public function user_module_delete($where){
		$this->db->where($where)
			->delete('user_modules');
		return $this->db->count_all_results();
	}

}

?>