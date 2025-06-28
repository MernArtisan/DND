<div class="sidenav-menu">

    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <span class="logo-light">
            <span class="logo-lg"><img src="{{ asset('web/assets/img/main-logo-1.png') }}" width="150" height="100"
                    alt="logo"
                    style="height: 66px;padding: -4px;text-align: center;margin-left: 16px;margin-top: -5px;">
            </span>
            <span class="logo-sm text-center"><img src="{{ asset('admin/assets/images/small.png') }}"
                    alt="small logo"></span>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-sm-hover">
        <i class="ti ti-circle align-middle"></i>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class="ti ti-x align-middle"></i>
    </button>

    <div data-simplebar>

        <!--- Sidenav Menu -->
        <ul class="side-nav">

            <li class="side-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                    <span class="menu-text"> Dashboard </span>
                    <span class="badge bg-success rounded-pill"></span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false"
                    aria-controls="sidebarEcommerce" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-basket-filled"></i></span>
                    <span class="menu-text">CMS<br>Management</span>

                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('admin.banner.index') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-message-filled"></i></span>
                                <span class="menu-text"> Banners </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.privacy-policy') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-shield-lock"></i></span>
                                <span class="menu-text"> Privacy Policy </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.terms-condition') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-file-certificate"></i></span>
                                <span class="menu-text"> Terms & Conditions </span>
                            </a>
                        </li>
<<<<<<< HEAD
                        <li class="side-nav-item">
                            <a href="{{ route('admin.content.index') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-file-text"></i></span>
                                <span class="menu-text">Content</span>
                            </a>
                        </li>
=======

>>>>>>> f9aae70e59b5d7e390a1d8b33b4508b0ef8e7f0e
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarInvoice" aria-expanded="false" aria-controls="sidebarInvoice"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-file-invoice"></i></span>
                    <span class="menu-text">Category<br> Managemenet</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarInvoice">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('admin.category.index') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-calendar-filled"></i></span>
                                <span class="menu-text"> Categories List </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.category.create') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-folder-plus"></i></span>
                                <span class="menu-text"> Categories Add </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-files"></i></span>
                    <span class="menu-text">Streamer<br> Managemenet</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('admin.streams') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-video"></i></span>
                                <span class="menu-text"> Streams </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.user-streamer.index') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-folder-filled"></i></span>
                                <span class="menu-text"> Streamer </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPagesError" aria-expanded="false"
                    aria-controls="sidebarPagesError" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-server-2"></i></span>
                    <span class="menu-text"> Profile Management</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPagesError">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('admin.showProfile') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-user-circle"></i></span>
                                <span class="menu-text"> View Profile</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.editProfile') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-user-edit"></i></span>
                                <span class="menu-text"> Edit Profile</span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPagesAuth" aria-expanded="false"
                    aria-controls="sidebarPagesAuth" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-lock-filled"></i></span>
                    <span class="menu-text">Other</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPagesAuth">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('admin.channel.index') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-inbox"></i></span>
                                <span class="menu-text"> Channels </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('admin.articles.index') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-article"></i></span>
                                <span class="menu-text"> Articles </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            {{-- <li class="side-nav-title mt-2">Components</li> --}}

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarBaseUI" aria-expanded="false" aria-controls="sidebarBaseUI"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-settings"></i></span>
                    <span class="menu-text"> Settings </span>
                    <span class="menu-arrow"></span>
                </a>

                <div class="collapse" id="sidebarBaseUI">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('admin.content.index')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-file-text"></i></span>
                                <span class="menu-text">Content</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.subscription.index') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-video"></i></span>
                                <span class="menu-text"> Subscription </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="javascript:void(0);" class="side-nav-link text-danger"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="menu-icon"><i class="ti ti-logout"></i></span>
                                <span class="menu-text"> Logout</span>
                            </a>
                        </li>

                        <!-- Hidden logout form -->
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
            </li>

