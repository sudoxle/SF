<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                </div>
                <div class="logo-element">SFS</div>
            </li>
            <li <?= ($this->uri->segment(1) == "system" ? "class='active'" : "class=''") ?>>
                <?=
                    ($this->session->login_type == 'Applicant') ? 
                        '<a href="'. site_url('home') .'">
                            <i class="fa fa-home"></i> <span class="nav-label"> Homepage</span>
                        </a>':
                        '<a href="'. site_url('system') .'">
                            <i class="fa fa-home"></i> <span class="nav-label"> Dashboard</span>
                        </a>'
                ?>
            </li>
            <li <?= ($this->uri->segment(1) == "setup" ? "class='active'" : "class=''") ?> id="side_menu">
                <a href="#">
                    <i class="fa fa-th-large"></i> <span class="nav-label"> Setup</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <?= empty($modules['users']) ? '':
                        '<li '. ($this->uri->segment(2) == "accessibility" ? "class='active'" : "class=''") .'>
                            <a href="#">
                                Accessibility <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-third-level">
                                '.(empty($modules['users']) ? '':'
                                <li '. ($this->uri->segment(3) == "users" ? "class='active'" : "class=''") .'>
                                    <a href="'.site_url($modules['users']).'"> Users</a>
                                </li>').'
                            </ul>
                        </li>'
                    ?>
                </ul>
            </li>
            <li <?= ($this->uri->segment(1) == "organizations" ? "class='active'" : "class=''") ?> id="side_menu">
                <a href="#">
                    <i class="fa fa-refresh"></i> <span class="nav-label"> Organizations</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <?= empty($modules['organizations']) ? '':
                        '<li '. ($this->uri->segment(2) == "organizations" ? "class='active'" : "class=''") .'>
                            <a href="'.site_url($modules['organizations']).'"> List of Organizations</a>
                        </li>'
                    ?>
                    <?= empty($modules['organization_requirements']) ? '':
                        '<li '. ($this->uri->segment(2) == "organization_requirements" ? "class='active'" : "class=''") .'>
                            <a href="'.site_url($modules['organization_requirements']).'"> Organization Requirements</a>
                        </li>'
                    ?>
                    <?= empty($modules['organization_users']) ? '':
                        '<li '. ($this->uri->segment(2) == "organization_users" ? "class='active'" : "class=''") .'>
                            <a href="'.site_url($modules['organization_users']).'"> Organization Users</a>
                        </li>'
                    ?>
                </ul>
            </li>
            <li <?= ($this->uri->segment(1) == "applicants" ? "class='active'" : "class=''") ?> id="side_menu">
                <a href="#">
                    <i class="fa fa-user"></i> <span class="nav-label"> Applicants</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <?= empty($modules['applicants']) ? '':
                        '<li '. ($this->uri->segment(2) == "applicants" ? "class='active'" : "class=''") .'>
                            <a href="'.site_url($modules['applicants']).'"> List of Applicants</a>
                        </li>'
                    ?>
                </ul>
            </li>
        </ul>
    </div>
</nav>