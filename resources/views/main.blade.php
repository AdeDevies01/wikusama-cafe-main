<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Wikusama Cafe | {{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('icon.webp') }}" type="image/x-icon">
    <!-- CSS files -->
    <link href="{{ asset('plugins/tabler/dist/css/tabler.min.css?1669759017') }}" rel="stylesheet"/>
    <link href="{{ asset('plugins/tabler/dist/css/tabler-flags.min.css?1669759017') }}" rel="stylesheet"/>
    <link href="{{ asset('plugins/tabler/dist/css/tabler-payments.min.css?1669759017') }}" rel="stylesheet"/>
    <link href="{{ asset('plugins/tabler/dist/css/tabler-vendors.min.css?1669759017') }}" rel="stylesheet"/>
    <link href="{{ asset('plugins/tabler/dist/css/demo.min.css?1669759017') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('plugins/toast/dist/simple-notify.min.css') }}" />
    <script src="{{ asset('plugins/toast/dist/simple-notify.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
    @yield('custom-css')
  </head>
  <body >
    <script src="{{ asset('plugins/tabler/dist/js/demo-theme.min.js?1669759017') }}"></script>

    <div class="page">
      <div class="sticky-top">
        {{-- Header --}}
        @include('partials.header')

        {{-- Navbar --}}
        @if(auth()->user()->role == 'administrator')
            @include('partials.navbar-admin')
        @elseif(auth()->user()->role == 'cashier')
            @include('partials.navbar-cashier')
        @elseif(auth()->user()->role == 'manager')
            @include('partials.navbar-manager')
        @endif
      </div>

      <div class="page-wrapper">
        {{-- Content --}}
        @yield('content')

        {{-- Footer --}}
        @include('partials.footer')
      </div>
    </div>

    <script src="{{ asset('plugins/tabler/dist/js/tabler.min.js?1669759017') }}" defer></script>
    <script src="{{ asset('plugins/tabler/dist/js/demo.min.js?1669759017') }}" defer></script>

    <script>
        @if(session('success'))
            toastr('success', 'Berhasil', '{{ session('success') }}')
        @endif
        @if(session('error'))
            toastr('error', 'Gagal', '{{ session('error') }}')
        @endif

        const changeDateTime = () => {
            const dateTimeContainer = document.getElementById('datetime');
            const now = new Date();
            const date = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' });
            const time = now.toLocaleTimeString('it-IT', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            dateTimeContainer.innerHTML = `${date} - ${time}`;
        }
        document.addEventListener('DOMContentLoaded', changeDateTime);
        setInterval(changeDateTime, 1000);

        function toastr(status = 'success', title = 'Toast Title', text = 'Toast Text') {
            new Notify({
                status: status,
                title: title,
                text: text,
                effect: 'fade',
                speed: 300,
                showIcon: true,
                showCloseButton: true,
                autoclose: true,
                autotimeout: 3000,
                gap: 20,
                distance: 20,
                type: 3,
                position: 'right top',
            })
        }
    </script>

    @yield('library-js')
    @yield('custom-js')
  </body>
</html>
