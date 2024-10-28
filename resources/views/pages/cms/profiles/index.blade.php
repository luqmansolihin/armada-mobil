@extends('layouts.cms.app')

@push('additional-style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Profile</h3>
                </div>

                <form class="form-horizontal" action="{{ route('cms.profiles.update') }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session()->get('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                            <div class="input-group col-sm-6">
                                <div class="custom-file">
                                    <input type="file" name="cover" id="cover"
                                           class="custom-file-input @error('cover') is-invalid @enderror"
                                           onchange="previewImage()">
                                    <label class="custom-file-label" for="cover">Choose Image</label>
                                </div>
                                @error('cover')
                                    <span class="error invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-2"></div>
                            <img class="col-sm-6 img-preview" src="{{ $profile->cover }}">
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-6">
                                <textarea name="address"
                                          class="form-control @error('address') is-invalid @enderror" id="address"
                                          placeholder="Address" rows="2" required>{{ old('address', $profile->address) }}
                                </textarea>
                                @error('address')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="short_description" class="col-sm-2 col-form-label">Short Description</label>
                            <div class="col-sm-6">
                                <textarea name="short_description"
                                       class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                                       placeholder="Short description" rows="4" required>{{ old('short_description', $profile->short_description) }}
                                </textarea>
                                @error('short_description')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description"
                                          class="form-control @error('description') is-invalid @enderror" id="description"
                                          placeholder="Description" rows="4" required>{{ old('description', $profile->description) }}
                                </textarea>
                                @error('description')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('additional-script')
    <script>
        // preview image
        function previewImage() {
            const image = document.querySelector('#cover');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'd-flex';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endpush
