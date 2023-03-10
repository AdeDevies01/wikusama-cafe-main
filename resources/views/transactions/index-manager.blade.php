@extends('main')

@section('custom-css')
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
                        Riwayat Transaksi
                    </h2>
                    <div class="text-muted mt-1">
                        {{ $transactions->firstItem() ?? '0' }}-{{ $transactions->lastItem() ?? '0' }} dari {{ $transactions->total() }} transaksi
                    </div>
                </div>
            </div>
            <div class="row g-2 align-items-center">
                <div class="col-10 col-md-6 col-xl-4 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari transaksi..." id="inputSearch"
                            value="{{ request()->q }}">
                        <button class="btn" type="button" id="btnSearch">
                            Cari
                        </button>
                    </div>
                </div>
                <div class="col-2 col-md-2 mt-3">
                    <a href="#" class="btn btn-outline-primary btn-icon" data-bs-toggle="modal"
                        data-bs-target="#modalOption">
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
                                        <th>Kasir</th>
                                        <th>Nama Customer</th>
                                        <th>No. Meja</th>
                                        <th>Total Tagihan</th>
                                        <th>Waktu Dibuat</th>
                                        <th>Waktu Dibayar</th>
                                        <th>Status</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = $transactions->firstItem() ?? 1;
                                    @endphp
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td><span class="text-muted">{{ $no++ }}</span></td>
                                            <td>
                                                <div class="d-flex py-1 align-items-center">
                                                    <span class="avatar me-2" style="background-image: url({{ asset('img/users/' . ($transaction->cashier->photo ?? 'default.jpg')) }})"></span>
                                                    <div class="flex-fill">
                                                        <div class="font-weight-medium">{{ $transaction->cashier->name ?? '<kasir dihapus>' }}</div>
                                                        <div class="text-muted">{{ $transaction->cashier->username ?? '-' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $transaction->customer_name ?? '-' }}</td>
                                            <td>{{ $transaction->table->number ?? '<meja dihapus>' }}</td>
                                            <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                            <td>{{ date('d M Y - H:i:s', strtotime($transaction->created_at)) }}</td>
                                            <td>{{ $transaction->is_paid ? date('d M Y - H:i:s', strtotime($transaction->updated_at)) : '-' }}</td>
                                            <td>
                                                @if ($transaction->is_paid)
                                                    <span class="badge badge-outline text-green">Sudah dibayar</span>
                                                @else
                                                    <span class="badge badge-outline text-red">Belum dibayar</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-list justify-content-center">
                                                    <a href="{{ route('transactions-manager.show', $transaction->id) }}" class="btn btn-icon btn-pill bg-primary-lt" data-bs-toggle="tooltip" data-bs-original-title="Detail transaksi" data-bs-placement="bottom">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                            <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($transactions->count() == 0)
                                        <tr class="text-center">
                                            <td colspan="9">
                                                <div class="empty">
                                                    <div class="empty-img"><img src="{{ asset('img\error\undraw_quitting_time_dm8t.svg') }}"
                                                            height="128">
                                                    </div>
                                                    <p class="empty-title">Transaksi tidak ditemukan</p>
                                                    <p class="empty-subtitle text-muted">
                                                        Coba sesuaikan pencarian atau filter anda untuk menemukan apa yang anda cari.
                                                    </p>
                                                    <div class="empty-action">
                                                        <a href="{{ route('transactions-manager.index') }}" class="btn btn-outline-danger">
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
                        @if($transactions->perPage() < $transactions->total())
                            <div class="mt-3 ms-3">
                                {{ $transactions->withQueryString()->onEachSide(1)->links('pagination.custom') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal option --}}
    <div class="modal modal-blur fade" id="modalOption" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <label class="form-label">Pilih kasir</label>
                                <select type="text" class="form-select placeholder="Pilih kasir" id="select-table" name="cashier_id">
                                    <option value="" disabled selected>Pilih</option>
                                    @foreach ($cashiers as $cashier)
                                        <option value="{{ $cashier->id }}" {{ request()->cashier_id == $cashier->id ? 'selected' : '' }}>
                                            {{ $cashier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-label">Dari</div>
                                <div class="input-icon">
                                    <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
                                    </span>
                                    <input class="form-control" name="start_date" placeholder="Tanggal awal" id="datepicker-icon-prepend" value="{{ request()->start_date }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-label">Hingga</div>
                                <div class="input-icon">
                                    <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
                                    </span>
                                    <input class="form-control" name="end_date" placeholder="Tanggal akhir" id="datepicker-icon-prepend2" value="{{ request()->end_date }}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-label">Status pembayaran</div>
                                <div class="form-selectgroup">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="is_paid" value="1"
                                            class="form-selectgroup-input"
                                            {{ request()->is_paid == '1' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            Sudah dibayar
                                        </span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="is_paid" value="0"
                                            class="form-selectgroup-input"
                                            {{ request()->is_paid == '0' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            Belum dibayar
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
                        <a href="{{ route('transactions-manager.index') }}" class="btn btn-outline-danger">Bersihkan opsi</a>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                            id="btnFormOption">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('library-js')
    <script src="{{ asset('plugins/tabler/dist/libs/tom-select/dist/js/tom-select.base.min.js?1669759017') }}" defer></script>
    <script src="{{ asset('plugins/tabler/dist/libs/litepicker/dist/litepicker.js?1669759017') }}"></script>
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

        document.addEventListener("DOMContentLoaded", function () {
            window.Litepicker && (new Litepicker({
                element: document.getElementById('datepicker-icon-prepend'),
                buttonText: {
                    previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                    nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
                },
            }));
            window.Litepicker && (new Litepicker({
                element: document.getElementById('datepicker-icon-prepend2'),
                buttonText: {
                    previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                    nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
                },
            }));
        });
    </script>
@endsection
