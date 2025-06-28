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


          
        </ul>

        <div class="clearfix"></div>
    </div>
</div>