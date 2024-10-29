@extends('layouts.app')

@section('content')
    <!-- Cover Start-->
    <div class="cover container-fluid d-flex align-items-center justify-content-center mb-5">
        <img src="{{ $profile->cover }}" alt="Cover Image" />
        <div class="overlay"></div>
        <div>
            <h1 class="text-white">EVENTS & NEWS</h1>
        </div>
    </div>
    <!-- Cover End-->

    <!-- Latest News Start -->
    @if ($blogs)
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-4 justify-content-center">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item">
                                <div class="position-relative overflow-hidden img-container">
                                    <img class="img-fluid" src="{{ $blog->image }}" alt="">
                                    <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                                        <a class="btn mx-1" href="{{ route('blogs.show', $blog->slug) }}">READ MORE <i
                                                class="fa fa-arrow-right ms-3"></i></a>
                                    </div>
                                </div>
                                <div class="bg-light text-left p-4">
                                    <small>{{ $blog->created_at->tz('Asia/Jakarta')->format('F d, Y') }}</small>
                                    <h5 class="fw-bold mb-0">{{ $blog->title }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Latest News End -->
@endsection
