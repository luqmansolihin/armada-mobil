@extends('layouts.skeleton')

@push('style')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        @font-face {
            font-family: 'Isuzu Head';
            src: url({{ asset('font/head/isuzu-head.otf') }}) format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Isuzu Body';
            src: url({{ asset('font/body/isuzu-body.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans Condensed Bold';
            src: url({{ asset('font/open-sans/OpenSans_Condensed-Bold.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans Condensed Bold Italic';
            src: url({{ asset('font/open-sans/OpenSans_Condensed-BoldItalic.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans Condensed Extra Bold';
            src: url({{ asset('font/open-sans/OpenSans_Condensed-ExtraBold.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans Condensed Extra Bold Italic';
            src: url({{ asset('font/open-sans/OpenSans_Condensed-ExtraBoldItalic.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans Condensed Italic';
            src: url({{ asset('font/open-sans/OpenSans_Condensed-Italic.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans Condensed Light';
            src: url({{ asset('font/open-sans/OpenSans_Condensed-Light.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans Condensed Light Italic';
            src: url({{ asset('font/open-sans/OpenSans_Condensed-LightItalic.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans Condensed Medium';
            src: url({{ asset('font/open-sans/OpenSans_Condensed-Medium.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans Condensed Medium Italic';
            src: url({{ asset('font/open-sans/OpenSans_Condensed-MediumItalic.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans Condensed Regular';
            src: url({{ asset('font/open-sans/OpenSans_Condensed-Regular.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans Condensed Semi Bold';
            src: url({{ asset('font/open-sans/OpenSans_Condensed-SemiBold.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans Condensed Semi Bold Italic';
            src: url({{ asset('font/open-sans/OpenSans_Condensed-SemiBoldItalic.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
        }
    </style>

    @stack('additional-style')

    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
@endpush

@section('app')
    <div class="wrapper">
        @include('partials.cms.navbar')

        @include('partials.cms.sidebar')

        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        @include('partials.cms.footer')
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @stack('additional-script')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/adminlte.min.js') }}"></script>
@endpush
