@extends('main')

@section('custom-css')
    <style>
        .btn-action-delete:hover {
            background-color: #f44336;
            color: white;
            transition: 0.3s;
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
                        Daftar Menu
                    </h2>
                    <div class="text-muted mt-1">
                        {{ $menus->firstItem() ?? '0' }}-{{ $menus->lastItem() ?? '0' }} dari {{ $menus->total() }} menu
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalAdd">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Tambah menu
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modalAdd">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row g-2 align-items-center">
                <div class="col-10 col-md-4 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari menu ..." id="inputSearch"
                            value="{{ request()->q }}">
                        <button class="btn" type="button" id="btnSearch">
                            Cari
                        </button>
                    </div>
                </div>
                <div class="col-2 col-md-2 mt-3">
                    <a href="#" class="btn btn-outline-primary btn-icon" data-bs-toggle="modal"
                        data-bs-target="#modal-option">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments-horizontal"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="14" cy="6" r="2"></circle>
                            <line x1="4" y1="6" x2="12" y2="6"></line>
                            <line x1="16" y1="6" x2="20" y2="6"></line>
                            <circle cx="8" cy="12" r="2"></circle>
                            <line x1="4" y1="12" x2="6" y2="12"></line>
                            <line x1="10" y1="12" x2="20" y2="12"></line>
                            <circle cx="17" cy="18" r="2"></circle>
                            <line x1="4" y1="18" x2="15" y2="18"></line>
                            <line x1="19" y1="18" x2="20" y2="18"></line>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                @foreach ($menus as $menu)
                    <div class="col-md-4 col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="position-absolute top-0 end-0">
                                <div class="dropdown">
                                    <button href="#" class="btn btn-icon btn-light m-2 opacity-75" data-bs-toggle="dropdown" aria-label="Show options" style="border: none; min-width: 30px; min-height: 30px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0m8 0m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0m8 0m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="{{ route('menus.edit', $menu->id) }}" class="dropdown-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1m3.385 -10.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415zm-4.385 -1.585l3 3"></path>
                                            </svg>
                                            Ubah
                                        </a>
                                        <button class="dropdown-item btn-action-delete" data-bs-toggle="modal" data-bs-target="#modalDelete" data-action="{{ route('menus.destroy', $menu->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <line x1="4" y1="7" x2="20" y2="7" />
                                                <line x1="10" y1="11" x2="10" y2="17" />
                                                <line x1="14" y1="11" x2="14" y2="17" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="img-responsive card-img-top" style="background-image: url({{ asset('img/menus/' . ($menu->img ?? 'default.jpg')) }})"></div>
                            <div class="card-body p-3">
                                <span class="badge badge-outline {{ $menu->category->name == 'Minuman' ? 'text-indigo' : ($menu->category->name == 'Makanan' ? 'text-purple' : 'text-pink')}} fs-6">{{ $menu->category->name }}</span>
                                <h3 class="m-0 mb-1 mt-1">
                                    {{ $menu->name }}
                                </h3>
                                <div class="text-muted">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </div>
                                <div class="text-muted fs-5 mt-2">
                                    {{ mb_strimwidth($menu->desc, 0, 150, "...") }}
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-muted fs-5">
                                    Terakhir diubah {{ $menu->updated_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($menus->count() == 0)
                    <div class="empty">
                        <div class="empty-img"><img src="{{ asset('img\error\undraw_quitting_time_dm8t.svg') }}" height="128"></div>
                        <p class="empty-title">Menu tidak ditemukan</p>
                        <p class="empty-subtitle text-muted">
                            Coba sesuaikan pencarian atau filter anda untuk menemukan apa yang anda cari.
                        </p>
                        <div class="empty-action">
                            <a href="{{ route('menus.index') }}" class="btn btn-outline-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 7l16 0m-10 4l0 6m4 -6l0 6m-9 -10l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12m-10 0v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                </svg>
                                Bersihkan opsi pencarian
                            </a>
                        </div>
                    </div>
                @endif
                <div class="mt-3">
                    {{ $menus->withQueryString()->onEachSide(1)->links('pagination.custom') }}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal option --}}
    <div class="modal modal-blur fade" id="modal-option" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Opsi Pencarian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="GET" id="formOption">
                    <input type="hidden" name="q" id="q">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-label">Tampilkan</div>
                                <div class="form-selectgroup">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="limit" value="16"
                                            class="form-selectgroup-input"
                                            {{ request()->limit == '16' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            16
                                        </span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="limit" value="32"
                                            class="form-selectgroup-input"
                                            {{ request()->limit == '32' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            32
                                        </span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="limit" value="64"
                                            class="form-selectgroup-input"
                                            {{ request()->limit == '64' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            64
                                        </span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="limit" value="100"
                                            class="form-selectgroup-input"
                                            {{ request()->limit == '100' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            100
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-label">Kategori</div>
                                <select class="form-select" name="category">
                                    <option value="" disabled selected>Pilih</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request()->category == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-label">Urutkan berdasarkan</div>
                                <select class="form-select" name="sortby">
                                    <option value="" disabled selected>Pilih</option>
                                    @foreach ( $sortables as $key => $value)
                                        <option value="{{ $key }}" {{ request()->sortby == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-label">Urutan</div>
                                <div class="form-selectgroup">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="order" value="asc"
                                            class="form-selectgroup-input"
                                            {{ request()->order == 'asc' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-sort-ascending-letters me-1"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M15 10v-5c0 -1.38 .62 -2 2 -2s2 .62 2 2v5m0 -3h-4"></path>
                                                <path d="M19 21h-4l4 -7h-4"></path>
                                                <path d="M4 15l3 3l3 -3"></path>
                                                <path d="M7 6v12"></path>
                                            </svg>
                                            Ascending
                                        </span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="order" value="desc"
                                            class="form-selectgroup-input"
                                            {{ request()->order == 'desc' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-sort-descending-letters me-1"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M15 21v-5c0 -1.38 .62 -2 2 -2s2 .62 2 2v5m0 -3h-4"></path>
                                                <path d="M19 10h-4l4 -7h-4"></path>
                                                <path d="M4 15l3 3l3 -3"></path>
                                                <path d="M7 6v12"></path>
                                            </svg>
                                            Descending
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                        <a href="{{ route('menus.index') }}" class="btn btn-outline-danger">Bersihkan opsi</a>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                            id="btnFormOption">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal delete --}}
    <div class="modal modal-blur fade" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v2m0 4v.01" />
                        <path
                            d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                    <h3>Apakah anda yakin?</h3>
                    <div class="text-muted">Data yang dihapus tidak dapat dikembalikan.</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Batal
                                </a></div>
                            <div class="col">
                                <form method="post" id="formDelete">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger w-100" id="btnDelete">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal add --}}
    <div class="modal modal-blur fade" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('menus.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label required">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nama menu" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label required">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        Rp
                                    </span>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Harga menu" value="{{ old('price') }}" />
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('name') is-invalid @enderror" name="desc" rows="4" placeholder="Deskripsi menu ..."></textarea>
                                @error('desc')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-label required">Kategori</div>
                                <div class="form-selectgroup">
                                    @foreach ($categories as $category)
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="category_id" value="{{ $category->id }}" class="form-selectgroup-input" {{ old('category_id') == $category->id ? 'checked' : '' }}>
                                            <span class="form-selectgroup-label">{{ $category->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('category_id')
                                    <div class="text-danger fs-5 mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="rom mb-3">
                            <div class="col">
                                <div class="form-label">Foto</div>
                                <div class="row">
                                    <div class="col-8">
                                        <img src="{{ asset('img/menus/placeholder.png') }}" alt="Preview" id="imgPreview" class="img-fluid img-thumbnail rounded shadow-sm">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <label id="imgLabel" for="inputImg" class="btn btn-outline-primary me-2">Unggah Foto</label>
                                        <button class="btn btn-outline-danger d-none" id="btnDeleteImg">Hapus Foto</button>
                                        <input type="file" class="form-control @error('img') is-invalid @enderror" name="img" id="inputImg" hidden>
                                        @error('img')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Tambah Menu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('library-js')
@endsection

@section('custom-js')
    <script>
        const formOption = document.getElementById('formOption');
        const btnFormOption = document.getElementById('btnFormOption');

        const inputSearch = document.getElementById('inputSearch');
        const btnSearch = document.getElementById('btnSearch');
        const q = document.getElementById('q');

        btnFormOption.addEventListener('click', submitFormOption);
        btnSearch.addEventListener('click', submitFormOption);
        inputSearch.addEventListener('keyup', function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                btnSearch.click();
            }
        });

        function submitFormOption() {
            q.value = inputSearch.value;
            formOption.submit();
        }

        const modalDelete = document.getElementById('modalDelete');

        modalDelete.addEventListener('show.bs.modal', function(event) {
            formDelete.action = event.relatedTarget.dataset.action;
        });

        $(document).ready(function() {
            @if ($errors->any())
                $('#modalAdd').modal('show');
            @endif
        });

        $('#btnDeleteImg').click(function(e) {
            e.preventDefault();
            $('#imgPreview').attr('src', '{{ asset('img/menus/placeholder.png') }}');
            $('#imgLabel').text('Unggah Foto');
            $('#inputImg').val('');
            $(this).addClass('d-none');
        });

        $('#inputImg').change(function() {
            if (this.files && this.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#imgPreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
                $('#imgLabel').text('Ubah Foto');
                $('#btnDeleteImg').removeClass('d-none');
            }
        });
    </script>
@endsection
