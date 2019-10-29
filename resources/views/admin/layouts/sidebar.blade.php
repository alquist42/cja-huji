<div class="sidebar-menu">
    <div class="sidebar-header">
        <!--=========================*
                      Logo
        *===========================-->
        <div class="logo">
            <a href="{{ URL::to('admin/index') }}"><img src="{{asset('assets/images/logo.svg')}}" alt="logo"></a>
        </div>
        <!--=========================*
                    End Logo
        *===========================-->
    </div>
    <!--=========================*
               Main Menu
    *===========================-->
    <div class="main-menu">
        <div class="menu-inner" id="sidebar_menu">
            <nav>
                <ul class="metismenu" id="menu">
                    <li {!! (Request::is('admin/index') || Request::is('admin/index2') || Request::is('admin/index3') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-home"></i>
                            <span>dashboard</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('admin/index') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/index') }}">Dashboard V1</a></li>
                            <li {!! (Request::is('admin/index2') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/index2') }}">Dashboard V2</a></li>
                            <li {!! (Request::is('admin/index3') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/index3') }}">Dashboard V3</a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              UI Features
                    *===========================-->
                    <li {!! (Request::is('admin/alert') || Request::is('admin/accordion') || Request::is('admin/buttons')
                        || Request::is('admin/badges') || Request::is('admin/cards') || Request::is('admin/carousel')
                        || Request::is('admin/dropdown') || Request::is('admin/list-group') || Request::is('admin/modals')
                        || Request::is('admin/pagination') || Request::is('admin/popover') || Request::is('admin/progressbar')
                        || Request::is('admin/tabs') || Request::is('admin/typography') || Request::is('admin/grid') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-gitlab"></i>
                            <span>UI Features</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('admin/alert') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/alert') }}"><i class="ti-alert"></i><span>Alert</span></a></li>
                            <li {!! (Request::is('admin/accordion') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/accordion') }}"><i class="ti-layout-accordion-separated"></i><span>Accordion</span></a></li>
                            <li {!! (Request::is('admin/buttons') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/buttons') }}"><i class="icon-focus"></i><span>Buttons</span></a></li>
                            <li {!! (Request::is('admin/badges') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/badges') }}"><i class="icon-ribbon"></i><span>Badges</span></a></li>
                            <li {!! (Request::is('admin/cards') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/cards') }}"><i class="ti-id-badge"></i><span>Cards</span></a></li>
                            <li {!! (Request::is('admin/carousel') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/carousel') }}"><i class="ti-layout-slider"></i><span>Carousels</span></a></li>
                            <li {!! (Request::is('admin/dropdown') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/dropdown') }}"><i class="icon-layers"></i><span>Dropdown</span></a></li>
                            <li {!! (Request::is('admin/list-group') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/list-group') }}"><i class="ti-list"></i><span>List Group</span></a></li>
                            <li {!! (Request::is('admin/modals') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/modals') }}"><i class="ti-layers-alt"></i><span>Modals</span></a></li>
                            <li {!! (Request::is('admin/pagination') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/pagination') }}"><i class="ion-android-more-horizontal"></i><span>Pagination</span></a></li>
                            <li {!! (Request::is('admin/popover') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/popover') }}"><i class="ion-ios-photos"></i><span>Popover</span></a></li>
                            <li {!! (Request::is('admin/progressbar') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/progressbar') }}"><i class="ion-ios-settings-strong"></i><span>Progressbar</span></a></li>
                            <li {!! (Request::is('admin/tabs') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/tabs') }}"><i class="ti-layout-tab"></i><span>Tabs</span></a></li>
                            <li {!! (Request::is('admin/typography') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/typography') }}"><i class="ti-smallcap"></i><span>Typography</span></a></li>
                            <li {!! (Request::is('admin/grid') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/grid') }}"><i class="ti-layout-grid4"></i><span>Grid</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Advance Kit
                    *===========================-->
                    <li {!! (Request::is('admin/toastr') || Request::is('admin/sweet-alert') || Request::is('admin/cropper')
                        || Request::is('admin/loaders') || Request::is('admin/app-tour') || Request::is('admin/ladda-button') || Request::is('admin/dropzone') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-briefcase"></i>
                            <span>Advance Kit</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('admin/toastr') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/toastr') }}"><i class="ti-layout-cta-left"></i> <span>Toastr</span></a></li>
                            <li {!! (Request::is('admin/sweet-alert') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/sweet-alert') }}"><i class="ti-layout-media-overlay-alt-2"></i> <span>Sweet Alert</span></a></li>
                            <li {!! (Request::is('admin/loaders') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/loaders') }}"><i class="ion-load-a"></i> <span>Css Loaders</span></a></li>
                            <li {!! (Request::is('admin/app-tour') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/app-tour') }}"><i class="ti-flag-alt"></i> <span>App Tour</span></a></li>
                            <li {!! (Request::is('admin/ladda-button') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/ladda-button') }}"><i class="ion-load-b"></i> <span>Ladda Button</span></a></li>
                            <li {!! (Request::is('admin/dropzone') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/dropzone') }}"><i class="ti-layout-placeholder"></i> <span>Dropzone</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Icons
                    *===========================-->
                    <li {!! (Request::is('admin/font-awesome') || Request::is('admin/themify') || Request::is('admin/ionicons')
                        || Request::is('admin/et-line') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-award"></i>
                            <span>Icons</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('admin/font-awesome') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/font-awesome') }}"><i class="ti-flag-alt"></i> <span>Font Awesome</span></a></li>
                            <li {!! (Request::is('admin/themify') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/themify') }}"><i class="ti-themify-favicon"></i><span>Themify</span></a></li>
                            <li {!! (Request::is('admin/ionicons') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/ionicons') }}"><i class="ion-ionic"></i><span>Ionicons V2</span></a></li>
                            <li {!! (Request::is('admin/et-line') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/et-line') }}"><i class="icon-basket"></i><span>ET Line Icons</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                                  Maps
                    *===========================-->
                    <li {!! (Request::is('admin/google-maps') || Request::is('admin/am-maps') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-map-pin"></i>
                            <span>Maps</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('admin/google-maps') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/google-maps') }}"><i class="icon-map"></i><span>Google Maps</span></a></li>
                            <li {!! (Request::is('admin/am-maps') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/am-maps') }}"><i class="icon-map-pin"></i><span>AM Chart Maps</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Tables
                    *===========================-->
                    <li {!! (Request::is('admin/basic-table') || Request::is('admin/datatable') || Request::is('admin/js-grid') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-credit-card"></i>
                            <span>Tables</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('admin/basic-table') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/basic-table') }}"><i class="ion-ios-grid-view"></i><span>Basic Tables</span></a></li>
                            <li {!! (Request::is('admin/datatable') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/datatable') }}"><i class="ti-layout-slider-alt"></i><span>Datatable</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                                 Forms
                    *===========================-->
                    <li {!! (Request::is('admin/form-basic') || Request::is('admin/form-layouts') || Request::is('admin/form-groups')
                        || Request::is('admin/form-validation') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-clipboard"></i>
                            <span>Forms</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('admin/form-basic') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/form-basic') }}"><i class="ion-edit"></i><span>Basic ELements</span></a></li>
                            <li {!! (Request::is('admin/form-layouts') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/form-layouts') }}"><i class="ti-layout-grid2-thumb"></i><span>Form Layouts</span></a></li>
                            <li {!! (Request::is('admin/form-groups') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/form-groups') }}"><i class="ion-ios-paper"></i><span>Input Groups</span></a></li>
                            <li {!! (Request::is('admin/form-validation') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/form-validation') }}"><i class="ion-android-cancel"></i><span>Form Validation</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Editors
                    *===========================-->
                    <li {!! (Request::is('admin/text-editor') || Request::is('admin/code-editor') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-edit"></i>
                            <span>Editors</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('admin/text-editor') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/text-editor') }}"><i class="ti-uppercase"></i><span>Text Editor</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Charts
                    *===========================-->
                    <li {!! (Request::is('admin/chart-js') || Request::is('admin/morris-charts') || Request::is('admin/c3-chart')
                        || Request::is('admin/chartist') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-pie-chart"></i>
                            <span>Charts</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('admin/chart-js') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/chart-js') }}"><i class="feather ft-bar-chart"></i><span>Chart Js</span></a></li>
                            <li {!! (Request::is('admin/morris-charts') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/morris-charts') }}"><i class="feather ft-bar-chart-2"></i><span>Morris Chart Js</span></a></li>
                            <li {!! (Request::is('admin/c3-chart') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/c3-chart') }}"><i class="feather ft-bar-chart-line"></i><span>C3 Chart Js</span></a></li>
                            <li {!! (Request::is('admin/chartist') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/chartist') }}"><i class="feather ft-bar-chart-line-"></i><span>Chartist Js</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Session
                    *===========================-->
                    <li {!! (Request::is('admin/login') || Request::is('admin/register') || Request::is('lock')
                        || Request::is('admin/reset-password') || Request::is('admin/forgot-password') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-users"></i>
                            <span>Session</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('admin/login') ? 'class="active"':"") !!}>
                                <a href="{{ URL::to('admin/login') }}">
                                    <i class="feather ft-log-in"></i>
                                    <span>Login</span>
                                </a>
                            </li>
                            <li {!! (Request::is('admin/register') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/register') }}"><i class="ion-person-add"></i><span>Register</span></a></li>
                            <li {!! (Request::is('admin/lock') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/lock') }}"><i class="ti-lock"></i><span>Lock Screen</span></a></li>
                            <li {!! (Request::is('reset-password') ? 'class="active"':"") !!}>
                                <a href="{{ URL::to('reset-password') }}">
                                    <i class="feather ft-lock"></i>
                                    <span>Reset Password</span>
                                </a>
                            </li>
                            <li {!! (Request::is('admin/forgot-password') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/forgot-password') }}"><i class="ti-bookmark-alt"></i><span>Forgot Password</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Error Pages
                    *===========================-->
                    <li {!! (Request::is('admin/404') || Request::is('admin/500') || Request::is('admin/505') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-anchor"></i>
                            <span>Error Pages</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('admin/404') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/404') }}"><i class="ti-unlink"></i><span>404</span></a></li>
                            <li {!! (Request::is('admin/500') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/500') }}"><i class="ti-close"></i><span>500</span></a></li>
                            <li {!! (Request::is('admin/505') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/505') }}"><i class="ti-na"></i><span>505</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Other Pages
                    *===========================-->
                    <li {!! (Request::is('admin/blank') || Request::is('admin/invoice') || Request::is('admin/pricing')
                        || Request::is('admin/profile') || Request::is('admin/timeline') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-file-plus"></i>
                            <span>Other Pages</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('admin/blank') ? 'class="active"':"") !!}>
                                <a href="{{ URL::to('admin/blank') }}">
                                    <i class="feather ft-file"></i>
                                    <span>Blank Page</span>
                                </a>
                            </li>
                            <li {!! (Request::is('admin/timeline') ? 'class="active"':"") !!}><a href="{{ URL::to('admin/timeline') }}"><i class="feather ft-clock"></i><span>Timeline</span></a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!--=========================*
              End Main Menu
    *===========================-->
</div>
