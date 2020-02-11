<div class="sidebar-menu">
{{--    <div class="sidebar-header">--}}
{{--        <!--=========================*--}}
{{--                      Logo--}}
{{--        *===========================-->--}}
{{--        <div class="logo">--}}
{{--            <a href="{{ URL::to('staff/index') }}"><img src="{{asset('assets/images/logo.svg')}}" alt="logo"></a>--}}
{{--        </div>--}}
{{--        <!--=========================*--}}
{{--                    End Logo--}}
{{--        *===========================-->--}}
{{--    </div>--}}
    <!--=========================*
               Main Menu
    *===========================-->
    <div class="main-menu">
        <div class="menu-inner" id="sidebar_menu">
            <nav>
                <ul class="metismenu" id="menu">
                    <li {!! (Request::is('staff/index') || Request::is('staff/index2') || Request::is('staff/index3') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-home"></i>
                            <span>dashboard</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('staff/index') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/index') }}">Dashboard V1</a></li>
                            <li {!! (Request::is('staff/index2') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/index2') }}">Dashboard V2</a></li>
                            <li {!! (Request::is('staff/index3') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/index3') }}">Dashboard V3</a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              UI Features
                    *===========================-->
                    <li {!! (Request::is('staff/alert') || Request::is('staff/accordion') || Request::is('staff/buttons')
                        || Request::is('staff/badges') || Request::is('staff/cards') || Request::is('staff/carousel')
                        || Request::is('staff/dropdown') || Request::is('staff/list-group') || Request::is('staff/modals')
                        || Request::is('staff/pagination') || Request::is('staff/popover') || Request::is('staff/progressbar')
                        || Request::is('staff/tabs') || Request::is('staff/typography') || Request::is('staff/grid') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-gitlab"></i>
                            <span>UI Features</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('staff/alert') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/alert') }}"><i class="ti-alert"></i><span>Alert</span></a></li>
                            <li {!! (Request::is('staff/accordion') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/accordion') }}"><i class="ti-layout-accordion-separated"></i><span>Accordion</span></a></li>
                            <li {!! (Request::is('staff/buttons') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/buttons') }}"><i class="icon-focus"></i><span>Buttons</span></a></li>
                            <li {!! (Request::is('staff/badges') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/badges') }}"><i class="icon-ribbon"></i><span>Badges</span></a></li>
                            <li {!! (Request::is('staff/cards') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/cards') }}"><i class="ti-id-badge"></i><span>Cards</span></a></li>
                            <li {!! (Request::is('staff/carousel') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/carousel') }}"><i class="ti-layout-slider"></i><span>Carousels</span></a></li>
                            <li {!! (Request::is('staff/dropdown') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/dropdown') }}"><i class="icon-layers"></i><span>Dropdown</span></a></li>
                            <li {!! (Request::is('staff/list-group') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/list-group') }}"><i class="ti-list"></i><span>List Group</span></a></li>
                            <li {!! (Request::is('staff/modals') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/modals') }}"><i class="ti-layers-alt"></i><span>Modals</span></a></li>
                            <li {!! (Request::is('staff/pagination') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/pagination') }}"><i class="ion-android-more-horizontal"></i><span>Pagination</span></a></li>
                            <li {!! (Request::is('staff/popover') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/popover') }}"><i class="ion-ios-photos"></i><span>Popover</span></a></li>
                            <li {!! (Request::is('staff/progressbar') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/progressbar') }}"><i class="ion-ios-settings-strong"></i><span>Progressbar</span></a></li>
                            <li {!! (Request::is('staff/tabs') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/tabs') }}"><i class="ti-layout-tab"></i><span>Tabs</span></a></li>
                            <li {!! (Request::is('staff/typography') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/typography') }}"><i class="ti-smallcap"></i><span>Typography</span></a></li>
                            <li {!! (Request::is('staff/grid') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/grid') }}"><i class="ti-layout-grid4"></i><span>Grid</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Advance Kit
                    *===========================-->
                    <li {!! (Request::is('staff/toastr') || Request::is('staff/sweet-alert') || Request::is('staff/cropper')
                        || Request::is('staff/loaders') || Request::is('staff/app-tour') || Request::is('staff/ladda-button') || Request::is('staff/dropzone') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-briefcase"></i>
                            <span>Advance Kit</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('staff/toastr') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/toastr') }}"><i class="ti-layout-cta-left"></i> <span>Toastr</span></a></li>
                            <li {!! (Request::is('staff/sweet-alert') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/sweet-alert') }}"><i class="ti-layout-media-overlay-alt-2"></i> <span>Sweet Alert</span></a></li>
                            <li {!! (Request::is('staff/loaders') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/loaders') }}"><i class="ion-load-a"></i> <span>Css Loaders</span></a></li>
                            <li {!! (Request::is('staff/app-tour') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/app-tour') }}"><i class="ti-flag-alt"></i> <span>App Tour</span></a></li>
                            <li {!! (Request::is('staff/ladda-button') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/ladda-button') }}"><i class="ion-load-b"></i> <span>Ladda Button</span></a></li>
                            <li {!! (Request::is('staff/dropzone') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/dropzone') }}"><i class="ti-layout-placeholder"></i> <span>Dropzone</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Icons
                    *===========================-->
                    <li {!! (Request::is('staff/font-awesome') || Request::is('staff/themify') || Request::is('staff/ionicons')
                        || Request::is('staff/et-line') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-award"></i>
                            <span>Icons</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('staff/font-awesome') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/font-awesome') }}"><i class="ti-flag-alt"></i> <span>Font Awesome</span></a></li>
                            <li {!! (Request::is('staff/themify') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/themify') }}"><i class="ti-themify-favicon"></i><span>Themify</span></a></li>
                            <li {!! (Request::is('staff/ionicons') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/ionicons') }}"><i class="ion-ionic"></i><span>Ionicons V2</span></a></li>
                            <li {!! (Request::is('staff/et-line') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/et-line') }}"><i class="icon-basket"></i><span>ET Line Icons</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                                  Maps
                    *===========================-->
                    <li {!! (Request::is('staff/google-maps') || Request::is('staff/am-maps') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-map-pin"></i>
                            <span>Maps</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('staff/google-maps') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/google-maps') }}"><i class="icon-map"></i><span>Google Maps</span></a></li>
                            <li {!! (Request::is('staff/am-maps') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/am-maps') }}"><i class="icon-map-pin"></i><span>AM Chart Maps</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Tables
                    *===========================-->
                    <li {!! (Request::is('staff/basic-table') || Request::is('staff/datatable') || Request::is('staff/js-grid') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-credit-card"></i>
                            <span>Tables</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('staff/basic-table') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/basic-table') }}"><i class="ion-ios-grid-view"></i><span>Basic Tables</span></a></li>
                            <li {!! (Request::is('staff/datatable') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/datatable') }}"><i class="ti-layout-slider-alt"></i><span>Datatable</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                                 Forms
                    *===========================-->
                    <li {!! (Request::is('staff/form-basic') || Request::is('staff/form-layouts') || Request::is('staff/form-groups')
                        || Request::is('staff/form-validation') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-clipboard"></i>
                            <span>Forms</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('staff/form-basic') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/form-basic') }}"><i class="ion-edit"></i><span>Basic ELements</span></a></li>
                            <li {!! (Request::is('staff/form-layouts') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/form-layouts') }}"><i class="ti-layout-grid2-thumb"></i><span>Form Layouts</span></a></li>
                            <li {!! (Request::is('staff/form-groups') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/form-groups') }}"><i class="ion-ios-paper"></i><span>Input Groups</span></a></li>
                            <li {!! (Request::is('staff/form-validation') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/form-validation') }}"><i class="ion-android-cancel"></i><span>Form Validation</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Editors
                    *===========================-->
                    <li {!! (Request::is('staff/text-editor') || Request::is('staff/code-editor') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-edit"></i>
                            <span>Editors</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('staff/text-editor') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/text-editor') }}"><i class="ti-uppercase"></i><span>Text Editor</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Charts
                    *===========================-->
                    <li {!! (Request::is('staff/chart-js') || Request::is('staff/morris-charts') || Request::is('staff/c3-chart')
                        || Request::is('staff/chartist') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-pie-chart"></i>
                            <span>Charts</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('staff/chart-js') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/chart-js') }}"><i class="feather ft-bar-chart"></i><span>Chart Js</span></a></li>
                            <li {!! (Request::is('staff/morris-charts') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/morris-charts') }}"><i class="feather ft-bar-chart-2"></i><span>Morris Chart Js</span></a></li>
                            <li {!! (Request::is('staff/c3-chart') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/c3-chart') }}"><i class="feather ft-bar-chart-line"></i><span>C3 Chart Js</span></a></li>
                            <li {!! (Request::is('staff/chartist') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/chartist') }}"><i class="feather ft-bar-chart-line-"></i><span>Chartist Js</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Session
                    *===========================-->
                    <li {!! (Request::is('staff/login') || Request::is('staff/register') || Request::is('lock')
                        || Request::is('staff/reset-password') || Request::is('staff/forgot-password') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-users"></i>
                            <span>Session</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('staff/login') ? 'class="active"':"") !!}>
                                <a href="{{ URL::to('staff/login') }}">
                                    <i class="feather ft-log-in"></i>
                                    <span>Login</span>
                                </a>
                            </li>
                            <li {!! (Request::is('staff/register') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/register') }}"><i class="ion-person-add"></i><span>Register</span></a></li>
                            <li {!! (Request::is('staff/lock') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/lock') }}"><i class="ti-lock"></i><span>Lock Screen</span></a></li>
                            <li {!! (Request::is('reset-password') ? 'class="active"':"") !!}>
                                <a href="{{ URL::to('reset-password') }}">
                                    <i class="feather ft-lock"></i>
                                    <span>Reset Password</span>
                                </a>
                            </li>
                            <li {!! (Request::is('staff/forgot-password') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/forgot-password') }}"><i class="ti-bookmark-alt"></i><span>Forgot Password</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Error Pages
                    *===========================-->
                    <li {!! (Request::is('staff/404') || Request::is('staff/500') || Request::is('staff/505') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-anchor"></i>
                            <span>Error Pages</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('staff/404') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/404') }}"><i class="ti-unlink"></i><span>404</span></a></li>
                            <li {!! (Request::is('staff/500') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/500') }}"><i class="ti-close"></i><span>500</span></a></li>
                            <li {!! (Request::is('staff/505') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/505') }}"><i class="ti-na"></i><span>505</span></a></li>
                        </ul>
                    </li>
                    <!--=========================*
                              Other Pages
                    *===========================-->
                    <li {!! (Request::is('staff/blank') || Request::is('staff/invoice') || Request::is('staff/pricing')
                        || Request::is('staff/profile') || Request::is('staff/timeline') ? 'class="active"':"") !!}>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-file-plus"></i>
                            <span>Other Pages</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('staff/blank') ? 'class="active"':"") !!}>
                                <a href="{{ URL::to('staff/blank') }}">
                                    <i class="feather ft-file"></i>
                                    <span>Blank Page</span>
                                </a>
                            </li>
                            <li {!! (Request::is('staff/timeline') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/timeline') }}"><i class="feather ft-clock"></i><span>Timeline</span></a></li>
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
