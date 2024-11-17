@extends('layouts.cms.app')

@section('content')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Services | Create</h3>
                </div>

                <form class="form-horizontal" action="{{ route('cms.services.store') }}" method="POST"
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
                            <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                            <div class="col-sm-6 d-flex align-items-center">
                                <input type="text" name="icon"
                                    class="form-control @error('icon') is-invalid @enderror" id="icon"
                                    placeholder="Icon" value="{{ old('icon') }}" oninput="previewIcon(this.value)" required>
                                <div class="ml-3 d-none" id="icon-preview">
                                    <i class="{{ old('icon') }}"></i>
                                </div>
                                @error('icon')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-6">
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                    placeholder="Description" rows="4" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('cms.services.index') }}" class="btn btn-warning">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('additional-script')
    <script>
        function previewIcon(iconClass) {
            const iconPreview = document.getElementById('icon-preview');
            if (iconClass.trim() === '') {
                iconPreview.classList.add('d-none');
            } else {
                iconPreview.classList.remove('d-none');
                iconPreview.innerHTML = `<i class="${iconClass}"></i>`;
            }
        }
    </script>
@endpush
