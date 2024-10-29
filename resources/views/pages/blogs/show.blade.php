@extends('layouts.app')

@section('content')
    <!-- Cover Start-->
    <div class="cover container-fluid d-flex align-items-center justify-content-center mb-5">
        <img src="{{ $blog->image }}" alt="Cover Image" />
        <div class="overlay"></div>
        <div>
            <h1 class="text-white">{{ $blog->title }}</h1>
            <p>{{ $blog->created_at->tz('Asia/Jakarta')->format('F d, Y') }}</p>
        </div>
    </div>
    <!-- Cover End-->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            {!! $blog->content !!}
            <br>

            <span class="text-gray">
                <i class="fa fa-user"></i>
                <em>{{ 'Posted by ' . $blog->user->name }}</em>
            </span>
        </div>
    </div>
    <!-- About End -->
@endsection
