@extends('layouts.cms.app')

@push('additional-style')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css"
        integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Outlets | Update</h3>
                </div>

                <form class="form-horizontal" action="{{ route('cms.outlets.update', $outlet->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $outlet->name) }}" required />
                                @error('name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-6">
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address"
                                    placeholder="Address" rows="2" required>{{ old('address', $outlet->address) }}</textarea>
                                @error('address')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-6">
                                <input type="text" id="phone" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone', $outlet->phone) }}" required />
                                @error('phone')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fax" class="col-sm-2 col-form-label">Fax</label>
                            <div class="col-sm-6">
                                <input type="text" id="fax" name="fax"
                                    class="form-control @error('fax') is-invalid @enderror"
                                    value="{{ old('fax', $outlet->fax) }}" />
                                @error('fax')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-6">
                                <input type="text" id="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $outlet->email) }}" required />
                                @error('email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url_address" class="col-sm-2 col-form-label">URL Address</label>
                            <div class="col-sm-6">
                                <input type="text" id="url_address" name="url_address"
                                    class="form-control @error('url_address') is-invalid @enderror"
                                    value="{{ old('url_address', $outlet->url_address) }}" required />
                                @error('url_address')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url_embed_address" class="col-sm-2 col-form-label">URL Embed Address</label>
                            <div class="col-sm-6">
                                <textarea name="url_embed_address" class="form-control @error('url_embed_address') is-invalid @enderror"
                                    id="url_embed_address" placeholder="URL Embed Address" rows="2" required>{{ old('url_embed_address', $outlet->url_embed_address) }}</textarea>
                                @error('url_embed_address')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <fieldset class="form-group row">
                            <legend class="col-form-label col-sm-2 float-sm-left pt-0 font-weight-bold">Service</legend>
                            <div class="col-sm-10">
                                @foreach ($services as $service)
                                    <div class="form-check">
                                        <input class="form-check-input @error('service_id') is-invalid @enderror"
                                            name="service_id[]" type="checkbox" id="{{ 'checkBox' . $loop->index }}"
                                            value="{{ $service->id }}" @checked(in_array($service->id, old('service_id', $outlet->outletHasServices->pluck('service_id')->all())))>
                                        <label class="form-check-label" for="{{ 'checkBox' . $loop->index }}">
                                            {{ $service->title }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('service_id')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </fieldset>

                        <div class="form_field_outer">
                            @foreach (old('outlets', $outlet->outletHasOperationalHours) as $index => $outletHasOperationalHour)
                                <div class="form_field_outer_row">
                                    <div class="form-group row">
                                        <label for="day_from_{{ $loop->index }}" class="col-sm-2 col-form-label">Day
                                            from</label>
                                        <div class="col-sm-4">
                                            <select name="outlets[{{ $loop->index }}][day_from]"
                                                class="form-control custom_select @error('outlets.' . $loop->index . '.day_from') is-invalid @enderror"
                                                id="day_from_{{ $loop->index }}" placeholder="Choose Day" required>
                                                @foreach (App\Enums\DayEnum::cases() as $day)
                                                    <option value="{{ $day->value }}" @selected($day->value == (old('outlets') ? $outletHasOperationalHour['day_from'] : $outletHasOperationalHour->day_from))>
                                                        {{ strtoupper($day->value) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('outlets.' . $loop->index . '.day_from')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="day_to_{{ $loop->index }}" class="col-sm-2 col-form-label">Day
                                            to</label>
                                        <div class="col-sm-4">
                                            <select name="outlets[{{ $loop->index }}][day_to]"
                                                class="form-control custom_select @error('outlets.' . $loop->index . '.day_to') is-invalid @enderror"
                                                id="day_to_{{ $loop->index }}" placeholder="Choose Day" required>
                                                @foreach (App\Enums\DayEnum::cases() as $day)
                                                    <option value="{{ $day->value }}" @selected($day->value == (old('outlets') ? $outletHasOperationalHour['day_to'] : $outletHasOperationalHour->day_to))>
                                                        {{ strtoupper($day->value) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('outlets.' . $loop->index . '.day_to')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="open_time_{{ $loop->index }}" class="col-sm-2 col-form-label">Open
                                            Time</label>
                                        <div class="col-sm-4">
                                            <input type="text" id="open_time_{{ $loop->index }}"
                                                name="outlets[{{ $loop->index }}][open_time]"
                                                class="form-control datetimepicker-input @error('outlets.' . $loop->index . '.open_time') is-invalid @enderror"
                                                value="{{ old('outlets') ? $outletHasOperationalHour['open_time'] : $outletHasOperationalHour->open_time }}"
                                                data-target="#open_time_{{ $loop->index }}" data-toggle="datetimepicker"
                                                autocomplete="off" />
                                            @error('outlets.' . $loop->index . '.open_time')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="close_time_{{ $loop->index }}" class="col-sm-2 col-form-label">Close
                                            Time</label>
                                        <div class="col-sm-4">
                                            <input type="text" id="close_time_{{ $loop->index }}"
                                                name="outlets[{{ $loop->index }}][close_time]"
                                                class="form-control datetimepicker-input @error('outlets.' . $loop->index . '.close_time') is-invalid @enderror"
                                                value="{{ old('outlets') ? $outletHasOperationalHour['close_time'] : $outletHasOperationalHour->close_time }}"
                                                data-target="#close_time_{{ $loop->index }}"
                                                data-toggle="datetimepicker" autocomplete="off" />
                                            @error('outlets.' . $loop->index . '.close_time')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-2 mt-3">
                                            <button type="button"
                                                class="btn btn-danger btn-remove remove_node_btn_form_field"
                                                @if ($loop->index == 0) disabled @endif>Remove</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-success add_new_form_field_btn">Add Operational
                                    Hour</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('cms.outlets.index') }}" class="btn btn-warning">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('additional-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <script>
        $(document).ready(function() {
            let body = $('body')
            let form_field_outer = $('.form_field_outer')

            @foreach ($outlet->outletHasOperationalHours as $outletHasOperationalHour)
                $('#open_time_{{ $loop->index }}').datetimepicker({
                    format: 'HH:mm',
                    stepping: 15
                })

                $('#close_time_{{ $loop->index }}').datetimepicker({
                    format: 'HH:mm',
                    stepping: 15
                })
            @endforeach

            body.on('click', '.add_new_form_field_btn', function() {
                let index = form_field_outer.find('.form_field_outer_row').length

                form_field_outer.append(`
                    <div class="form_field_outer_row">
                        <div class="form-group row">
                            <label for="day_from_${index}" class="col-sm-2 col-form-label">Day from</label>
                            <div class="col-sm-4">
                                <select name="outlets[${index}][day_from]"
                                    class="form-control custom_select"
                                    id="day_from_${index}" placeholder="Choose Day" required>
                                    @foreach (App\Enums\DayEnum::cases() as $day)
                                        <option value="{{ $day->value }}">
                                            {{ strtoupper($day->value) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="day_to_${index}" class="col-sm-2 col-form-label">Day to</label>
                            <div class="col-sm-4">
                                <select name="outlets[${index}][day_to]"
                                    class="form-control custom_select"
                                    id="day_to_${index}" placeholder="Choose Day" required>
                                    @foreach (App\Enums\DayEnum::cases() as $day)
                                        <option value="{{ $day->value }}">
                                            {{ strtoupper($day->value) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="open_time_${index}" class="col-sm-2 col-form-label">Open Time</label>
                            <div class="col-sm-4">
                                <input type="text" id="open_time_${index}" name="outlets[${index}][open_time]"
                                    class="form-control datetimepicker-input" data-target="#open_time_${index}"
                                    data-toggle="datetimepicker" autocomplete="off" />
                            </div>

                            <label for="close_time_${index}" class="col-sm-2 col-form-label">Close Time</label>
                            <div class="col-sm-4">
                                <input type="text" id="close_time_${index}" name="outlets[${index}][close_time]"
                                    class="form-control datetimepicker-input" data-target="#close_time_${index}"
                                    data-toggle="datetimepicker" autocomplete="off" />
                            </div>

                            <div class="col-sm-2 mt-3">
                                <button type="button"
                                    class="btn btn-danger btn-remove remove_node_btn_form_field" disabled>Remove</button>
                            </div>
                        </div>
                    </div>
                `)

                form_field_outer.find('.remove_node_btn_form_field:not(:first)').prop('disabled', false)
                form_field_outer.find('.remove_node_btn_form_field').first().prop('disabled', true)

                $(`#open_time_${index}`).datetimepicker({
                    format: 'HH:mm',
                    stepping: 15
                });

                $(`#close_time_${index}`).datetimepicker({
                    format: 'HH:mm',
                    stepping: 15
                });
            })

            body.on('click', '.remove_node_btn_form_field', function() {
                $(this).closest('.form_field_outer_row').remove()

                updateIndexes()
            })

            function updateIndexes() {
                $('.form_field_outer .form_field_outer_row').each(function(index) {
                    // Update ID dan NAME untuk day_from
                    $(this).find('select[name^="outlets["][name*="[day_from]"]').attr({
                        id: `day_from_${index}`,
                        name: `outlets[${index}][day_from]`
                    });

                    // Update ID dan NAME untuk day_to
                    $(this).find('select[name^="outlets["][name*="[day_to]"]').attr({
                        id: `day_to_${index}`,
                        name: `outlets[${index}][day_to]`
                    });

                    // Update ID dan NAME untuk open_time
                    $(this).find('input[name^="outlets["][name*="[open_time]"]').attr({
                        id: `open_time_${index}`,
                        name: `outlets[${index}][open_time]`,
                        'data-target': `#open_time_${index}`
                    });

                    // Update ID dan NAME untuk close_time
                    $(this).find('input[name^="outlets["][name*="[close_time]"]').attr({
                        id: `close_time_${index}`,
                        name: `outlets[${index}][close_time]`,
                        'data-target': `#close_time_${index}`
                    });

                    // Update label (optional, if you have labels targeting inputs by ID)
                    $(this).find('label[for^="day_from"]').attr('for', `day_from_${index}`)
                    $(this).find('label[for^="day_to"]').attr('for', `day_to_${index}`)
                    $(this).find('label[for^="open_time"]').attr('for', `open_time_${index}`)
                    $(this).find('label[for^="close_time"]').attr('for', `close_time_${index}`)

                    $(`#open_time_${index}`).datetimepicker({
                        format: 'HH:mm',
                        stepping: 15
                    });

                    $(`#close_time_${index}`).datetimepicker({
                        format: 'HH:mm',
                        stepping: 15
                    });
                });
            }
        })
    </script>
@endpush
