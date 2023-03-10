@extends('main')

@section('custom-css')
    <style>
        /* handphone */
        @media only screen and (max-width: 500px) {
            .menu-name {
                width: 100px;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-6">
                    <div class="row">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Halaman
                            </div>
                            <h2 class="page-title">
                                Detail Transaksi
                            </h2>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list d-flex">
                                <a href="{{ url()->previous() != url()->current() ? url()->previous() : (auth()->user()->role == 'cashier' ? route('transactions.index') : route('transactions-manager.index')) }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l14 0"></path>
                                        <path d="M5 12l6 6"></path>
                                        <path d="M5 12l6 -6"></path>
                                    </svg>
                                    Kembali
                                </a>
                                <a href="{{ url()->previous() != url()->current() ? url()->previous() : (auth()->user()->role == 'cashier' ? route('transactions.index') : route('transactions-manager.index')) }}" class="btn btn-outline-primary d-sm-none btn-icon" aria-label="Tambah pengguna">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l14 0"></path>
                                        <path d="M5 12l6 6"></path>
                                        <path d="M5 12l6 -6"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Page Body --}}
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Kasir</label>
                                        <div class="form-control-plaintext">{{ $transaction->cashier->name ?? '<kasir dihapus>' }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Customer</label>
                                        <div class="form-control-plaintext">{{ $transaction->customer_name ?? '-' }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <div class="mb-3">
                                        <label class="form-label">No. Meja</label>
                                        <div class="form-control-plaintext">{{ $transaction->table->number }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Total Tagihan</label>
                                        <div class="form-control-plaintext">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <div class="form-control-plaintext">
                                            @if ($transaction->is_paid)
                                                <span class="badge bg-green-lt">Sudah dibayar</span>
                                            @else
                                                <span class="badge bg-red-lt">Belum dibayar</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah dibayar</label>
                                        <div class="form-control-plaintext">
                                            @if ($transaction->is_paid)
                                                Rp {{ number_format($transaction->total_payment, 0, ',', '.') }}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Waktu dibuat</label>
                                        <div class="form-control-plaintext">
                                            {{ $transaction->created_at->format('d M Y H:i:s') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Waktu dibayar</label>
                                        <div class="form-control-plaintext">
                                            {{ $transaction->is_paid ? $transaction->updated_at->format('d M Y H:i:s') : '-' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Catatan</label>
                                        <div class="form-control-plaintext" style="max-height: 80px; overflow-y: auto;">
                                            {{ $transaction->note ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Daftar pesanan</label>
                                        <div style="overflow-y: auto; max-height: 250px">
                                            <ul class="list-group list-group-flush">
                                                @foreach ($transaction->orders as $order)
                                                    <li class="list-group-item">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <span class="avatar" style="background-image: url({{ asset('img/menus/' . ($order->menu->img ?? 'default.jpg')) }})"></span>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="fw-bold text-truncate menu-name">
                                                                    {{ mb_strimwidth($order->menu->name, 0, 20, '...') }}
                                                                </div>
                                                                <div class="col text-muted">
                                                                    Rp {{ number_format($order->menu->price, 0, ',', '.') }} x {{ $order->qty }}
                                                                </div>
                                                            </div>
                                                            <div class="col-auto ms-auto">
                                                                <span class="fw-bold">
                                                                    Rp {{ number_format($order->menu->price * $order->qty, 0, ',', '.') }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('library-js')
@endsection

@section('custom-js')
@endsection
