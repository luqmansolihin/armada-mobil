@extends('layouts.cms.app')

@push('additional-style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Service After Sale | Create</h3>
                </div>

                <form class="form-horizontal" action="{{ route('cms.after-sales.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-6">
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                    placeholder="Title" value="{{ old('title') }}" required>
                                @error('title')
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
                                        onchange="previewImage()" required>
                                    <label class="custom-file-label" for="image">Choose Image</label>
                                </div>
                                @error('image')
                                    <span class="error invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-2"></div>
                            <img class="col-sm-6 img-preview" src="">
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content"
                                    placeholder="Content" rows="4" required>{{ old('content') }}
                                </textarea>
                                @error('content')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-6">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input @error('status') is-invalid @enderror" type="radio"
                                        id="active" name="status" value="1" @checked(old('status', '1') == '1')>
                                    <label for="active" class="custom-control-label">Active</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input @error('status') is-invalid @enderror" type="radio"
                                        id="inactive" name="status" value="0" @checked(old('status') == '0')>
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
                        <a href="{{ route('cms.after-sales.index') }}" class="btn btn-warning">Cancel</a>
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
            const image = document.querySelector('#image');
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
            $('#content').summernote({
                fontNames: [
                    'Arial',
                    'Arial Black',
                    'Comic Sans MS',
                    'Courier New',
                    'Helvetica',
                    'Impact',
                    'Tahoma',
                    'Times New Roman',
                    'Verdana',
                    'Isuzu Head',
                    'Isuzu Body'
                ],
                fontNamesIgnoreCheck: [
                    'Isuzu Head',
                    'Isuzu Body'
                ],
            });
        });
    </script>
@endpush
