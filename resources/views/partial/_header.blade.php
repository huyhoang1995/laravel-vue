<header id="navbar">
    <div id="navbar-container" class="boxed">
        <!--Brand logo & name-->
        <!--================================-->
        <div class="navbar-header">
            <a href="index.html" class="navbar-brand">
                {{-- <img src="img/logo.png" alt="Nifty Logo" class="brand-icon"> --}}
                <div class="brand-title">
                    <span class="brand-text">Nifty</span>
                </div>
            </a>
        </div>
        <!--================================-->
        <!--End brand logo & name-->
        <!--Navbar Dropdown-->
        <!--================================-->
        <div class="navbar-content clearfix">
            <ul class="nav navbar-top-links pull-left">
                <!--Navigation toogle button-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="tgl-menu-btn">
                    <a class="mainnav-toggle" href="#">
                        <i class="fa fa-navicon fa-lg"></i>
                    </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Navigation toogle button-->
        
                <!--Mega dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="mega-dropdown">
                    <a href="#" class="mega-dropdown-toggle">
                        <i class="fa fa-th-large fa-lg"></i>
                    </a>
                    <div class="dropdown-menu mega-dropdown-menu">
                        <div class="clearfix">
                            <div class="col-sm-12 col-md-3">
                                <!--Mega menu widget-->
                                <div class="text-center bg-purple pad-all">
                                    <h3 class="text-thin mar-no">Weekend shopping</h3>
                                    <div class="pad-ver box-inline">
                                        <span class="icon-wrap icon-wrap-lg icon-circle bg-trans-light">
                                            <i class="fa fa-shopping-cart fa-4x"></i>
                                        </span>
                                    </div>
                                    <p class="pad-btm">
                                        Members get <span class="text-lg text-bold">50%</span> more points. Lorem ipsum dolor sit amet!
                                    </p>
                                    <a href="#" class="btn btn-purple">Learn More...</a>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-3">
                                <!--Mega menu list-->
                                <ul class="list-unstyled">
                                    <li class="dropdown-header">Pages</li>
                                    <li><a href="#">Profile</a></li>
                                    <li><a href="#">Search Result</a></li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Sreen Lock</a></li>
                                    <li><a href="#" class="disabled">Disabled</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header">Icons</li>
                                    <li><a href="#"><span class="pull-right badge badge-purple">479</span> Font Awesome</a></li>
                                    <li><a href="#">Skycons</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4 col-md-3">
                                <!--Mega menu list-->
                                <ul class="list-unstyled">
                                    <li class="dropdown-header">Mailbox</li>
                                    <li><a href="#"><span class="pull-right label label-danger">Hot</span>Indox</a></li>
                                    <li><a href="#">Read Message</a></li>
                                    <li><a href="#">Compose</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header">Featured</li>
                                    <li><a href="#">Smart navigation</a></li>
                                    <li><a href="#"><span class="pull-right badge badge-success">6</span>Exclusive plugins</a></li>
                                    <li><a href="#">Lot of themes</a></li>
                                    <li><a href="#">Transition effects</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4 col-md-3">
                                <!--Mega menu list-->
                                <ul class="list-unstyled">
                                    <li class="dropdown-header">Components</li>
                                    <li><a href="#">Tables</a></li>
                                    <li><a href="#">Charts</a></li>
                                    <li><a href="#">Forms</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <form role="form" class="form">
                                            <div class="form-group">
                                                <label class="dropdown-header" for="demo-megamenu-input">Newsletter</label>
                                                <input id="demo-megamenu-input" type="email" placeholder="Enter email" class="form-control">
                                            </div>
                                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End mega dropdown-->
            </ul>
            <ul class="nav navbar-top-links pull-right">
                <!--Language selector-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End language selector-->
                <!--User dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li id="dropdown-user" class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                        <span class="pull-right">
                            <img class="img-circle img-user media-object" src="img/avatar.png" alt="Profile Picture">
                        </span>
                        <div class="username hidden-xs">John Doe</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right with-arrow panel-default">
                        <!-- Dropdown heading  -->
                        <div class="pad-all bord-btm">
                            <p class="text-lg text-muted text-thin mar-btm">750Gb of 1,000Gb Used</p>
                            <div class="progress progress-sm">
                                <div class="progress-bar" style="width: 70%;">
                                    <span class="sr-only">70%</span>
                                </div>
                            </div>
                        </div>
                        <!-- User dropdown menu -->
                        <ul class="head-list">
                            <li>
                                <a href="#">
                                    <i class="fa fa-user fa-fw fa-lg"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="badge badge-danger pull-right">9</span>
                                    <i class="fa fa-envelope fa-fw fa-lg"></i> Messages
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-success pull-right">New</span>
                                    <i class="fa fa-gear fa-fw fa-lg"></i> Settings
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-question-circle fa-fw fa-lg"></i> Help
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-lock fa-fw fa-lg"></i> Lock screen
                                </a>
                            </li>
                        </ul>
                        <!-- Dropdown footer -->
                        <div class="pad-all text-right">
                            <a href="pages-login.html" class="btn btn-primary">
                                <i class="fa fa-sign-out fa-fw"></i> Logout
                            </a>
                        </div>
                    </div>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End user dropdown-->
            </ul>
        </div>
        <!--================================-->
        <!--End Navbar Dropdown-->
    </div>
