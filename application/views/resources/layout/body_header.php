<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= empty($web_title) ? '':$web_title ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/images/logo_fsuu.png">
    <?php $this->load->view('resources/scripts/css'); ?>
    <style type="text/css">
        #side_menu{
            <?= $this->session->login_type == 'Organization Admin' || $this->session->login_type == 'Applicant' ? 'display: none;':'' ?>
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <?php $this->load->view('resources/layout/side_menu'); ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0;">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <!-- HEADER MENU -->
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">
                                Welcome <?= $this->session->login_type.' : '.$this->session->login_alias ?>
                            </span>
                        </li>
                        <li>
                            <a href="#LogoutModal" data-toggle="modal">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                    <!-- END HEADER MENU -->
                </nav>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-6">
                    <?php
                        $count = $this->uri->total_segments();
                        $result = '<h2>'.
                                ($this->uri->segment(1)=='system' ? 
                                    $this->session->organization_name != null ? 
                                        $this->session->organization_name:
                                        'Scholarship Finder System': 
                                    (is_numeric($this->uri->segment($count)) ? 
                                        ucwords(str_replace("_", " ", $this->uri->segment($count-1))):
                                        ucwords(str_replace("_", " ", $this->uri->segment($count)))
                                    )
                                )
                            .'</h2>
                            <ol class="breadcrumb">';
                        for($x = 1; $x <= $count ;$x++){
                            if(!is_numeric($this->uri->segment($x+1))){
                                if($x == $count){
                                    $result .= '<li class="active">
                                        <strong>'.ucwords(str_replace("_", " ", $this->uri->segment($x))).'</strong>
                                    </li>';
                                }else{
                                    $result .= '<li>
                                        '.ucwords(str_replace("_", " ", $this->uri->segment($x))).'
                                    </li>';
                                }
                            }else{
                                $result .= '<li class="active">
                                    <strong>'.ucwords(str_replace("_", " ", $this->uri->segment($x))).'</strong>
                                </li>';
                                break;
                            }
                        }
                        $result .= '</ol>';
                        echo $result;
                    ?>
                </div>
                <div class="col-lg-6" style="padding-top: 25px;margin-bottom: -25px;">
                    <div id="notification"></div>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <!-- LOGOUT MODAL -->
                <div id="LogoutModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Logout Confirmation</h4>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to logout?
                            </div>
                            <div class="modal-footer">
                                <a href="<?= site_url('home/logout') ?>" type="button" class="btn btn-default">Yes</a>
                                <a type="button" class="btn btn-primary" data-dismiss="modal">No</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END LOGOUT MODAL -->