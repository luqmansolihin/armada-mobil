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
                    <h3 class="card-title">Operational Hours | Update</h3>
                </div>

                <form class="form-horizontal" action="{{ route('cms.operational-hours.update', $operationalHour->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="day_from" class="col-sm-2 col-form-label">Day from</label>
                            <div class="col-sm-4">
                                <select name="day_from"
                                    class="form-control custom_select @error('day_from') is-invalid @enderror"
                                    id="day_from" placeholder="Choose Day" required>
                                    @foreach (App\Enums\DayEnum::cases() as $day)
                                        <option value="{{ $day->value }}" @selected($day->value == old('day_from', $operationalHour->day_from))>
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
                                        <option value="{{ $day->value }}" @selected($day->value == old('day_to', $operationalHour->day_to))>
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
                                    value="{{ old('open_time', $operationalHour->open_time) }}" data-target="#open_time"
                                    data-toggle="datetimepicker" autocomplete="off" />
                                @error('open_time')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <label for="close_time" class="col-sm-2 col-form-label">Close Time</label>
                            <div class="col-sm-4">
                                <input type="text" id="close_time" name="close_time"
                                    class="form-control datetimepicker-input @error('close_time') is-invalid @enderror"
                                    value="{{ old('close_time', $operationalHour->close_time) }}" data-target="#close_time"
                                    data-toggle="datetimepicker" autocomplete="off" />
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
