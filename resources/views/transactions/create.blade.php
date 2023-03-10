@extends('main')

@section('custom-css')
    <style>
        .cart-button-container {
            position: fixed;
            bottom: 25px;
            right: 25px;
            z-index: 999;
        }

        #button-show-cart {
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
            opacity: 0.9;
        }
    </style>
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Halaman
                    </div>
                    <h2 class="page-title">
                        Input Pesanan
                    </h2>
                </div>
            </div>
            <div class="row g-2 align-items-center">
                <div class="col-md-3 mt-3">
                    <div class="input-icon">
                        <input type="text" name="search" class="form-control form-control-rounded" placeholder="Cari menu…" id="searchInput">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="10" cy="10" r="7"></circle>
                                <line x1="21" y1="21" x2="15" y2="15"></line>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="col-auto ms-md-2 mt-3">
                    <div class="form-selectgroup form-selectgroup-pills">
                        <label class="form-selectgroup-item">
                            <input type="radio" name="category" value="all"
                                class="form-selectgroup-input filter-menu-input" checked>
                            <span class="form-selectgroup-label">Semua</span>
                        </label>
                        <label class="form-selectgroup-item">
                            <input type="radio" name="category" value="Minuman"
                                class="form-selectgroup-input filter-menu-input">
                            <span class="form-selectgroup-label">Minuman</span>
                        </label>
                        <label class="form-selectgroup-item">
                            <input type="radio" name="category" value="Makanan"
                                class="form-selectgroup-input filter-menu-input">
                            <span class="form-selectgroup-label">Makanan</span>
                        </label>
                        <label class="form-selectgroup-item">
                            <input type="radio" name="category" value="Camilan"
                                class="form-selectgroup-input filter-menu-input">
                            <span class="form-selectgroup-label">Camilan</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-lg-7 col-xl-8" style="max-height: 500px; overflow-y: auto;">
                    <div class="row row-deck row-cards" id="menuContainer">
                        @foreach ($menus as $menu)
                            <div class="col-6 col-sm-4 col-md-4 col-xl-4">
                                <div class="card">
                                    <div class="img-responsive card-img-top"
                                        style="background-image: url({{ asset('img/menus/' . ($menu->img ?? 'default.jpg')) }})">
                                    </div>
                                    <div class="card-body p-3">
                                        <span
                                            class="badge badge-outline {{ $menu->category->name == 'Minuman' ? 'text-indigo' : ($menu->category->name == 'Makanan' ? 'text-purple' : 'text-pink') }} fs-6">{{ $menu->category->name }}</span>
                                        <h3 class="m-0 mb-1 mt-1">
                                            {{ $menu->name }}
                                        </h3>
                                        <div class="text-muted">
                                            Rp {{ number_format($menu->price, 0, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="card-footer" style="padding: 0.5rem 1rem;">
                                        <a href="#" class="btn btn-outline-indigo w-100"
                                            onclick="addToCart({{ $menu->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-shopping-cart-plus" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M17 17h-11v-14h-2"></path>
                                                <path d="M6 5l6 .429m7.138 6.573l-.143 1h-13"></path>
                                                <path d="M15 6h6m-3 -3v6"></path>
                                            </svg>
                                            Tambah
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if ($menus->count() == 0)
                            <div class="empty">
                                <div class="empty-img"><img src="{{ asset('img\error\undraw_quitting_time_dm8t.svg') }}"
                                        height="128"></div>
                                <p class="empty-title">Menu tidak ditemukan</p>
                                <p class="empty-subtitle text-muted">
                                    Perintah admin untuk menambahkan menu baru.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4 d-none d-lg-block">
                    <div class="card" style="height: 500px">
                        <div class="card-header">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-shopping-cart me-1" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M17 17h-11v-14h-2"></path>
                                    <path d="M6 5l14 1l-1 7h-13"></path>
                                </svg>
                                Keranjang
                            </h3>
                            <div class="ms-auto">
                                <button href="#" class="btn btn-outline-danger w-100 d-none" onclick="clearCart()"
                                    id="btnClearCart">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M4 7l16 0m-10 4l0 6m4 -6l0 6m-9 -10l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12m-10 0v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                                        </path>
                                    </svg>
                                    Bersihkan
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0" id="cartContainer" style="overflow-y: auto; height: 400px">
                            <ul class="list-group list-group-flush placeholder-glow">
                                @for ($i = 0; $i < 6; $i++)
                                    <li class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar placeholder"></div>
                                            </div>
                                            <div class="col-7">
                                                <div class="placeholder placeholder-xs col-9"></div>
                                                <div class="placeholder placeholder-xs col-7"></div>
                                            </div>
                                            <div class="col-2 ms-auto text-end">
                                                <div class="placeholder placeholder-xs col-8"></div>
                                                <div class="placeholder placeholder-xs col-10"></div>
                                            </div>
                                        </div>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <div class="text-muted">Total</div>
                                    <div class="text-truncate">
                                        <strong id="totalPrice">Rp 0</strong>
                                    </div>
                                </div>
                                <div class="col-auto align-self-center">
                                    <button class="btn btn-indigo btn-pill" id="btnCheckout" disabled
                                        data-bs-toggle="modal" data-bs-target="#modal-checkout" onclick="setFormCheckoutValue()">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 5l0 14"></path>
                                            <path d="M5 12l14 0"></path>
                                        </svg>
                                        <span>Checkout</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Button show cart canvas --}}
    <div class="cart-button-container d-lg-none">
        <a class="btn position-relative btn-bitbucket btn-icon rounded-circle btn-lg" id="button-show-cart" data-bs-toggle="offcanvas" href="#offcanvasEnd" role="button" aria-controls="offcanvasEnd">
            <!-- Download SVG icon from http://tabler-icons.io/i/brand-bitbucket -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart p-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                <path d="M17 17h-11v-14h-2"></path>
                <path d="M6 5l14 1l-1 7h-13"></path>
            </svg>
            <span class="badge bg-red badge-notification badge-pill fs-4 d-none" style="top: 3px!important; right: 3px!important" id="cartCount"></span>
        </a>
    </div>

    {{-- Off canvas end --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
        <div class="offcanvas-header" style="height: 60px">
            <h3 class="mt-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="icon icon-tabler icon-tabler-shopping-cart me-1" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M17 17h-11v-14h-2"></path>
                    <path d="M6 5l14 1l-1 7h-13"></path>
                </svg>
                Keranjang
            </h3>
            <div class="ms-auto d-flex align-items-center">
                <button href="#" class="btn btn-outline-danger w-100 d-none me-3" onclick="clearCart()"
                    id="btnClearCartCanvas">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1"
                        stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path
                            d="M4 7l16 0m-10 4l0 6m4 -6l0 6m-9 -10l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12m-10 0v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                        </path>
                    </svg>
                    Bersihkan
                </button>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
        </div>
        <div class="offcanvas-body p-0">
            <div class="p-0 d-inline" id="cartContainerCanvas">
                <ul class="list-group list-group-flush placeholder-glow">
                    @for ($i = 0; $i < 10; $i++)
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar placeholder"></div>
                                </div>
                                <div class="col-7">
                                    <div class="placeholder placeholder-xs col-9"></div>
                                    <div class="placeholder placeholder-xs col-7"></div>
                                </div>
                                <div class="col-2 ms-auto text-end">
                                    <div class="placeholder placeholder-xs col-8"></div>
                                    <div class="placeholder placeholder-xs col-10"></div>
                                </div>
                            </div>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
        <div class="offcanvas-footer border-top" style="background-color: #f8fafc;">
            <div class="row">
                <div class="col">
                    <div class="text-muted">Total</div>
                    <div class="text-truncate">
                        <strong id="totalPriceCanvas">Rp 0</strong>
                    </div>
                </div>
                <div class="col-auto align-self-center">
                    <button class="btn btn-indigo btn-pill" id="btnCheckoutCanvas" disabled
                        data-bs-toggle="modal" data-bs-target="#modal-checkout" onclick="setFormCheckoutValue()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        <span>Checkout</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal checkout --}}
    <div class="modal modal-blur fade" id="modal-checkout" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="formOption" action="{{ route('transactions.store') }}">
                    @csrf
                    <input type="hidden" name="orderedMenus" id="menusInput">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label required">Pilih No. Meja</label>
                                <select type="text" class="form-select @error('table_id') is-invalid @enderror" placeholder="Pilih meja" id="select-table" name="table_id">
                                    <option value="" disabled selected>Pilih</option>
                                    @foreach ($tables as $table)
                                        <option value="{{ $table->id }}" {{ $table->is_available ? '' : 'disabled' }} {{ old('table_id') == $table->id ? 'selected' : '' }}>
                                            Nomor {{ $table->number }} ({{ $table->is_available ? $table->capacity . ' orang' : 'tidak tersedia' }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('table_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label">Nama Customer</label>
                                <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customerInput" name="customer_name" placeholder="Nama customer tidak wajib" value="{{ old('customer_name') }}">
                                @error('customer_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label">Catatan</label>
                                <textarea class="form-control @error('note') is-invalid @enderror" name="note" rows="6" placeholder="Catatan tidak wajib" style="height: 57px;">{{ old('note') }}</textarea>
                                @error('note')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label">Total Harga</label>
                                <input type="text" class="form-control" id="totalPriceInModal" value="Rp 0" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-indigo" id="btnSubmitForm" data-bs-dismiss="modal">Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('library-js')
    <script src="{{ asset('plugins/tabler/dist/libs/tom-select/dist/js/tom-select.base.min.js?1669759017') }}" defer></script>
@endsection

@section('custom-js')
    <script>
        const allMenu = {!! $menus !!}
        const baseUrl = '{{ url('/') }}'

        $(document).ready(function() {
            @if(session('success'))
                clearCart()
            @endif
            checkCart()
            @if($errors->any())
                $('#modal-checkout').modal('show')
                setFormCheckoutValue()
            @endif
        })

        $('input[name="category"], input[name="search"]').on('change keyup', function() {
            onFilter()
        })

        function onFilter() {
            const search = $('input[name="search"]').val()
            const category = $('input[name="category"]:checked').val()
            const filteredMenu = filterMenu(allMenu, search, category)
            setMenuContainer(filteredMenu)
        }

        function filterMenu(menus, search, category) {
            if (category == 'all' && search == '') {
                return menus
            } else if (category == 'all' && search != '') {
                return menus.filter(menu => menu.name.toLowerCase().includes(search.toLowerCase()))
            } else if (category != 'all' && search == '') {
                return menus.filter(menu => menu.category.name == category)
            }
            return menus.filter(menu => menu.name.toLowerCase().includes(search.toLowerCase()) && menu.category.name ==
                category)
        }

        function renderMenus(menus) {
            let html = ''
            if (menus.length == 0) {
                html += `
                    <div class="empty mt-md-5">
                        <div class="empty-img"><img src="${baseUrl}/img/error/404_not_found.svg"
                                height="128">
                        </div>
                        <p class="empty-title">Menu tidak ditemukan</p>
                        <p class="empty-subtitle text-muted">
                            Coba sesuaikan pencarian atau filter anda untuk menemukan apa yang anda cari.
                        </p>
                        <div class="empty-action">
                            <button class="btn btn-outline-danger" onclick="clearFilter()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M4 7l16 0m-10 4l0 6m4 -6l0 6m-9 -10l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12m-10 0v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                                    </path>
                                </svg>
                                Bersihkan filter pencarian
                            </button>
                        </div>
                    </div>
                `
            }
            menus.forEach(menu => {
                html += `
                    <div class="col-6 col-sm-4 col-md-4 col-xl-4">
                        <div class="card">
                            <div class="img-responsive card-img-top" style="background-image: url('${baseUrl}/img/menus/${menu.image ?? 'default.jpg'}')"></div>
                            <div class="card-body p-3">
                                <span class="badge badge-outline ${getClassByCategory(menu.category.name)} fs-6">${menu.category.name}</span>
                                <h3 class="m-0 mb-1 mt-1">
                                    ${menu.name}
                                </h3>
                                <div class="text-muted">
                                    ${numberToRupiah(menu.price)}
                                </div>
                            </div>
                            <div class="card-footer" style="padding: 0.5rem 1rem;">
                                <a href="#" class="btn btn-outline-indigo w-100" onclick="addToCart(${menu.id})">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-shopping-cart-plus" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M17 17h-11v-14h-2"></path>
                                        <path d="M6 5l6 .429m7.138 6.573l-.143 1h-13"></path>
                                        <path d="M15 6h6m-3 -3v6"></path>
                                    </svg>
                                    Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                `
            })
            return html
        }

        function getClassByCategory(category) {
            switch (category) {
                case 'Minuman':
                    return 'text-indigo'
                case 'Makanan':
                    return 'text-purple'
                default:
                    return 'text-pink'
            }
        }

        function numberToRupiah(number) {
            return number.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
            }).replace(/,00/g, '')
        }

        function setMenuContainer(menus) {
            $('#menuContainer').html(renderMenus(menus))
        }

        function addToCart(menuId) {
            const menu = allMenu.find(menu => menu.id == menuId)
            const cart = JSON.parse(localStorage.getItem('cart')) ?? []
            const cartItem = cart.find(item => item.id == menuId)
            if (cartItem) {
                cartItem.qty++
            } else {
                cart.push({
                    id: menu.id,
                    name: menu.name,
                    price: menu.price,
                    qty: 1,
                    img: menu.img
                })
            }
            localStorage.setItem('cart', JSON.stringify(cart))
            checkCart()
        }

        function clearCart() {
            localStorage.removeItem('cart')
            checkCart()
        }

        function showBtnClearCart() {
            $('#btnClearCart').removeClass('d-none')
            $('#btnClearCartCanvas').removeClass('d-none')
        }

        function hideBtnClearCart() {
            $('#btnClearCart').addClass('d-none')
            $('#btnClearCartCanvas').addClass('d-none')
        }

        function checkCart() {
            const cart = JSON.parse(localStorage.getItem('cart')) ?? []
            if (cart.length > 0) {
                showBtnClearCart()
                setCartContainer(cart)
                setTotalPrice(cart)
                setCartCount(cart)
                enableCheckoutBtn()
            } else {
                hideBtnClearCart()
                setCartContainer([])
                setTotalPrice([])
                setCartCount([])
                disableCheckoutBtn()
            }
        }

        function renderCart(items) {
            if (items.length == 0) {
                return `
                    <div class="empty">
                        <div class="empty-img"><img src="${baseUrl}/img/error/undraw_quitting_time_dm8t.svg"
                                height="128"></div>
                        <p class="empty-title">Keranjang masih kosong</p>
                        <p class="empty-subtitle text-muted">
                            Pilih menu untuk ditambahkan ke keranjang terlebih dahulu
                        </p>
                    </div>
                `
            }
            let html = '<ul class="list-group list-group-flush">'
            items.forEach(item => {
                totalPrice += item.price * item.qty
                html += `
                    <li class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar" style="background-image: url('${baseUrl}/img/menus/${item.img ?? 'default.jpg'}')"></span>
                            </div>
                            <div class="col-auto">
                                <div class="fw-bold">${item.name}</div>
                                <div class="col text-muted">${numberToRupiah(item.price * item.qty)}</div>
                            </div>
                            <div class="col-auto ms-auto">
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-icon btn-sm btn-outline-indigo" onclick="decreaseQty(this, ${item.id})">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-minus" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </button>
                                    <span class="mx-3 qty-counter">${item.qty}</span>
                                    <button class="btn btn-icon btn-sm btn-outline-indigo" onclick="increaseQty(this, ${item.id})">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-plus" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                `
            })
            html += '</ul>'
            return html
        }

        function setCartContainer(items) {
            $('#cartContainer').html(renderCart(items))
            $('#cartContainerCanvas').html(renderCart(items))
        }

        function increaseQty(el, id) {
            const cart = JSON.parse(localStorage.getItem('cart'))
            const cartItem = cart.find(item => item.id == id)
            cartItem.qty++
            localStorage.setItem('cart', JSON.stringify(cart))
            $(el).parent().find('.qty-counter').text(cartItem.qty)
            checkCart()
        }

        function decreaseQty(el, id) {
            const cart = JSON.parse(localStorage.getItem('cart'))
            const cartItem = cart.find(item => item.id == id)
            if (cartItem.qty > 1) {
                cartItem.qty--
                localStorage.setItem('cart', JSON.stringify(cart))
                $(el).parent().find('.qty-counter').text(cartItem.qty)
            } else {
                const index = cart.findIndex(item => item.id == id)
                cart.splice(index, 1)
                localStorage.setItem('cart', JSON.stringify(cart))
            }
            checkCart()
        }

        function setTotalPrice(items) {
            let totalPrice = 0
            items.forEach(item => {
                totalPrice += item.price * item.qty
            })
            $('#totalPrice').text(numberToRupiah(totalPrice))
            $('#totalPriceCanvas').text(numberToRupiah(totalPrice))
        }

        function disableCheckoutBtn() {
            $('#btnCheckout').attr('disabled', true)
            $('#btnCheckoutCanvas').attr('disabled', true)
        }

        function enableCheckoutBtn() {
            $('#btnCheckout').removeAttr('disabled')
            $('#btnCheckoutCanvas').removeAttr('disabled')
        }

        function clearFilter() {
            $('#searchInput').val('')
            $('.filter-menu-input[value="all"]').click()
            onFilter()
        }

        function setFormCheckoutValue() {
            const cart = JSON.parse(localStorage.getItem('cart'))
            const table = JSON.parse(localStorage.getItem('table'))
            $('#menusInput').val(JSON.stringify(cart))
            $('#totalPriceInModal').val($('#totalPrice').text())
        }

        function countItems(cart) {
            let count = 0
            cart.forEach(item => {
                count += item.qty
            })
            return count
        }

        function setCartCount(cart) {
            const count = countItems(cart)
            $('#cartCount').text(count)
            if (count == 0) {
                $('#cartCount').addClass('d-none')
            } else {
                $('#cartCount').removeClass('d-none')
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            var el;
            window.TomSelect && (new TomSelect(el = document.getElementById('select-table'), {
                copyClassesToDropdown: false,
                dropdownClass: 'dropdown-menu ts-dropdown',
                optionClass: 'dropdown-item',
                controlInput: '<input>',
                render: {
                    item: function(data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data
                                .customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                    option: function(data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data
                                .customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                },
            }));
        });
    </script>
@endsection
