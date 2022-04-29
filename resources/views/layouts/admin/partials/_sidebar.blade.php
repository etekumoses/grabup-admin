<div id="sidebarMain" class="d-none">
    <aside
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container text-capitalize">
            <div class="navbar-vertical-footer-offset">
                <div class="navbar-brand-wrapper justify-content-between">
                    <!-- Logo -->

                    <a class="navbar-brand" href="{{route('admin.dashboard')}}" aria-label="Front">
                        <img class="navbar-brand-logo"
                             onerror="this.src='{{asset('public/assets/admin/img/160x160/img1.jpg')}}'"
                             src="{{ asset('public/assets/admin/img/logo.png') }}"
                             alt="Logo">
                        <img class="navbar-brand-logo-mini"
                             onerror="this.src='{{asset('public/assets/admin/img/160x160/img1.jpg')}}'"
                             src="{{ asset('public/assets/admin/img/logo.png') }}" alt="Logo">
                    </a>

                    <!-- End Logo -->

                    <!-- Navbar Vertical Toggle -->
                    <button type="button"
                            class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->
                </div>

                <!-- Content -->
                <div class="navbar-vertical-content">
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <!-- Dashboards -->
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin')?'show':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="{{route('admin.dashboard')}}" title="Dashboards">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    Dashboard
                                </span>
                            </a>
                        </li>
                        <!-- End Dashboards -->

                        

                     
                        <li class="nav-item">
                            <small
                                class="nav-subtitle">Category Section</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                          <!-- Pages -->
                          <li class="navbar-vertical-aside-has-menu {{Request::is('admin/category*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                            >
                                <i class="tio-category nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{\App\CentralLogics\translate('category')}}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{Request::is('admin/category*')?'block':'none'}}">
                                <li class="nav-item {{Request::is('admin/category/add')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.category.add')}}"
                                       title="add new category">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\CentralLogics\translate('category')}}</span>
                                    </a>
                                </li>

                               
                            </ul>
                        </li>
                        <!-- End Pages -->
                        <li class="nav-item">
                            <small
                                class="nav-subtitle">Job Section</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                         <!-- Pages -->
                         <li class="navbar-vertical-aside-has-menu {{Request::is('admin/jobs*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                            >
                                <i class="tio-premium-outlined nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{\App\CentralLogics\translate('job')}}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{Request::is('admin/job*')?'block':'none'}}">
                                <li class="nav-item {{Request::is('admin/job/add-new')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.job.add-new')}}"
                                       title="add new job">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span
                                            class="text-truncate">{{\App\CentralLogics\translate('add')}} {{\App\CentralLogics\translate('new')}}</span>
                                    </a>
                                </li>
                                
                                <li class="nav-item {{Request::is('admin/job/add-new')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.job.list')}}"
                                       title="add new job">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span
                                            class="text-truncate">{{\App\CentralLogics\translate('list')}} </span>
                                    </a>
                                </li>
                                
                               
                               
                            </ul>
                        </li>
                        <!-- End Pages -->

                     

                        <li class="nav-item">
                            <small class="nav-subtitle"
                                   title="Layouts">{{\App\CentralLogics\translate('Settings')}} {{\App\CentralLogics\translate('section')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <!-- Pages -->
                    
                        <!-- Pages -->
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/notification*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="{{route('admin.notification.add-new')}}"
                            >
                                <i class="tio-notifications nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{\App\CentralLogics\translate('send')}} {{\App\CentralLogics\translate('notification')}}
                                </span>
                            </a>
                        </li>
                        <!-- End Pages -->
                        <!-- Pages -->
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/admin-settings*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                            >
                                <i class="tio-settings nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{\App\CentralLogics\translate('settings')}}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{Request::is('admin/admin-settings*')?'block':'none'}}">
                                 
                                 
                               
                               
                                
                                <li class="nav-item {{Request::is('admin/admin-settings/fcm-index')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.admin-settings.fcm-index')}}"
                                       title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span
                                            class="text-truncate">{{\App\CentralLogics\translate('push')}} {{\App\CentralLogics\translate('notification')}}</span>
                                    </a>
                                </li>

                                <li class="nav-item {{Request::is('admin/admin-settings/terms-and-conditions')?'active':''}}">
                                    <a class="nav-link "
                                       href="{{route('admin.admin-settings.terms-and-conditions')}}"
                                    >
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\CentralLogics\translate('terms_and_condition')}}</span>
                                    </a>
                                </li>

                                <li class="nav-item {{Request::is('admin/admin-settings/about-us')?'active':''}}">
                                    <a class="nav-link "
                                       href="{{route('admin.admin-settings.about-us')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\CentralLogics\translate('about_us')}}</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <!-- End Pages -->


                        <li class="nav-item">
                            <small class="nav-subtitle"
                                   title="Documentation"> {{\App\CentralLogics\translate('User section')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <!-- Pages -->
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/users*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="{{route('admin.user.list')}}"
                            >
                                <i class="tio-poi-user nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    Users list
                                </span>
                            </a>
                        </li>
                       

                       
                        <li class="nav-item" style="padding-top: 100px">
                            <div class="nav-divider"></div>
                        </li>
                    </ul>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </aside>
</div>
