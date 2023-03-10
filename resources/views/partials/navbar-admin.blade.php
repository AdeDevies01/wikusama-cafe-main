<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Pengguna
                            </span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/menus*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('menus.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coffee"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M3 14c.83 .642 2.077 1.017 3.5 1c1.423 .017 2.67 -.358 3.5 -1c.83 -.642 2.077 -1.017 3.5 -1c1.423 -.017 2.67 .358 3.5 1">
                                    </path>
                                    <path d="M8 3a2.4 2.4 0 0 0 -1 2a2.4 2.4 0 0 0 1 2"></path>
                                    <path d="M12 3a2.4 2.4 0 0 0 -1 2a2.4 2.4 0 0 0 1 2"></path>
                                    <path d="M3 10h14v5a6 6 0 0 1 -6 6h-2a6 6 0 0 1 -6 -6v-5z"></path>
                                    <path d="M16.746 16.726a3 3 0 1 0 .252 -5.555"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Menu
                            </span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/tables*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('tables.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-columns"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="4" y1="6" x2="9.5" y2="6"></line>
                                    <line x1="4" y1="10" x2="9.5" y2="10"></line>
                                    <line x1="4" y1="14" x2="9.5" y2="14"></line>
                                    <line x1="4" y1="18" x2="9.5" y2="18"></line>
                                    <line x1="14.5" y1="6" x2="20" y2="6"></line>
                                    <line x1="14.5" y1="10" x2="20" y2="10"></line>
                                    <line x1="14.5" y1="14" x2="20" y2="14"></line>
                                    <line x1="14.5" y1="18" x2="20" y2="18"></line>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Meja
                            </span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/activity-logs*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('activity-logs.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-activity"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 12h4l3 8l4 -16l3 8h4"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Log Aktivitas
                            </span>
                        </a>
                    </li>
                </ul>
                <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last d-none d-md-inline-block">
                    <span id="datetime"></span>
                </div>
            </div>
        </div>
    </div>
</div>
