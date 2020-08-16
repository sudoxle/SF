<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Layout {

	private $ALERT_TYPE = [1=>'Success', 2=>'Error', 3=>'Warning', 4=>'Information'];
    private $ALERT_DIV_TYPE = ['Success'=>'alert-success', 'Error'=>'alert-danger', 'Warning'=>'alert-warning', 'Information'=>'alert-info'];

    public function notification($alert_type, $alert_text = '', $alert_url = null){
        return '<!-- Notification Div -->
        <div class="alert '.$this->ALERT_DIV_TYPE[$this->ALERT_TYPE[$alert_type]].'">
        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        	<strong>'.$this->ALERT_TYPE[$alert_type].'!</strong> '.$alert_text.'
        </div>
        <!-- End Notification Div -->'.
        ($alert_url == null ? '':$this->redirect($alert_url));
    }

    public function redirect($url = ''){
        return '<!-- Redirect Script -->
        <script type="text/javascript">
            window.location.href="'.site_url($url).'"
        </script>
        <!-- End Redirect Script -->';
    }

    public function confirmation($modal_name, $modal_text = '', $modal_size = ''){
        return '<!-- Confirmation Modal -->
        <div id="'.strtolower(str_replace(' ', '_', $modal_name)).'_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog '.$modal_size.'">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">'.$modal_name.' Confirmation</h4>
                    </div>
                    <div class="modal-body">
                    	<p>'.$modal_text.'</p>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-default" id="'.strtolower(str_replace(' ', '_', $modal_name)).'_yes">Yes</a>
                        <a type="button" class="btn btn-primary" data-dismiss="modal">No</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Confirmation Modal -->'; 
    }

    public function modal_form_open($form_name, $form_action = '', $form_type = false, $form_size = ''){
		return '<!-- Modal Form -->
		<div id="'.strtolower(str_replace(' ', '_', $form_name)).'_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          	<div class="modal-dialog '.$form_size.'">
            	<div class="modal-content">
                	<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">'.$form_name.' <small>Form</small></h4>
                	</div>
                	'.($form_type == false ? form_open($form_action, 'id="'.strtolower(str_replace(' ', '_', $form_name)).'_form"'):form_open_multipart($form_action, 'id="'.strtolower(str_replace(' ', '_', $form_name)).'_form"')).'
                    	<div class="modal-body">
                    	<!-- Modal Form Content -->';
	}

	public function modal_form_close($btn_name = 'Save'){
		return '<!-- End Modal Form Content -->
					</div>		
						<div class="modal-footer">
							'.form_button([
                                'type' => 'submit',
                                'content' => '<i class="fa fa-check-square"></i> '.$btn_name,
                                'class' => 'btn btn-primary pull-right'
                            ]).'
                        </div>
                    '.form_close().'
                </div>
        	</div>
        </div>
        <!-- End Modal Form -->';
	}

}