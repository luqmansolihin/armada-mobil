@extends('layouts.app')

@section('content')
    <!-- Cover Start-->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url('{{ $afterSale->image }}');">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center py-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">{{ $afterSale->title }}</h1>
                <p class="text-white">{{ $afterSale->created_at->tz('Asia/Jakarta')->format('F d, Y') }}</p>
            </div>
        </div>
    </div>
    <!-- Cover End-->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            {!! $afterSale->content !!}
            <br>

            <span class="text-gray">
                <i class="fa fa-user"></i>
                <em>{{ 'Posted by ' . $afterSale->user->name }}</em>
            </span>
        </div>
    </div>
    <!-- About End -->
@endsection
