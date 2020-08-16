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
                        <li><a class="page-scroll" href="#page-top">Home</a></li>
                        <?=
                            ($this->session->login_type == 'Applicant') ? 
                                '':
                                '<li><a class="page-scroll" href="#registration">Registration</a></li>'
                        ?>
                        <li><a class="page-scroll" href="#offerings">Offerings</a></li>
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
                            <a class="btn btn-lg btn-primary" href="#registration" role="button">READ MORE</a>
                            <a class="caption-link" href="<?php echo base_url('index.php/home/example') ?>" role="button">About Scholarships</a>
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
        <hr>
        <?=
            ($this->session->login_type == 'Applicant') ? 
                '':
                '<div class="col-lg-12">
                    <div class="col-lg-12 text-center">
                        <div class="navy-line"></div>
                        <h1>Sign-In</h1>
                        <hr>
                        <!-- NOTIFICATION -->
                        <div id="notification_login"></div>
                        <!-- END NOTIFICATION -->
                    </div>
                    <div class="col-sm-2">
                        <label class="pull-right">Sign-In:</label>
                    </div>
                    '. form_open('home/login', 'id="login_form"') .'
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Username" name="username" required autofocus />
                        </div>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" placeholder="Password" name="password" required />
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-primary" type="submit" > <i class="fa fa-mail-forward"></i> Sign In </button>
                        </div>
                    '. form_close() .'
                </div>'
        ?>
    </div>
    <!-- END SLIDER -->
    <!-- REGISTRATION -->
    <?=
        ($this->session->login_type == 'Applicant') ? 
            '':
            '<section id="registration" class="container services">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="navy-line"></div>
                        <h1>Applicant Registration</h1>
                        <hr>
                        <!-- NOTIFICATION -->
                        <div id="notification_registration"></div>
                        <!-- END NOTIFICATION -->
                    </div>
                    '. form_open('home/register', 'id="applicant_form"') .'
                        <input type="hidden" name="organization_id" />
                        <div class="col-lg-6">
                            <h2>Personal Information</h2>
                            <hr>
                            <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" class="form-control" name="applicant_firstname" required />
                            </div>
                            <div class="form-group">
                                <label>Middlename</label>
                                <input type="text" class="form-control" name="applicant_middlename" />
                            </div>
                            <div class="form-group">
                                <label>Lastname</label>
                                <input type="text" class="form-control" name="applicant_lastname" required />
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" name="applicant_gender" required>
                                    <option value="">Choose Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Birthdate</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control" name="applicant_birthdate" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="applicant_address"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h2>Account Information</h2>
                            <hr>
                            <div class="form-group">
                                <label>Mobile</label>
                                <div class="input-group">
                                    <span class="input-group-addon">+63</span>
                                    <input type="number" class="form-control" name="applicant_mobile" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope-o"></i>
                                    </span>
                                    <input type="email" class="form-control" name="applicant_email_address" required />
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="applicant_username" required />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                    <input type="password" class="form-control" name="applicant_password1" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="applicant_password2" required />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary pull-right" type="submit" > <i class="fa fa-pencil-square-o"></i> Register </button>
                            </div>
                        </div>
                    '. form_close() .'
                </div>
                <hr>
            </section>'
    ?>
    <!-- END REGISTRATION -->

    <?php $this->load->view('resources/scripts/js'); ?>
    <script type="text/javascript">
        // Search Filter
        function load_organization_grid(){
            $.post("<?= site_url('home/ajax') ?>", {
                organization_type: $('select[name="organization_type"]').val(),
                organization_course_type: $('select[name="organization_course_type"]').val(),
                search_keyword: $('input[name="search_keyword"]').val()
            })
            .done( function(data){
                $('#organizations_grid').html(data);
            });
        }
        $('select[name="organization_type"]').change( function(){
            if($(this).val() == 'TVI (Technical-Vocational Institution)'){
                $(('select[name="organization_course_type"]')).html('<option value="Vocational Course">Vocational Course</option>');
            }else if($(this).val() == 'Academe'){
                $(('select[name="organization_course_type"]')).html('<option value="Bachelors Degree">Bachelors Degree</option>' +
                    '<option value="2 Year Degree Course">2 Year Degree Course</option>');
            }else if($(this).val() == 'Non-Academe'){
                $('select[name="organization_course_type"]').html('<option value="Bachelors Degree">Bachelors Degree</option>' +
                    '<option value="2 Year Degree Course">2 Year Degree </option>' +
                    '<option value="Vocational Course">Vocational </option>');
            }else{
                $('select[name="organization_course_type"]').html('<option value="all">All</option>' + 
                    '<option value="Bachelors Degree">Bachelors Degree</option>' +
                    '<option value="2 Year Degree Course">2 Year Degree Course</option>' +
                    '<option value="Vocational Course">Vocational Course</option>');
            }
            load_organization_grid();
        });
        $('select[name="organization_course_type"]').change( function(){ 
            load_organization_grid();
        });
        $('input[name="search_keyword"]').keyup( function(){
            load_organization_grid();
        });
        // Login Form
        $('#login_form').ajaxForm({
            resetForm: true,
            clearForm: false,
            beforeSubmit: function(){
            },
            success: function(data){
                var value = JSON.parse(data);
                $('#notification_login').html(value.notification);
            }
        });
        // Applicant Form
        $('#applicant_form').ajaxForm({
            resetForm: true,
            clearForm: false,
            beforeSubmit: function(){
            },
            success: function(data){
                var value = JSON.parse(data);
                $('#notification_registration').html(value.notification);
            }
        });
        //Date Picker
        $('input[name="applicant_birthdate"]').datepicker({
            startView: 2,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
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
                    changeHeaderOn = 164;
            function init() {
                window.addEventListener( 'scroll', function( event ) {
                    if( !didScroll ) {
                        didScroll = true;
                        setTimeout( scrollPage, 164 );
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