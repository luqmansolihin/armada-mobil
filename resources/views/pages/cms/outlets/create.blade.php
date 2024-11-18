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
                    <h3 class="card-title">Outlets | Create</h3>
                </div>

                <form class="form-horizontal" action="{{ route('cms.operational-hours.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" id="name" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" required />
                                @error('name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-6">
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address"
                                          placeholder="Address" rows="2" required>{{ old('address') }}</textarea>
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
                                       value="{{ old('phone') }}" required />
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
                                       value="{{ old('fax') }}"/>
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
                                       value="{{ old('email') }}" required />
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
                                       value="{{ old('url_address') }}" required />
                                @error('url_address')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url_embed_address" class="col-sm-2 col-form-label">URL Embed Address</label>
                            <div class="col-sm-6">
                                <textarea name="url_embed_address" class="form-control @error('url_embed_address') is-invalid @enderror" id="url_embed_address"
                                          placeholder="URL Embed Address" rows="2" required>{{ old('url_embed_address') }}</textarea>
                                @error('url_embed_address')
                                `<span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <fieldset class="form-group row">
                            <legend class="col-form-label col-sm-2 float-sm-left pt-0 font-weight-bold">Service</legend>
                            <div class="col-sm-10">
                                @foreach($services as $service)
                                    <div class="form-check">
                                        <input class="form-check-input @error('outlets.[$loop->index][service]') is-invalid @enderror"
                                               name="outlets[{{$loop->index}}][service]"
                                               type="checkbox" id="{{ 'checkBox'.$loop->index }}"
                                               value="{{ $service->id }}"
                                            @checked(old('outlets.[$loop->index].[service]') == $service->id)>
                                        <label class="form-check-label" for="{{ 'checkBox'.$loop->index }}">
                                            {{ $service->title }}
                                        </label>
                                        @error('outlets.[$loop->index][service]')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        </fieldset>
                        <div class="form-group row">
                            <label for="day_from0" class="col-sm-2 col-form-label">Day from</label>
                            <div class="col-sm-4">
                                <select name="outlets[0][day_from]"
                                    class="form-control custom_select @error('day_from') is-invalid @enderror"
                                    id="day_from0" placeholder="Choose Day" required>
                                    @foreach (App\Enums\DayEnum::cases() as $day)
                                        <option value="{{ $day->value }}" @selected($day->value == old('day_from'))>
                                            {{ strtoupper($day->value) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('day_from')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <label for="day_from" class="col-sm-2 col-form-label">Day to</label>
                            <div class="col-sm-4">
                                <select name="day_to"
                                    class="form-control custom_select @error('day_to') is-invalid @enderror" id="day_to"
                                    placeholder="Choose Day" required>
                                    @foreach (App\Enums\DayEnum::cases() as $day)
                                        <option value="{{ $day->value }}" @selected($day->value == old('day_to'))>
                                            {{ strtoupper($day->value) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('day_to')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="open_time" class="col-sm-2 col-form-label">Open Time</label>
                            <div class="col-sm-4">
                                <input type="text" id="open_time" name="open_time"
                                    class="form-control datetimepicker-input @error('open_time') is-invalid @enderror"
                                    value="{{ old('open_time') }}" data-target="#open_time" data-toggle="datetimepicker"
                                    autocomplete="off" />
                                @error('open_time')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <label for="close_time" class="col-sm-2 col-form-label">Close Time</label>
                            <div class="col-sm-4">
                                <input type="text" id="close_time" name="close_time"
                                    class="form-control datetimepicker-input @error('close_time') is-invalid @enderror"
                                    value="{{ old('close_time') }}" data-target="#close_time" data-toggle="datetimepicker"
                                    autocomplete="off" />
                                @error('close_time')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('cms.operational-hours.index') }}" class="btn btn-warning">Cancel</a>
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
        $(function() {
            $('#open_time').datetimepicker({
                format: 'HH:mm',
                stepping: 15
            })

            $('#close_time').datetimepicker({
                format: 'HH:mm',
                stepping: 15
            })
        })
    </script>
@endpush
