@extends('layouts.cms.app')

@section('content')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Testimonials | Edit</h3>
                </div>

                <form class="form-horizontal" action="{{ route('cms.testimonials.update', $testimonial->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="Name" value="{{ old('name', $testimonial->name) }}" required>
                                @error('name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profession" class="col-sm-2 col-form-label">Profession</label>
                            <div class="col-sm-6">
                                <input type="text" name="profession"
                                    class="form-control @error('profession') is-invalid @enderror" id="profession"
                                    placeholder="Profession" value="{{ old('profession', $testimonial->profession) }}"
                                    required>
                                @error('profession')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Image</label>
                            <div class="input-group col-sm-6">
                                <div class="custom-file">
                                    <input type="file" name="image" id="image"
                                        class="custom-file-input @error('image') is-invalid @enderror"
                                        onchange="previewImage()">
                                    <label class="custom-file-label" for="image">Choose Image</label>
                                </div>
                                @error('image')
                                    <span class="error invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-2"></div>
                            <img class="col-sm-6 img-preview" src="{{ $testimonial->image }}">
                        </div>
                        <div class="form-group row">
                            <label for="testimonial" class="col-sm-2 col-form-label">Testimonial</label>
                            <div class="col-sm-6">
                                <textarea name="testimonial" class="form-control @error('testimonial') is-invalid @enderror" id="testimonial"
                                    placeholder="Testimonial" rows="4" required>{{ old('testimonial', $testimonial->testimonial) }}</textarea>
                                @error('testimonial')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-6">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input @error('status') is-invalid @enderror" type="radio"
                                        id="active" name="status" value="1" @checked(old('status', $testimonial->status) == '1')>
                                    <label for="active" class="custom-control-label">Active</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input @error('status') is-invalid @enderror" type="radio"
                                        id="inactive" name="status" value="0" @checked(old('status', $testimonial->status) == '0')>
                                    <label for="inactive" class="custom-control-label">Inactive</label>
                                </div>
                                @error('status')
                                    <span class="error invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('cms.testimonials.index') }}" class="btn btn-warning">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
