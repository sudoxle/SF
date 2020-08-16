<?php

class Model_organization_users extends CI_Model
{
	public function __construct(){
        $this->load->database();
    }

    public function organization_user_insert($values){
		$this->db->insert('organization_users', $values);
		return $this->db->insert_id();
	}

	public function organization_user_delete($where){
		$this->db->where($where)
			->delete('organization_users');
		return $this->db->count_all_results();
	}

	public function organization_user_update($where, $values){
		$this->db->where($where)
			->update('organization_users', $values);
		return $this->db->count_all_results();
	}

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
		$this->table->set_heading('Org. Name', 'Fullname', 'Gender', 'Birthdate', 'Mobile', 'Email Address', 'Username', 'Action');
		$template = array(
	        'table_open'            => '<table class="table table-striped table-hover datatable" style="width:100%">',
	        'heading_cell_start'    => '<th class="text-center">'
		);
		$this->table->set_template($template);
		foreach ($this->organization_users($where) as $row) {
			$this->table->add_row(
				$row->organization_name,
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
					<a class="organization_user_del_btn" id="'.$row->organization_user_id.'">
	                	<button type="button" class="btn btn-danger btn-xs">
	                		<i class="fa fa-trash"></i> Remove
	                	</button>
	                </a>
	            </center>'
			);
		}
		return $this->table->generate();
	}

	public function organization_user_value($where){
		$result = [];
		foreach ($this->organization_users($where) as $row) {
			$result = [
				'organization_user_id' => $row->organization_user_id,
				'organization_user_username' => $row->organization_user_username,
				'organization_user_password' => $row->organization_user_password,
				'organization_user_fullname' => $row->organization_user_fullname,
				'organization_user_gender' => $row->organization_user_gender,
				'organization_user_birthdate' => $row->organization_user_birthdate,
				'organization_user_address' => $row->organization_user_address,
				'organization_user_mobile' => $row->organization_user_mobile,
				'organization_user_email_address' => $row->organization_user_email_address,
				'organization_id' => $row->organization_id
			];
		}
		return $result;
	}

}

?>