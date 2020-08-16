<?php

class Model_organizations extends CI_Model
{
	public function __construct(){
        $this->load->database();
    }

    public function organization_insert($values){
		$this->db->insert('organizations', $values);
		return $this->db->insert_id();
	}

	public function organization_delete($where){
		$this->db->where($where)
			->delete('organizations');
		return $this->db->count_all_results();
	}

	public function organization_update($where, $values){
		$this->db->where($where)
			->update('organizations', $values);
		return $this->db->count_all_results();
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
		$this->table->set_heading('Org. Name', 'Address', 'Contact No.', 'Email Address', 'Org. Type', 'Image', 'Action');
		$template = array(
	        'table_open'            => '<table class="table table-striped table-hover datatable" style="width:100%">',
	        'heading_cell_start'    => '<th class="text-center">'
		);
		$this->table->set_template($template);
		foreach ($this->organizations($where) as $row) {
			$this->table->add_row(
				$row->organization_name,
				$row->organization_address,
				$row->organization_contact_no,
				$row->organization_email_address,
				$row->organization_type,
				'<center>
					<a class="organization_img_btn" id="'.$row->organization_id.'">'.
						($this->organization_images_count(['organization_id' => $row->organization_id]) >= 1 ? 
							'<img src="'. base_url('assets/upload/'.$this->organization_image_file_path(['organization_id' => $row->organization_id])) .'" class="img-responsive img-circle img-small" style="width:50px; height:50px;">':
							'<img src="'. base_url('assets/images/default.png') .'" class="img-responsive img-circle img-small" style="width:50px; height:50px;">')
					.'</a>
	            </center>',
				'<center>
					<a class="organization_upd_btn" id="'.$row->organization_id.'">
	                	<button type="button" class="btn btn-info btn-xs">
	                		<i class="fa fa-edit"></i> Update
	                	</button>
	                </a>
	                <a href="'. site_url('organizations/organizations/preview/'. $row->organization_id) .'">
	                	<button type="button" class="btn btn-primary btn-xs">
	                		<i class="fa fa-search"></i> Preview
	                	</button>
	                </a>
					<a class="organization_del_btn" id="'.$row->organization_id.'">
	                	<button type="button" class="btn btn-danger btn-xs">
	                		<i class="fa fa-trash"></i> Remove
	                	</button>
	                </a>
	            </center>'
			);
		}
		return $this->table->generate();
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
		return $result;
	}

	public function organization_image_insert($values){
		$this->db->insert('organization_images', $values);
		return $this->db->insert_id();
	}

	public function organization_image_delete($where){
		$this->db->where($where)
			->delete('organization_images');
		return $this->db->count_all_results();
	}

	public function organization_image_update($where, $values){
		$this->db->where($where)
			->update('organization_images', $values);
		return $this->db->count_all_results();
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

}

?>