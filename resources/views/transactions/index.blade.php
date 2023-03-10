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
                        Riwayat Transaksi Saya
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
                                            <td>{{ $transaction->customer_name ?? '-' }}</td>
                                            <td>{{ $transaction->table->number }}</td>
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
                                                    @if($transaction->is_paid)
                                                        <a href="{{ route('transactions.print', $transaction->id) }}" class="btn btn-icon btn-pill bg-primary-lt" data-bs-toggle="tooltip" data-bs-original-title="Cetak struk pembayaran" target="_blank" data-bs-placement="bottom">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                                                            </svg>
                                                        </a>
                                                    @else
                                                        <button class="btn btn-icon btn-pill bg-green-lt" data-bs-toggle="modal" data-bs-target="#modalPayment" data-action="{{ route('transactions.update', $transaction->id) }}" data-totalprice="{{ $transaction->total_price }}" title="Bayar">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-cashapp" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M17.1 8.648a.568 .568 0 0 1 -.761 .011a5.682 5.682 0 0 0 -3.659 -1.34c-1.102 0 -2.205 .363 -2.205 1.374c0 1.023 1.182 1.364 2.546 1.875c2.386 .796 4.363 1.796 4.363 4.137c0 2.545 -1.977 4.295 -5.204 4.488l-.295 1.364a.557 .557 0 0 1 -.546 .443h-2.034l-.102 -.011a.568 .568 0 0 1 -.432 -.67l.318 -1.444a7.432 7.432 0 0 1 -3.273 -1.784v-.011a.545 .545 0 0 1 0 -.773l1.137 -1.102c.214 -.2 .547 -.2 .761 0a5.495 5.495 0 0 0 3.852 1.5c1.478 0 2.466 -.625 2.466 -1.614c0 -.989 -1 -1.25 -2.886 -1.954c-2 -.716 -3.898 -1.728 -3.898 -4.091c0 -2.75 2.284 -4.091 4.989 -4.216l.284 -1.398a.545 .545 0 0 1 .545 -.432h2.023l.114 .012a.544 .544 0 0 1 .42 .647l-.307 1.557a8.528 8.528 0 0 1 2.818 1.58l.023 .022c.216 .228 .216 .569 0 .773l-1.057 1.057z"></path>
                                                            </svg>
                                                        </button>
                                                    @endif
                                                    <button class="btn btn-icon btn-pill bg-muted-lt" data-bs-toggle="dropdown" aria-expanded="false" title="Lainnya">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots-vertical" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <circle cx="12" cy="12" r="1"></circle>
                                                            <circle cx="12" cy="19" r="1"></circle>
                                                            <circle cx="12" cy="5" r="1"></circle>
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="{{ route('transactions.show', $transaction->id) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler me-2 icon-tabler-file-description" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                                <path d="M9 17h6"></path>
                                                                <path d="M9 13h6"></path>
                                                            </svg>
                                                            Detail
                                                        </a>
                                                        <button class="dropdown-item btn-action-delete" data-action="{{ route('transactions.destroy', $transaction->id) }}" data-bs-toggle="modal" data-bs-target="#modalDelete" {{ $transaction->is_paid ? 'disabled' : '' }}>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler me-2" width="24"
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
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($transactions->count() == 0)
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <div class="empty">
                                                    <div class="empty-img"><img src="{{ asset('img\error\undraw_quitting_time_dm8t.svg') }}"
                                                            height="128">
                                                    </div>
                                                    <p class="empty-title">Transaksi tidak ditemukan</p>
                                                    <p class="empty-subtitle text-muted">
                                                        Coba sesuaikan pencarian atau filter anda untuk menemukan apa yang anda cari.
                                                    </p>
                                                    <div class="empty-action">
                                                        <a href="{{ route('transactions.index') }}" class="btn btn-outline-danger">
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
                        <a href="{{ route('transactions.index') }}" class="btn btn-outline-danger">Bersihkan opsi</a>
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

    {{-- Modal Payment --}}
    <div class="modal modal-blur fade" id="modalPayment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="formConfirmPayment">
                    @csrf
                    @method('put')
                    <input type="hidden" name="total_price" id="inputTotalPrice">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-label">Total yang harus dibayar</div>
                                <div class="form-control-plaintext" id="totalPricePreview"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-label">Jumlah yang dibayarkan</div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        Rp
                                    </span>
                                    <input type="number" name="total_payment" class="form-control" placeholder="Jumlah yang dibayarkan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" name="update_table_status" value="1" checked>
                                    <span class="form-check-label">Ubah status meja menjadi "Tersedia"</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="btnFormOption">Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Payment Success --}}
    <div class="modal modal-blur fade" id="modalPaymentSuccess" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-success"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><path d="M9 12l2 2l4 -4" /></svg>
                    <h3>Pesanan berhasil dibayar</h3>
                    <div class="text-muted" id="paymentSuccessMessage"></div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <button class="btn w-100" data-bs-dismiss="modal">
                                    Tutup
                                </button>
                            </div>
                            <div class="col">
                                <a class="btn btn-success w-100" id="btnPrintInvoiceModal" target="_blank">
                                    Cetak Struk
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('library-js')
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

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr('error', 'Error', '{{ $error }}')
            @endforeach
        @endif

        @if (session('paymentSuccess'))
            $(document).ready(function() {
                const paymentSuccessData = @json(session('paymentSuccess'));
                $('#paymentSuccessMessage').text(paymentSuccessData.message);
                $('#btnPrintInvoiceModal').attr('href', paymentSuccessData.invoice_url);
                $('#modalPaymentSuccess').modal('show');

                $('#btnPrintInvoiceModal').click(function() {
                    $('#modalPaymentSuccess').modal('hide');
                });
            });
        @endif

        const modalDelete = document.getElementById('modalDelete');
        modalDelete.addEventListener('show.bs.modal', function(event) {
            formDelete.action = event.relatedTarget.dataset.action;
        });

        $('#modalPayment').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const action = button.data('action');
            const totalPrice = button.data('totalprice');

            $('#formConfirmPayment').attr('action', action);
            $('#inputTotalPrice').val(totalPrice);
            $('#totalPricePreview').text(numberToRupiah(totalPrice));
        });

        function numberToRupiah(number) {
            return number.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
            }).replace(/,00/g, '')
        }

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
