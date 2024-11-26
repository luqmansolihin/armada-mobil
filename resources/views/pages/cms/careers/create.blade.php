@extends('layouts.cms.app')

@push('additional-style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css"
        integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Careers | Create</h3>
                </div>
                <form class="form-horizontal" action="{{ route('cms.careers.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required />
                                @error('name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Job Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                    placeholder="Job Description" rows="4" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="requirement" class="col-sm-2 col-form-label">Requirement</label>
                            <div class="col-sm-10">
                                <textarea name="requirement" class="form-control @error('requirement') is-invalid @enderror" id="requirement"
                                    placeholder="Requirement" rows="4" required>{{ old('requirement') }}</textarea>
                                @error('requirement')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="registration_from" class="col-sm-2 col-form-label">Registration From</label>
                            <div class="col-sm-4">
                                <input type="text" id="registration_from" name="registration_from"
                                    class="form-control datetimepicker-input @error('registration_from') is-invalid @enderror"
                                    value="{{ old('registration_from') }}" data-target="#registration_from"
                                    data-toggle="datetimepicker" autocomplete="off" required />
                                @error('registration_from')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <label for="registration_to" class="col-sm-2 col-form-label">Registration To</label>
                            <div class="col-sm-4">
                                <input type="text" id="registration_to" name="registration_to"
                                    class="form-control datetimepicker-input @error('registration_to') is-invalid @enderror"
                                    value="{{ old('registration_to') }}" data-target="#registration_to"
                                    data-toggle="datetimepicker" autocomplete="off" required />
                                @error('registration_to')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="minimal_age" class="col-sm-2 col-form-label">Minimal Age</label>
                            <div class="col-sm-4">
                                <input type="number" id="minimal_age" name="minimal_age"
                                    class="form-control @error('minimal_age') is-invalid @enderror"
                                    value="{{ old('minimal_age') }}" required />
                                @error('minimal_age')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <label for="maximal_age" class="col-sm-2 col-form-label">Maximal Age</label>
                            <div class="col-sm-4">
                                <input type="number" id="maximal_age" name="maximal_age"
                                    class="form-control @error('maximal_age') is-invalid @enderror"
                                    value="{{ old('maximal_age') }}" required />
                                @error('maximal_age')
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
                                    <input class="custom-control-input @error('status') is-invalid @enderror"
                                        type="radio" id="inactive" name="status" value="0"
                                        @checked(old('status') == '0')>
                                    <label for="inactive" class="custom-control-label">Inactive</label>
                                </div>
                                @error('status')
                                    <span class="error invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form_field_outer">
                            <div class="form_field_outer_row">
                                <div class="form-group row">
                                    <label for="placement_0" class="col-sm-2 col-form-label">Placement</label>
                                    <div class="col-sm-6 mb-1">
                                        <select
                                            class="form-control select2 @error('careers.0.placement') is-invalid @enderror"
                                            id="placement_0" name="careers[0][placement]" required>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    @if ((old('careers') ? old('careers')[0]['placement'] : '') == $city->id) selected @endif>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('careers.0.placement')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <button type="button"
                                            class="btn btn-danger btn-remove remove_node_btn_form_field"
                                            disabled>Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-success add_new_form_field_btn">Add
                                    Placement</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('cms.careers.index') }}" class="btn btn-warning">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('additional-script')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function() {
            let body = $('body')
            let form_field_outer = $('.form_field_outer')

            $('#registration_from').datetimepicker({
                format: 'YYYY-MM-DD'
            })

            $('#registration_to').datetimepicker({
                format: 'YYYY-MM-DD'
            })

            $('#description').summernote({
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

            $('#requirement').summernote({
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

            body.on('click', '.add_new_form_field_btn', function() {
                let index = form_field_outer.find('.form_field_outer_row').length

                form_field_outer.append(`
                    <div class="form_field_outer_row">
                        <div class="form-group row">
                            <label for="placement_${index}" class="col-sm-2 col-form-label">Placement</label>
                                <div class="col-sm-6 mb-1">
                                    <select
                                        class="form-control select2"
                                        id="placement_${index}" name="careers[${index}][placement]" required>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col">
                                    <button type="button"
                                        class="btn btn-danger btn-remove remove_node_btn_form_field"
                                        disabled>Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `)

                form_field_outer.find('.remove_node_btn_form_field:not(:first)').prop('disabled', false)
                form_field_outer.find('.remove_node_btn_form_field').first().prop('disabled', true)

                $('.select2').select2()
            })

            body.on('click', '.remove_node_btn_form_field', function() {
                $(this).closest('.form_field_outer_row').remove()

                updateIndexes()
            })

            function updateIndexes() {
                $('.form_field_outer .form_field_outer_row').each(function(index) {
                    // Update ID dan NAME untuk setiap placement
                    $(this).find('select[name^="careers["]').attr({
                        id: `placement_${index}`,
                        name: `careers[${index}][placement]`
                    })

                    $(this).find('label[for^="placement"]').attr('for', `placement_${index}`)
                });
            }

            // Initialize with existing fields if any
            @foreach (old('transaction_patient', []) as $index => $transaction)
                @if ($loop->iteration != 1)
                    form_field_outer.append(`
                        <div class="form_field_outer_row">
                            <div class="form-group row">
                                <label for="placement_{{ $loop->index }}" class="col-sm-2 col-form-label">Placement</label>
                                    <div class="col-sm-6 mb-1">
                                        <select
                                            class="form-control select2 @error('careers.' . $index . '.placement') is-invalid @enderror"
                                            id="placement_{{ $loop->index }}" name="careers[{{ $loop->index }}][placement]" required>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" @selected(old('careers')[$index]['placement'] == $city->id)>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('careers.' . $index . '.placement')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <button type="button"
                                            class="btn btn-danger btn-remove remove_node_btn_form_field"
                                            disabled>Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `)

                    form_field_outer.find('.remove_node_btn_form_field:not(:first)').prop('disabled', false)
                    form_field_outer.find('.remove_node_btn_form_field').first().prop('disabled', true)
                @endif
            @endforeach

            $('.select2').select2()
        })
    </script>
@endpush
