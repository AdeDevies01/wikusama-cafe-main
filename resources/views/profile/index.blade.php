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
                        Profile Saya
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards justify-content-center">
                <div class="col-md-6">
                    <form action="{{ route('profile.update') }}" class="card" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label required">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" placeholder="Nama pengguna" value="{{ old('name') ?? auth()->user()->name }}" />
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
                                        name="username" placeholder="Username pengguna" value="{{ old('username') ?? auth()->user()->username }}" />
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Kata Sandi Baru</label>
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
                                    <label class="form-label">Konfirmasi Kata Sandi Baru</label>
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
                                    <div class="form-label">Avatar</div>
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar avatar-md" id="avatarPreview"
                                                style="background-image: url({{ asset('img/users/' . (auth()->user()->photo ?? 'default.jpg')) }})"></span>
                                        </div>
                                        <div class="col-auto">
                                            <label id="avatarLabel" for="avatar" class="btn btn-outline-primary me-2">{{ auth()->user()->photo ? 'Ubah' : 'Unggah' }} Avatar</label>
                                            <button class="btn btn-outline-danger {{ auth()->user()->photo ? '' : 'd-none' }}" id="btnDeleteAvatar">Hapus Avatar</button>
                                            <input type="hidden" name="delete_photo" id="deletePhoto" value="0">
                                            <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="avatar" hidden>
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
                        <div class="card-footer d-flex">
                            <button type="submit" class="btn btn-primary">Ubah Profile</button>
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
        $('#btnDeleteAvatar').click(function(e) {
            e.preventDefault();
            $('#avatarPreview').css('background-image', 'url({{ asset('img/users/default.jpg') }})');
            $('#deletePhoto').val(1);
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
                $('#deletePhoto').val(0);
                $('#avatarLabel').text('Ubah Avatar');
                $('#btnDeleteAvatar').removeClass('d-none');
            }
        });
    </script>
@endsection
