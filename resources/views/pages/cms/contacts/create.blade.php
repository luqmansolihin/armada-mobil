@extends('layouts.cms.app')

@section('content')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contacts | Create</h3>
                </div>

                <form class="form-horizontal" action="{{ route('cms.contacts.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="type" class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-4">
                                <select name="type"
                                    class="form-control custom_select @error('type') is-invalid @enderror"
                                    id="type" placeholder="Choose Contact Type" required>
                                    @foreach (App\Enums\ContactTypeEnum::cases() as $type)
                                        <option value="{{ $type->value }}" @selected($type->value == old('type'))>
                                            {{ strtoupper($type->value) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contact" class="col-sm-2 col-form-label">Contact/URL Social Media</label>
                            <div class="col-sm-4">
                                <input type="text" id="contact" name="contact"
                                    class="form-control @error('contact') is-invalid @enderror"
                                    value="{{ old('contact') }}" required />
                                @error('contact')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('cms.contacts.index') }}" class="btn btn-warning">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
