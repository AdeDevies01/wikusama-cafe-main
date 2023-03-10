<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item {{ Request::is('cashier/add-transaction*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('transactions.create') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-grid-add" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                                    <path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                                    <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                                    <path d="M14 17h6m-3 -3v6"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Input Pesanan
                            </span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('cashier/transactions*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('transactions.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 6l11 0"></path>
                                    <path d="M9 12l11 0"></path>
                                    <path d="M9 18l11 0"></path>
                                    <path d="M5 6l0 .01"></path>
                                    <path d="M5 12l0 .01"></path>
                                    <path d="M5 18l0 .01"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Riwayat Transaksi
                            </span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('cashier/tables*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('tables.editStatus') }}">
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
                                Perbarui Meja
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
