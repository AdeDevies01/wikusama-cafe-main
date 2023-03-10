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
                        Ubah Menu
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards justify-content-center">
                <div class="col-md-6">
                    <form action="{{ route('menus.update', $menu->id) }}" class="card" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="previous_url" value="{{ url()->previous() == url()->current() ? route('menus.index') : url()->previous() }}">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label required">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" placeholder="Nama pengguna" value="{{ old('name') ?? $menu->name }}" />
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
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Harga menu" value="{{ old('price') ?? $menu->price }}" />
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
                                    <textarea class="form-control @error('name') is-invalid @enderror" name="desc" rows="4" placeholder="Deskripsi menu ...">{{ old('desc') ?? $menu->desc }}</textarea>
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
                                                <input type="radio" name="category_id" value="{{ $category->id }}" class="form-selectgroup-input" {{ (old('category_id') ?? $menu->category_id) == $category->id ? 'checked' : '' }}>
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
                                            <img src="{{ asset('img/menus/' . ($menu->img ?? 'placeholder.png')) }}" alt="Preview" id="imgPreview" class="img-fluid img-thumbnail rounded shadow-sm">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label id="imgLabel" for="inputImg" class="btn btn-outline-primary me-2">Unggah Foto</label>
                                            <button class="btn btn-outline-danger {{ $menu->img ? '' : 'd-none' }}" id="btnDeleteImg">Hapus Foto</button>
                                            <input type="hidden" name="delete_img" id="deleteImg" value="0">
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
                        <div class="card-footer d-flex">
                            <a href="{{ url()->previous() == url()->current() ? route('menus.index') : url()->previous() }}" class="btn me-auto">Batal</a>
                            <button type="submit" class="btn btn-primary">Ubah Menu</button>
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
    <script>
        $('#btnDeleteImg').click(function(e) {
            e.preventDefault();
            $('#imgPreview').attr('src', '{{ asset('img/menus/placeholder.png') }}');
            $('#deleteImg').val(1);
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
                $('#deleteImg').val(0);
                $('#imgLabel').text('Ubah Foto');
                $('#btnDeleteImg').removeClass('d-none');
            }
        });
    </script>
@endsection