</header>
<div class="boxed">
    <nav id="mainnav-container">
        <div id="mainnav">
            <!--Shortcut buttons-->
            <!--================================-->
            <div id="mainnav-shortcut">
                <ul class="list-unstyled">
                    <li class="col-xs-4" data-content="Additional Sidebar" data-original-title="" title="">
                        <a id="demo-toggle-aside" class="shortcut-grid" href="#">
                            <i class="fa fa-magic"></i>
                        </a>
                    </li>
                    <li class="col-xs-4" data-content="Notification" data-original-title="" title="">
                        <a id="demo-alert" class="shortcut-grid" href="#">
                            <i class="fa fa-bullhorn"></i>
                        </a>
                    </li>
                    <li class="col-xs-4" data-content="Page Alerts" data-original-title="" title="">
                        <a id="demo-page-alert" class="shortcut-grid" href="#">
                            <i class="fa fa-bell"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!--================================-->
            <!--End shortcut buttons-->
            <!--Menu-->
            <!--================================-->
            <div id="mainnav-menu-wrap">
                <div class="nano has-scrollbar">
                    <div class="nano-content" tabindex="0" style="right: -17px;">
                        <ul id="mainnav-menu" class="list-group">
                            <!--Category name-->
                            <li class="list-header">Navigation</li>
                            <!--Menu list item-->
                            <li class="active-link">
                                <a href="index.html" data-original-title="" title="">
                                    <i class="fa fa-dashboard"></i>
                                    <span class="menu-title">
                                        <strong>Dashboard</strong>
                                        <span class="label label-success pull-right">Top</span>
                                    </span>
                                </a>
                            </li>
                            <!--Menu list item-->
                            <li>
                                <a href="#" data-original-title="" title="">
                                    <i class="fa fa-th"></i>
                                    <span class="menu-title">
                                        <strong>Layouts</strong>
                                    </span>
                                    <i class="arrow"></i>
                                </a>
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="layouts-collapsed-navigation.html">Collapsed Navigation</a></li>
                                    <li><a href="layouts-offcanvas-navigation.html">Off-Canvas Navigation</a></li>
                                    <li><a href="layouts-offcanvas-slide-in-navigation.html">Slide-in Navigation</a></li>
                                    <li><a href="layouts-offcanvas-revealing-navigation.html">Revealing Navigation</a></li>
                                    <li class="list-divider"></li>
                                    <li><a href="layouts-aside-right-side.html">Aside on the right side</a></li>
                                    <li><a href="layouts-aside-left-side.html">Aside on the left side</a></li>
                                    <li><a href="layouts-aside-bright-theme.html">Bright aside theme</a></li>
                                    <li class="list-divider"></li>
                                    <li><a href="layouts-fixed-navbar.html">Fixed Navbar</a></li>
                                    <li><a href="layouts-fixed-footer.html">Fixed Footer</a></li>
                                </ul>
                            </li>
                            <!--Menu list item-->
                            <li>
                                <a href="widgets.html" data-original-title="" title="">
                                    <i class="fa fa-flask"></i>
                                    <span class="menu-title">
                                        <strong>Widgets</strong>
                                        <span class="pull-right badge badge-warning">9</span>
                                    </span>
                                </a>
                            </li>
                            <li class="list-divider"></li>
                            <!--Category name-->
                            <li class="list-header">Components</li>
                            <!--Menu list item-->
                            <li>
                                <a href="#" data-original-title="" title="">
                                    <i class="fa fa-briefcase"></i>
                                    <span class="menu-title">UI Elements</span>
                                    <i class="arrow"></i>
                                </a>
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="ui-buttons.html">Buttons</a></li>
                                    <li><a href="ui-checkboxes-radio.html">Checkboxes &amp; Radio</a></li>
                                    <li><a href="ui-panels.html">Panels</a></li>
                                    <li><a href="ui-modals.html">Modals</a></li>
                                    <li><a href="ui-progress-bars.html">Progress bars</a></li>
                                    <li><a href="ui-components.html">Components</a></li>
                                    <li><a href="ui-typography.html">Typography</a></li>
                                    <li><a href="ui-list-group.html">List Group</a></li>
                                    <li><a href="ui-tabs-accordions.html">Tabs &amp; Accordions</a></li>
                                    <li><a href="ui-alerts-tooltips.html">Alerts &amp; Tooltips</a></li>
                                    <li><a href="ui-helper-classes.html">Helper Classes</a></li>
                                </ul>
                            </li>
                            <!--Menu list item-->
                            <li>
                                <a href="#" data-original-title="" title="">
                                    <i class="fa fa-edit"></i>
                                    <span class="menu-title">Forms</span>
                                    <i class="arrow"></i>
                                </a>
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="forms-general.html">General</a></li>
                                    <li><a href="forms-components.html">Components</a></li>
                                    <li><a href="forms-validation.html">Validation</a></li>
                                    <li><a href="forms-wizard.html">Wizard</a></li>
                                </ul>
                            </li>
                            <!--Menu list item-->
                            <li>
                                <a href="#" data-original-title="" title="">
                                    <i class="fa fa-table"></i>
                                    <span class="menu-title">Tables</span>
                                    <i class="arrow"></i>
                                </a>
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="tables-static.html">Static Tables</a></li>
                                    <li><a href="tables-bootstrap.html">Bootstrap Tables</a></li>
                                    <li><a href="tables-datatable.html">Data Tables<span class="label label-info pull-right">New</span></a></li>
                                    <li><a href="tables-footable.html">Foo Tables<span class="label label-info pull-right">New</span></a></li>
                                </ul>
                            </li>
                            <!--Menu list item-->
                            <li>
                                <a href="charts.html" data-original-title="" title="">
                                    <i class="fa fa-line-chart"></i>
                                    <span class="menu-title">Charts</span>
                                </a>
                            </li>
                            <li class="list-divider"></li>
                            <!--Category name-->
                            <li class="list-header">Extra</li>
                            <!--Menu list item-->
                            <li>
                                <a href="#" data-original-title="" title="">
                                    <i class="fa fa-plug"></i>
                                    <span class="menu-title">
                                        Miscellaneous
                                        <span class="label label-mint pull-right">New</span>
                                    </span>
                                </a>
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="misc-calendar.html">Calendar</a></li>
                                    <li><a href="misc-maps.html">Google Maps</a></li>
                                </ul>
                            </li>
                            <!--Menu list item-->
                            <li>
                                <a href="#" data-original-title="" title="">
                                    <i class="fa fa-envelope"></i>
                                    <span class="menu-title">Email</span>
                                    <i class="arrow"></i>
                                </a>
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="mailbox.html">Inbox</a></li>
                                    <li><a href="mailbox-message.html">View Message</a></li>
                                    <li><a href="mailbox-compose.html">Compose Message</a></li>
                                </ul>
                            </li>
                            <!--Menu list item-->
                            <li>
                                <a href="#" data-original-title="" title="">
                                    <i class="fa fa-file"></i>
                                    <span class="menu-title">Pages</span>
                                    <i class="arrow"></i>
                                </a>
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="pages-blank.html">Blank Page</a></li>
                                    <li><a href="pages-profile.html">Profile</a></li>
                                    <li><a href="pages-search-results.html">Search Results</a></li>
                                    <li><a href="pages-timeline.html">Timeline<span class="label label-info pull-right">New</span></a></li>
                                    <li><a href="pages-faq.html">FAQ</a></li>
                                    <li class="list-divider"></li>
                                    <li><a href="pages-404.html">404 Error</a></li>
                                    <li><a href="pages-500.html">500 Error</a></li>
                                    <li class="list-divider"></li>
                                    <li><a href="pages-login.html">Login</a></li>
                                    <li><a href="pages-register.html">Register</a></li>
                                    <li><a href="pages-password-reminder.html">Password Reminder</a></li>
                                    <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                                </ul>
                            </li>
                            <!--Menu list item-->
                            <li>
                                <a href="#" data-original-title="" title="">
                                    <i class="fa fa-plus-square"></i>
                                    <span class="menu-title">Menu Level</span>
                                    <i class="arrow"></i>
                                </a>
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="#">Second Level Item</a></li>
                                    <li><a href="#">Second Level Item</a></li>
                                    <li><a href="#">Second Level Item</a></li>
                                    <li class="list-divider"></li>
                                    <li>
                                        <a href="#">Third Level<i class="arrow"></i></a>
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="#">Third Level Item</a></li>
                                            <li><a href="#">Third Level Item</a></li>
                                            <li><a href="#">Third Level Item</a></li>
                                            <li><a href="#">Third Level Item</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Third Level<i class="arrow"></i></a>
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="#">Third Level Item</a></li>
                                            <li><a href="#">Third Level Item</a></li>
                                            <li><a href="#">Third Level Item</a></li>
                                            <li class="list-divider"></li>
                                            <li><a href="#">Third Level Item</a></li>
                                            <li><a href="#">Third Level Item</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!--Widget-->
                        <!--================================-->
                        <div class="mainnav-widget">
                            <!-- Show the button on collapsed navigation -->
                            <div class="show-small">
                                <a href="#" data-toggle="menu-widget" data-target="#demo-wg-server" data-original-title="" title="">
                                    <i class="fa fa-desktop"></i>
                                </a>
                            </div>

                        </div>
                        <!--================================-->
                        <!--End widget-->
                    </div>
                    <div class="nano-pane" style="display: none;">
                        <div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div>
                    </div>
                </div>
            </div>
            <!--================================-->
            <!--End menu-->
        </div>
    </nav>
</div>
