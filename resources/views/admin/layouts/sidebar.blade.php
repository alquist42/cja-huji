<div class="sidebar-menu">
{{--    <div class="sidebar-header">--}}
{{--        <!--=========================*--}}
{{--                      Logo--}}
{{--        *===========================-->--}}
{{--        <div class="logo">--}}
{{--            <a href="{{ URL::to('staff/examples/index') }}"><img src="{{asset('assets/images/logo.svg')}}" alt="logo"></a>--}}
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
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="feather ft-home"></i>
                            <span>Examples</span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('staff/examples/index') || Request::is('staff/examples/index2') || Request::is('staff/examples/index3') ? 'class="active"':"") !!}>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="feather ft-home"></i>
                                    <span>dashboard</span>
                                </a>
                                <ul class="collapse">
                                    <li {!! (Request::is('staff/examples/index') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/index') }}">Dashboard V1</a></li>
                                    <li {!! (Request::is('staff/examples/index2') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/index2') }}">Dashboard V2</a></li>
                                    <li {!! (Request::is('staff/examples/index3') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/index3') }}">Dashboard V3</a></li>
                                </ul>
                            </li>
                            <!--=========================*
                                      UI Features
                            *===========================-->
                            <li {!! (Request::is('staff/examples/alert') || Request::is('staff/examples/accordion') || Request::is('staff/examples/buttons')
                        || Request::is('staff/examples/badges') || Request::is('staff/examples/cards') || Request::is('staff/examples/carousel')
                        || Request::is('staff/examples/dropdown') || Request::is('staff/examples/list-group') || Request::is('staff/examples/modals')
                        || Request::is('staff/examples/pagination') || Request::is('staff/examples/popover') || Request::is('staff/examples/progressbar')
                        || Request::is('staff/examples/tabs') || Request::is('staff/examples/typography') || Request::is('staff/examples/grid') ? 'class="active"':"") !!}>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="feather ft-gitlab"></i>
                                    <span>UI Features</span>
                                </a>
                                <ul class="collapse">
                                    <li {!! (Request::is('staff/examples/alert') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/alert') }}"><i class="ti-alert"></i><span>Alert</span></a></li>
                                    <li {!! (Request::is('staff/examples/accordion') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/accordion') }}"><i class="ti-layout-accordion-separated"></i><span>Accordion</span></a></li>
                                    <li {!! (Request::is('staff/examples/buttons') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/buttons') }}"><i class="icon-focus"></i><span>Buttons</span></a></li>
                                    <li {!! (Request::is('staff/examples/badges') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/badges') }}"><i class="icon-ribbon"></i><span>Badges</span></a></li>
                                    <li {!! (Request::is('staff/examples/cards') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/cards') }}"><i class="ti-id-badge"></i><span>Cards</span></a></li>
                                    <li {!! (Request::is('staff/examples/carousel') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/carousel') }}"><i class="ti-layout-slider"></i><span>Carousels</span></a></li>
                                    <li {!! (Request::is('staff/examples/dropdown') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/dropdown') }}"><i class="icon-layers"></i><span>Dropdown</span></a></li>
                                    <li {!! (Request::is('staff/examples/list-group') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/list-group') }}"><i class="ti-list"></i><span>List Group</span></a></li>
                                    <li {!! (Request::is('staff/examples/modals') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/modals') }}"><i class="ti-layers-alt"></i><span>Modals</span></a></li>
                                    <li {!! (Request::is('staff/examples/pagination') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/pagination') }}"><i class="ion-android-more-horizontal"></i><span>Pagination</span></a></li>
                                    <li {!! (Request::is('staff/examples/popover') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/popover') }}"><i class="ion-ios-photos"></i><span>Popover</span></a></li>
                                    <li {!! (Request::is('staff/examples/progressbar') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/progressbar') }}"><i class="ion-ios-settings-strong"></i><span>Progressbar</span></a></li>
                                    <li {!! (Request::is('staff/examples/tabs') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/tabs') }}"><i class="ti-layout-tab"></i><span>Tabs</span></a></li>
                                    <li {!! (Request::is('staff/examples/typography') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/typography') }}"><i class="ti-smallcap"></i><span>Typography</span></a></li>
                                    <li {!! (Request::is('staff/examples/grid') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/grid') }}"><i class="ti-layout-grid4"></i><span>Grid</span></a></li>
                                </ul>
                            </li>
                            <!--=========================*
                                      Advance Kit
                            *===========================-->
                            <li {!! (Request::is('staff/examples/toastr') || Request::is('staff/examples/sweet-alert') || Request::is('staff/examples/cropper')
                        || Request::is('staff/examples/loaders') || Request::is('staff/examples/app-tour') || Request::is('staff/examples/ladda-button') || Request::is('staff/examples/dropzone') ? 'class="active"':"") !!}>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="feather ft-briefcase"></i>
                                    <span>Advance Kit</span>
                                </a>
                                <ul class="collapse">
                                    <li {!! (Request::is('staff/examples/toastr') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/toastr') }}"><i class="ti-layout-cta-left"></i> <span>Toastr</span></a></li>
                                    <li {!! (Request::is('staff/examples/sweet-alert') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/sweet-alert') }}"><i class="ti-layout-media-overlay-alt-2"></i> <span>Sweet Alert</span></a></li>
                                    <li {!! (Request::is('staff/examples/loaders') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/loaders') }}"><i class="ion-load-a"></i> <span>Css Loaders</span></a></li>
                                    <li {!! (Request::is('staff/examples/app-tour') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/app-tour') }}"><i class="ti-flag-alt"></i> <span>App Tour</span></a></li>
                                    <li {!! (Request::is('staff/examples/ladda-button') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/ladda-button') }}"><i class="ion-load-b"></i> <span>Ladda Button</span></a></li>
                                    <li {!! (Request::is('staff/examples/dropzone') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/dropzone') }}"><i class="ti-layout-placeholder"></i> <span>Dropzone</span></a></li>
                                </ul>
                            </li>
                            <!--=========================*
                                      Icons
                            *===========================-->
                            <li {!! (Request::is('staff/examples/font-awesome') || Request::is('staff/examples/themify') || Request::is('staff/examples/ionicons')
                        || Request::is('staff/examples/et-line') ? 'class="active"':"") !!}>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="feather ft-award"></i>
                                    <span>Icons</span>
                                </a>
                                <ul class="collapse">
                                    <li {!! (Request::is('staff/examples/font-awesome') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/font-awesome') }}"><i class="ti-flag-alt"></i> <span>Font Awesome</span></a></li>
                                    <li {!! (Request::is('staff/examples/themify') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/themify') }}"><i class="ti-themify-favicon"></i><span>Themify</span></a></li>
                                    <li {!! (Request::is('staff/examples/ionicons') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/ionicons') }}"><i class="ion-ionic"></i><span>Ionicons V2</span></a></li>
                                    <li {!! (Request::is('staff/examples/et-line') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/et-line') }}"><i class="icon-basket"></i><span>ET Line Icons</span></a></li>
                                </ul>
                            </li>
                            <!--=========================*
                                          Maps
                            *===========================-->
                            <li {!! (Request::is('staff/examples/google-maps') || Request::is('staff/examples/am-maps') ? 'class="active"':"") !!}>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="feather ft-map-pin"></i>
                                    <span>Maps</span>
                                </a>
                                <ul class="collapse">
                                    <li {!! (Request::is('staff/examples/google-maps') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/google-maps') }}"><i class="icon-map"></i><span>Google Maps</span></a></li>
                                    <li {!! (Request::is('staff/examples/am-maps') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/am-maps') }}"><i class="icon-map-pin"></i><span>AM Chart Maps</span></a></li>
                                </ul>
                            </li>
                            <!--=========================*
                                      Tables
                            *===========================-->
                            <li {!! (Request::is('staff/examples/basic-table') || Request::is('staff/examples/datatable') || Request::is('staff/examples/js-grid') ? 'class="active"':"") !!}>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="feather ft-credit-card"></i>
                                    <span>Tables</span>
                                </a>
                                <ul class="collapse">
                                    <li {!! (Request::is('staff/examples/basic-table') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/basic-table') }}"><i class="ion-ios-grid-view"></i><span>Basic Tables</span></a></li>
                                    <li {!! (Request::is('staff/examples/datatable') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/datatable') }}"><i class="ti-layout-slider-alt"></i><span>Datatable</span></a></li>
                                </ul>
                            </li>
                            <!--=========================*
                                         Forms
                            *===========================-->
                            <li {!! (Request::is('staff/examples/form-basic') || Request::is('staff/examples/form-layouts') || Request::is('staff/examples/form-groups')
                        || Request::is('staff/examples/form-validation') ? 'class="active"':"") !!}>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="feather ft-clipboard"></i>
                                    <span>Forms</span>
                                </a>
                                <ul class="collapse">
                                    <li {!! (Request::is('staff/examples/form-basic') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/form-basic') }}"><i class="ion-edit"></i><span>Basic ELements</span></a></li>
                                    <li {!! (Request::is('staff/examples/form-layouts') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/form-layouts') }}"><i class="ti-layout-grid2-thumb"></i><span>Form Layouts</span></a></li>
                                    <li {!! (Request::is('staff/examples/form-groups') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/form-groups') }}"><i class="ion-ios-paper"></i><span>Input Groups</span></a></li>
                                    <li {!! (Request::is('staff/examples/form-validation') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/form-validation') }}"><i class="ion-android-cancel"></i><span>Form Validation</span></a></li>
                                </ul>
                            </li>
                            <!--=========================*
                                      Editors
                            *===========================-->
                            <li {!! (Request::is('staff/examples/text-editor') || Request::is('staff/examples/code-editor') ? 'class="active"':"") !!}>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="feather ft-edit"></i>
                                    <span>Editors</span>
                                </a>
                                <ul class="collapse">
                                    <li {!! (Request::is('staff/examples/text-editor') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/text-editor') }}"><i class="ti-uppercase"></i><span>Text Editor</span></a></li>
                                </ul>
                            </li>
                            <!--=========================*
                                      Charts
                            *===========================-->
                            <li {!! (Request::is('staff/examples/chart-js') || Request::is('staff/examples/morris-charts') || Request::is('staff/examples/c3-chart')
                        || Request::is('staff/examples/chartist') ? 'class="active"':"") !!}>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="feather ft-pie-chart"></i>
                                    <span>Charts</span>
                                </a>
                                <ul class="collapse">
                                    <li {!! (Request::is('staff/examples/chart-js') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/chart-js') }}"><i class="feather ft-bar-chart"></i><span>Chart Js</span></a></li>
                                    <li {!! (Request::is('staff/examples/morris-charts') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/morris-charts') }}"><i class="feather ft-bar-chart-2"></i><span>Morris Chart Js</span></a></li>
                                    <li {!! (Request::is('staff/examples/c3-chart') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/c3-chart') }}"><i class="feather ft-bar-chart-line"></i><span>C3 Chart Js</span></a></li>
                                    <li {!! (Request::is('staff/examples/chartist') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/chartist') }}"><i class="feather ft-bar-chart-line-"></i><span>Chartist Js</span></a></li>
                                </ul>
                            </li>
                            <!--=========================*
                                      Session
                            *===========================-->
                            <li {!! (Request::is('staff/examples/login') || Request::is('staff/examples/register') || Request::is('lock')
                        || Request::is('staff/examples/reset-password') || Request::is('staff/examples/forgot-password') ? 'class="active"':"") !!}>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="feather ft-users"></i>
                                    <span>Session</span>
                                </a>
                                <ul class="collapse">
                                    <li {!! (Request::is('staff/examples/login') ? 'class="active"':"") !!}>
                                        <a href="{{ URL::to('staff/examples/login') }}">
                                            <i class="feather ft-log-in"></i>
                                            <span>Login</span>
                                        </a>
                                    </li>
                                    <li {!! (Request::is('staff/examples/register') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/register') }}"><i class="ion-person-add"></i><span>Register</span></a></li>
                                    <li {!! (Request::is('staff/examples/lock') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/lock') }}"><i class="ti-lock"></i><span>Lock Screen</span></a></li>
                                    <li {!! (Request::is('reset-password') ? 'class="active"':"") !!}>
                                        <a href="{{ URL::to('reset-password') }}">
                                            <i class="feather ft-lock"></i>
                                            <span>Reset Password</span>
                                        </a>
                                    </li>
                                    <li {!! (Request::is('staff/examples/forgot-password') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/forgot-password') }}"><i class="ti-bookmark-alt"></i><span>Forgot Password</span></a></li>
                                </ul>
                            </li>
                            <!--=========================*
                                      Error Pages
                            *===========================-->
                            <li {!! (Request::is('staff/examples/404') || Request::is('staff/examples/500') || Request::is('staff/examples/505') ? 'class="active"':"") !!}>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="feather ft-anchor"></i>
                                    <span>Error Pages</span>
                                </a>
                                <ul class="collapse">
                                    <li {!! (Request::is('staff/examples/404') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/404') }}"><i class="ti-unlink"></i><span>404</span></a></li>
                                    <li {!! (Request::is('staff/examples/500') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/500') }}"><i class="ti-close"></i><span>500</span></a></li>
                                    <li {!! (Request::is('staff/examples/505') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/505') }}"><i class="ti-na"></i><span>505</span></a></li>
                                </ul>
                            </li>
                            <!--=========================*
                                      Other Pages
                            *===========================-->
                            <li {!! (Request::is('staff/examples/blank') || Request::is('staff/examples/invoice') || Request::is('staff/examples/pricing')
                        || Request::is('staff/examples/profile') || Request::is('staff/examples/timeline') ? 'class="active"':"") !!}>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="feather ft-file-plus"></i>
                                    <span>Other Pages</span>
                                </a>
                                <ul class="collapse">
                                    <li {!! (Request::is('staff/examples/blank') ? 'class="active"':"") !!}>
                                        <a href="{{ URL::to('staff/examples/blank') }}">
                                            <i class="feather ft-file"></i>
                                            <span>Blank Page</span>
                                        </a>
                                    </li>
                                    <li {!! (Request::is('staff/examples/timeline') ? 'class="active"':"") !!}><a href="{{ URL::to('staff/examples/timeline') }}"><i class="feather ft-clock"></i><span>Timeline</span></a></li>
                                </ul>
                            </li>
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
