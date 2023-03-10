@extends('main')

@section('custom-css')
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center justify-content-center">
                <div class="col-md-6">
                    <div class="page-pretitle">
                        Halaman
                    </div>
                    <h2 class="page-title">
                        Ubah Meja
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards justify-content-center">
                <div class="col-md-6">
                    <form action="{{ route('tables.update', $table->id) }}" class="card" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="previous_url" value="{{ url()->previous() == url()->current() ? route('tables.index') : url()->previous() }}">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label required">Nomor Meja</label>
                                    <input type="number" class="form-control @error('number') is-invalid @enderror"
                                        name="number" placeholder="Nomor meja" value="{{ old('number') ?? $table->number }}" />
                                    @error('number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label required">Kapasitas</label>
                                    <input type="number" class="form-control @error('capacity') is-invalid @enderror"
                                        name="capacity" placeholder="Kapasitas meja" value="{{ old('capacity') ?? $table->capacity }}" />
                                    @error('capacity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" rows="4" placeholder="Deskripsi meja ...">{{ old('desc') ?? $table->desc }}</textarea>
                                    @error('desc')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex">
                            <a href="{{ url()->previous() == url()->current() ? route('tables.index') : url()->previous() }}" class="btn me-auto">Batal</a>
                            <button type="submit" class="btn btn-primary">Ubah Meja</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('library-js')
@endsection

@section('custom-js')
@endsection