<<<<<<< HEAD
=======
            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarExtendedUI" aria-expanded="false"
                    aria-controls="sidebarExtendedUI" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-alien-filled"></i></span>
                    <span class="menu-text"> Extended UI </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarExtendedUI">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="extended-dragula.html" class="side-nav-link">
                                <span class="menu-text">Dragula</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="extended-sweetalerts.html" class="side-nav-link">
                                <span class="menu-text">Sweet Alerts</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="extended-ratings.html" class="side-nav-link">
                                <span class="menu-text">Ratings</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="extended-scrollbar.html" class="side-nav-link">
                                <span class="menu-text">Scrollbar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarIcons" aria-expanded="false" aria-controls="sidebarIcons"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-leaf"></i></span>
                    <span class="menu-text"> Icons </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarIcons">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="icons-tabler.html" class="side-nav-link">
                                <span class="menu-text">Tabler</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="icons-solar.html" class="side-nav-link">
                                <span class="menu-text">Solar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarCharts" aria-expanded="false" aria-controls="sidebarCharts"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-chart-arcs"></i></span>
                    <span class="menu-text"> Charts </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarCharts">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="charts-apex-area.html" class="side-nav-link">
                                <span class="menu-text">Area</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-bar.html" class="side-nav-link">
                                <span class="menu-text">Bar</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-bubble.html" class="side-nav-link">
                                <span class="menu-text">Bubble</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-candlestick.html" class="side-nav-link">
                                <span class="menu-text">Candlestick</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-column.html" class="side-nav-link">
                                <span class="menu-text">Column</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-heatmap.html" class="side-nav-link">
                                <span class="menu-text">Heatmap</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-line.html" class="side-nav-link">
                                <span class="menu-text">Line</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-mixed.html" class="side-nav-link">
                                <span class="menu-text">Mixed</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-timeline.html" class="side-nav-link">
                                <span class="menu-text">Timeline</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-boxplot.html" class="side-nav-link">
                                <span class="menu-text">Boxplot</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-treemap.html" class="side-nav-link">
                                <span class="menu-text">Treemap</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-pie.html" class="side-nav-link">
                                <span class="menu-text">Pie</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-radar.html" class="side-nav-link">
                                <span class="menu-text">Radar</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-radialbar.html" class="side-nav-link">
                                <span class="menu-text">RadialBar</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-scatter.html" class="side-nav-link">
                                <span class="menu-text">Scatter</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-polar-area.html" class="side-nav-link">
                                <span class="menu-text">Polar Area</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-sparklines.html" class="side-nav-link">
                                <span class="menu-text">Sparklines</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarForms" aria-expanded="false" aria-controls="sidebarForms"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-forms"></i></span>
                    <span class="menu-text"> Forms </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarForms">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="form-elements.html" class="side-nav-link">
                                <span class="menu-text">Basic Elements</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="form-inputmask.html" class="side-nav-link">
                                <span class="menu-text">Inputmask</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="form-picker.html" class="side-nav-link">
                                <span class="menu-text">Picker</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="form-select.html" class="side-nav-link">
                                <span class="menu-text">Select</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="form-range-slider.html" class="side-nav-link">
                                <span class="menu-text">Range Slider</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="form-validation.html" class="side-nav-link">
                                <span class="menu-text">Validation</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="form-wizard.html" class="side-nav-link">
                                <span class="menu-text">Wizard</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="form-fileuploads.html" class="side-nav-link">
                                <span class="menu-text">File Uploads</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="form-editors.html" class="side-nav-link">
                                <span class="menu-text">Editors</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="form-layouts.html" class="side-nav-link">
                                <span class="menu-text">Layouts</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            {{--
>>>>>>> f9aae70e59b5d7e390a1d8b33b4508b0ef8e7f0e
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSettings" aria-expanded="false"
                    aria-controls="sidebarSettings" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-settings"></i></span>
                    <span class="menu-text">Settings</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSettings">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="#" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-adjustments-horizontal"></i></span>
                                <span class="menu-text">General Settings</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-users"></i></span>
                                <span class="menu-text">Team</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-message-dots"></i></span>
                                <span class="menu-text">Testimonials</span>
                            </a>
                        </li>
                    </ul>
                </div>
<<<<<<< HEAD
            </li>



=======
            </li> --}}
            {{--
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarMaps" aria-expanded="false" aria-controls="sidebarMaps"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-map-pin-filled"></i></span>
                    <span class="menu-text"> Maps </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarMaps">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="maps-google.html" class="side-nav-link">
                                <span class="menu-text">Google Maps</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="maps-vector.html" class="side-nav-link">
                                <span class="menu-text">Vector Maps</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="maps-leaflet.html" class="side-nav-link">
                                <span class="menu-text">Leaflet Maps</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            {{--
            <li class="side-nav-title mt-2">
                More
            </li> --}}

            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLayouts" aria-expanded="false" aria-controls="sidebarLayouts"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-layout-filled"></i></span>
                    <span class="menu-text"> Layouts </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarLayouts">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="layouts-horizontal.html" target="_blank" class="side-nav-link">Horizontal</a>
                        </li>
                        <li class="side-nav-item">
                            <a href="layouts-full.html" target="_blank" class="side-nav-link">Full View</a>
                        </li>
                        <li class="side-nav-item">
                            <a href="layouts-fullscreen.html" target="_blank" class="side-nav-link">Fullscreen View</a>
                        </li>
                        <li class="side-nav-item">
                            <a href="layouts-hover.html" target="_blank" class="side-nav-link">Hover Menu</a>
                        </li>
                        <li class="side-nav-item">
                            <a href="layouts-compact.html" target="_blank" class="side-nav-link">Compact</a>
                        </li>
                        <li class="side-nav-item">
                            <a href="layouts-icon-view.html" target="_blank" class="side-nav-link">Icon View</a>
                        </li>
                    </ul>
                </div>
            </li> --}}
>>>>>>> f9aae70e59b5d7e390a1d8b33b4508b0ef8e7f0e

        </ul>

        <div class="clearfix"></div>
    </div>
</div>