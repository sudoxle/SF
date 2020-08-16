<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scholarship Finder</title>
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/images/logo_fsuu.png">
    <?php $this->load->view('resources/scripts/css'); ?>
</head>
<body id="page-top" class="landing-page">
    <!-- NAVIGATION -->
    <div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?=
                        ($this->session->login_type == 'Applicant') ? 
                            '<a class="navbar-brand" href="'. site_url('system') .'">'. strtoupper($this->session->login_alias .'\'s Profile') .'</a>':
                            '<a class="navbar-brand" href="#">SCHOLARSHIP FINDER</a>'
                    ?>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="page-scroll" href="<?= site_url() ?>#page-top">Home</a></li>
                        <?=
                            ($this->session->login_type == 'Applicant') ? 
                                '':
                                '<li><a class="page-scroll" href="'. site_url() .'#registration">Sign-In / Registration</a></li>'
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- END NAVIGATION -->
    <!-- SLIDER -->
    <div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#inSlider" data-slide-to="0" class="active"></li>
            <li data-target="#inSlider" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Paying for school just got easier.</h1>
                        <p>Scholarship Finder is your connection to scholarships, colleges, financial aid and more.</p>
                        <p>
                            <a class="btn btn-lg btn-primary" href="<?= site_url() ?>#registration" role="button">READ MORE</a>
                            <a class="caption-link" href="#" role="button">About Scholarships</a>
                        </p>
                    </div>
                    <div class="carousel-image wow zoomIn">
                    </div>
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back one"></div>
            </div>
            <div class="item">
                <div class="container">
                    <div class="carousel-caption blank">
                    </div>
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back two"></div>
            </div>
        </div>
        <a class="left carousel-control" href="#inSlider" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#inSlider" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- END SLIDER -->
    <!-- SCHOLARSHIPS -->
    <section id="scholarships" class="container services">
        <!-- NOTIFICATION -->
        <div class="col-sm-12">
            <?= empty($notification) ? '':$notification ?>
        </div>
        <!-- END NOTIFICATION -->
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1><?= $organization_value['organization_name'] ?></h1>
            </div>
            <div class="col-lg-12">
                <!-- ORGANIZATION CONTENT -->
                <div class="ibox product-detail">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="
                                    <?php
                                        if(!empty($organization_value['organization_image_file_path']))
                                            echo base_url('assets/upload/'.$organization_value['organization_image_file_path']);
                                        else
                                            echo base_url('assets/images/default.png');
                                    ?>" style="width: 80%; height: 80%;">
                            </div>
                            <div class="col-md-7">
                                <h2 class="font-bold m-b-xs">
                                    <?= $organization_value['organization_address'] ?>
                                </h2>
                                <small>Email Address: <?= $organization_value['organization_email_address'] ?></small>
                                <div class="m-t-md">
                                    <h2 class="product-main-price"><?= $organization_value['organization_contact_no'] ?> </h2>
                                </div>
                                <hr>
                                <h4>No. of Applicants: <?= $applicants_count ?></h4>
                                <h4><?= $organization_value['organization_type'] ?></h4>
                                <?= $organization_value['organization_scholarship_description'] ?>
                                <br/><hr>
                                <h4>Scholarship Offered by Courses: </h4>
                                <?php
                                    foreach ($organization_value['organization_courses'] as $value) {
                                        echo '<b>'. $value['organization_course'] .'</b> ('. $value['organization_course_type'] .')<br>';
                                    }
                                ?>
                                <hr>
                                <h4>Scholarship Requirements: </h4>
                                <?php
                                    foreach ($organization_value['organization_requirements'] as $value) {
                                        echo '<b> * '. $value['organization_requirement_description'] .'</b> <br>';
                                    }
                                ?>
                                <hr>
                                <div>
                                    <?=
                                        ($this->session->login_type == 'Applicant') ? 
                                            '<a class="applicant_apply_btn" id="'. $organization_value['organization_id'] .'">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i> Apply Now
                                                </button>
                                            </a>':
                                            ''
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-footer"></div>
                </div>
                <!-- END ORGANIZATION CONTENT -->
            </div>
        </div>
    </section>
    <!-- END SCHOLARSHIPS -->
    <section class="navy-section testimonials" style="margin-top: 0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center wow zoomIn">
                </div>
            </div>
        </div>
    </section>
    <!-- APPLICANT FORM -->
    <?= $applicant_form_open ?>
        <div class="row">
            <div class="col-lg-12">
                <h2>List of Requirements</h2>
                <hr>
                <?php
                    $count = 0;
                    foreach ($organization_value['organization_requirements'] as $value) {
                        if($value['organization_requirement_is_uploadable'] == 'uploadable'){
                            echo '<div class="form-group">
                                <label>'. $value['organization_requirement_description'] .' </label>
                                <input type="file" name="applicant_requirement_file_path'. $count .'" required>
                            </div>';
                        }
                        $count++;
                    }
                ?>
            </div>
        </div>
    <?= $applicant_form_close ?>
    <!-- END APPLICANT FORM -->
    <?php $this->load->view('resources/scripts/js'); ?>
    <script type="text/javascript">
        //File Input
        <?php
            $count = 0;
            foreach ($organization_value['organization_requirements'] as $value) {
                if($value['organization_requirement_is_uploadable'] == 'uploadable'){
                    echo '$(\'input[name="applicant_requirement_file_path'. $count .'"]\').fileinput({
                        dropZoneEnabled: true,
                        showUpload: false,
                        showRemove: false,
                        allowedFileExtensions: ["jpg", "jpeg", "png", "docx", "doc", "xls", "xlsx", "ppt", "pptx", "pdf"]
                    });';
                    $count++;
                }
            }
        ?>
        //Applicant Form
        $(document).on("click", '.applicant_apply_btn', function(e){
            $('input[name="organization_id"]').val($(this).attr('id'));
            $('#applicant_modal').modal({backdrop: true});
        });
        // Landing Page Scripts
        $(document).ready(function () {
            $('body').scrollspy({
                target: '.navbar-fixed-top',
                offset: 80
            });
            // Page Scrolling Feature
            $('a.page-scroll').bind('click', function(event) {
                var link = $(this);
                $('html, body').stop().animate({
                    scrollTop: $(link.attr('href')).offset().top - 50
                }, 500);
                event.preventDefault();
            });
        });
        var cbpAnimatedHeader = (function() {
            var docElem = document.documentElement,
                    header = document.querySelector( '.navbar-default' ),
                    didScroll = false,
                    changeHeaderOn = 200;
            function init() {
                window.addEventListener( 'scroll', function( event ) {
                    if( !didScroll ) {
                        didScroll = true;
                        setTimeout( scrollPage, 250 );
                    }
                }, false );
            }
            function scrollPage() {
                var sy = scrollY();
                if ( sy >= changeHeaderOn ) {
                    $(header).addClass('navbar-scroll')
                }
                else {
                    $(header).removeClass('navbar-scroll')
                }
                didScroll = false;
            }
            function scrollY() {
                return window.pageYOffset || docElem.scrollTop;
            }
            init();
        })();
        // Activate WOW.js Plugin for Animation Scroll
        new WOW().init();
    </script>
</body>
</html>