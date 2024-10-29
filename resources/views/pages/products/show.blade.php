@extends('layouts.app')

@section('content')
    <!-- Cover Start-->
    <div class="cover container-fluid d-flex align-items-center justify-content-center mb-5">
        <img src="{{ $product->image }}" alt="Cover Image" />
        <div class="overlay"></div>
        <div>
            <h1 class="text-white">{{ strtoupper($product->title) }}</h1>
        </div>
    </div>
    <!-- Cover End-->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            {!! $product->content !!}
        </div>
    </div>
    <!-- About End -->
@endsection
