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
                        Daftar Pengguna
                    </h2>
                    <div class="text-muted mt-1">
                        {{ $users->firstItem() ?? '0' }}-{{ $users->lastItem() ?? '0' }} dari {{ $users->total() }} pengguna
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list d-flex">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modalAdd" id="btnAdd">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Tambah pengguna
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                            data-bs-target="#modalAdd" aria-label="Tambah pengguna">
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
                        <input type="text" class="form-control" placeholder="Cari pengguna ..." id="inputSearch"
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

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                @foreach ($users as $user)
                    <div class="col-md-4 col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body p-4 text-center">
                                <span class="avatar avatar-xl mb-3 rounded"
                                    style="background-image: url({{ asset('img/users/' . ($user->photo ? $user->photo : 'default.jpg')) }})"></span>
                                <h3 class="m-0 mb-1">{{ $user->name }}</h3>
                                <div class="text-muted">{{ $user->username }}</div>
                                <div class="mt-3">
                                    <span
                                        class="badge {{ $user->role == 'manager' ? 'bg-purple-lt' : ($user->role == 'administrator' ? 'bg-indigo-lt' : 'bg-green-lt') }}">{{ ucfirst($user->role) }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('users.edit', $user->id) }}" class="card-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler me-2 icon-tabler-edit"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                        </path>
                                        <path d="M16 5l3 3"></path>
                                    </svg>
                                    Ubah
                                </a>
                                <a href="#" class="card-btn btn-action-delete"
                                    data-action="{{ route('users.destroy', $user->id) }}" data-bs-toggle="modal"
                                    data-bs-target="#modalDelete">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler me-2 icon-tabler-trash" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="4" y1="7" x2="20" y2="7"></line>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                    </svg>
                                    Hapus
                                </a>
                            </div>
                            <div class="card-footer">
                                <div class="text-muted fs-5">
                                    Terakhir diubah {{ $user->updated_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($users->count() == 0)
                    <div class="empty">
                        <div class="empty-img"><img src="{{ asset('img\error\undraw_quitting_time_dm8t.svg') }}"
                                height="128">
                        </div>
                        <p class="empty-title">Pengguna tidak ditemukan</p>
                        <p class="empty-subtitle text-muted">
                            Coba sesuaikan pencarian atau filter anda untuk menemukan apa yang anda cari.
                        </p>
                        <div class="empty-action">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M4 7l16 0m-10 4l0 6m4 -6l0 6m-9 -10l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12m-10 0v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                                    </path>
                                </svg>
                                Bersihkan opsi pencarian
                            </a>
                        </div>
                    </div>
                @endif
                <div class="mt-3">
                    {{ $users->withQueryString()->onEachSide(1)->links('pagination.custom') }}
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
                                <div class="form-label">Peran</div>
                                <select class="form-select" name="role">
                                    <option value="" disabled selected>Pilih</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}"
                                            {{ request()->role == $role ? 'selected' : '' }}>
                                            {{ ucfirst($role) }}
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
                                    @foreach ($sortables as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ request()->sortby == $key ? 'selected' : '' }}>
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
                        <a href="{{ route('users.index') }}" class="btn btn-outline-danger">Bersihkan opsi</a>
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
                    <h5 class="modal-title">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label required">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" placeholder="Nama pengguna" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label required">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" placeholder="Username pengguna" value="{{ old('username') }}" />
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label required">Kata Sandi</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="Kata sandi pengguna" value="{{ old('password') }}" />
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label required">Konfirmasi Kata Sandi</label>
                                <input type="password"
                                    class="form-control @error('confirmed_password') is-invalid @enderror"
                                    name="confirmed_password" placeholder="Konfirmasi kata sandi"
                                    value="{{ old('confirmed_password') }}" />
                                @error('confirmed_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="rom mb-3">
                            <div class="col">
                                <div class="form-label required">Peran</div>
                                <div class="form-selectgroup">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="role" value="administrator"
                                            class="form-selectgroup-input"
                                            {{ old('role') == 'administrator' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            Administrator
                                        </span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="role" value="manager"
                                            class="form-selectgroup-input"
                                            {{ old('role') == 'manager' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            Manager
                                        </span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="role" value="cashier"
                                            class="form-selectgroup-input"
                                            {{ old('role') == 'cashier' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            Cashier
                                        </span>
                                    </label>
                                </div>
                                @error('role')
                                    <div class="text-danger fs-5 mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="rom mb-3">
                            <div class="col">
                                <div class="form-label">Avatar</div>
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="avatar avatar-md" id="avatarPreview"
                                            style="background-image: url({{ asset('img/users/default.jpg') }})"></span>
                                    </div>
                                    <div class="col-auto">
                                        <label id="avatarLabel" for="avatar"
                                            class="btn btn-outline-primary me-2">Unggah Avatar</label>
                                        <button class="btn btn-outline-danger d-none" id="btnDeleteAvatar">Hapus
                                            Avatar</button>
                                        <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                            name="photo" id="avatar" hidden>
                                        @error('photo')
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
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Tambah Pengguna</button>
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

        $('#btnDeleteAvatar').click(function(e) {
            e.preventDefault();
            $('#avatarPreview').css('background-image', 'url({{ asset('img/users/default.jpg') }})');
            $('#avatarLabel').text('Unggah Avatar');
            $('#avatar').val('');
            $(this).addClass('d-none');
        });

        $('#avatar').change(function() {
            if (this.files && this.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#avatarPreview').css('background-image', 'url(' + e.target.result + ')');
                }
                reader.readAsDataURL(this.files[0]);
                $('#avatarLabel').text('Ubah Avatar');
                $('#btnDeleteAvatar').removeClass('d-none');
            }
        });
    </script>
@endsection
