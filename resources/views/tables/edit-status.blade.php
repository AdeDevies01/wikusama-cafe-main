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
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Halaman
                    </div>
                    <h2 class="page-title">
                        Ubah Status Meja
                    </h2>
                    <div class="text-muted mt-1">
                        {{ $tables->firstItem() ?? '0' }}-{{ $tables->lastItem() ?? '0' }} dari {{ $tables->total() }} meja
                    </div>
                </div>
            </div>
            <div class="row g-2 align-items-center">
                <div class="col-10 col-md-6 col-xl-4 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari meja..." id="inputSearch"
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
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">No.</th>
                                        <th>No. Meja</th>
                                        <th>Kapasitas</th>
                                        <th>Deskripsi</th>
                                        <th>Terakhir Diupdate</th>
                                        <th>Status</th>
                                        <th class="text-center">Ubah Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = $tables->firstItem() ?? 1;
                                    @endphp
                                    @foreach ($tables as $table)
                                        <tr>
                                            <td><span class="text-muted">{{ $no++ }}</span></td>
                                            <td>Nomor {{ $table->number }}</td>
                                            <td>{{ $table->capacity }} orang</td>
                                            <td>{{ mb_strimwidth($table->desc, 0, 50, '...') }}</td>
                                            <td>{{ date('d F Y', strtotime($table->updated_at)) }}</td>
                                            <td>
                                                @if($table->is_available == 1)
                                                    <span class="badge badge-outline text-green">Tersedia</span>
                                                @else
                                                    <span class="badge badge-outline text-red">Tidak Tersedia</span>
                                                @endif
                                            </td>
                                            <td style="display: flex; justify-content: center; align-items: center;">
                                                <span class="form-check form-switch">
                                                    <form action="{{ route('tables.updateStatus', $table->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input class="form-check-input update-status-input" name="is_available" type="checkbox" {{ $table->is_available == 1 ? 'checked' : '' }} onchange="this.form.submit()">
                                                    </form>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($tables->count() == 0)
                                        <tr class="text-center">
                                            <td colspan="7">
                                                <div class="empty">
                                                    <div class="empty-img"><img src="{{ asset('img\error\undraw_quitting_time_dm8t.svg') }}"
                                                            height="128">
                                                    </div>
                                                    <p class="empty-title">Meja tidak ditemukan</p>
                                                    <p class="empty-subtitle text-muted">
                                                        Coba sesuaikan pencarian atau filter anda untuk menemukan apa yang anda cari.
                                                    </p>
                                                    <div class="empty-action">
                                                        <a href="{{ route('tables.editStatus') }}" class="btn btn-outline-danger">
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
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if($tables->perPage() < $tables->total())
                            <div class="mt-3 ms-3">
                                {{ $tables->withQueryString()->onEachSide(1)->links('pagination.custom') }}
                            </div>
                        @endif
                    </div>
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
                                        <input type="radio" name="limit" value="25"
                                            class="form-selectgroup-input"
                                            {{ request()->limit == '25' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            25
                                        </span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="limit" value="50"
                                            class="form-selectgroup-input"
                                            {{ request()->limit == '50' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            50
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
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="limit" value="200"
                                            class="form-selectgroup-input"
                                            {{ request()->limit == '200' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            200
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-label">Status</div>
                                <div class="form-selectgroup">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="is_available" value="1"
                                            class="form-selectgroup-input"
                                            {{ request()->is_available == '1' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            Tersedia
                                        </span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="is_available" value="0"
                                            class="form-selectgroup-input"
                                            {{ request()->is_available == '0' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            Tidak Tersedia
                                        </span>
                                    </label>
                                </div>
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
                        <a href="{{ route('tables.editStatus') }}" class="btn btn-outline-danger">Bersihkan opsi</a>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                            id="btnFormOption">Cari</button>
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
    </script>
@endsection
