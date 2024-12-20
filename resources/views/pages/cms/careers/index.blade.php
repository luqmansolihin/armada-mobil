@extends('layouts.cms.app')

@push('additional-style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Careers</h3>
                </div>

                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="col-lg-2 p-0 mb-2">
                        <a href="{{ route('cms.careers.create') }}" class="btn btn-primary btn-block">Add Career</a>
                    </div>

                    <table id="careers" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Registration Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($careers as $career)
                                <tr>
                                    <td>{{ $career->name }}</td>
                                    <td>{{ Carbon\Carbon::parse($career->registration_from)->format('d-F-Y') . ' - ' . Carbon\Carbon::parse($career->registration_to)->format('d-F-Y') }}
                                    </td>
                                    <td>
                                        @if ($career->status)
                                            active
                                        @else
                                            inactive
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('cms.careers.edit', $career->id) }}" class="badge bg-warning"
                                            title="Update"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('cms.careers.delete', $career->id) }}" method="POST"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="badge bg-danger border-0" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('additional-script')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function() {
            $("#careers").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "order": [
                        [1, 'desc']
                    ],
                    "buttons": [{
                            extend: 'print',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        "colvis"
                    ]
                })
                .buttons()
                .container()
                .appendTo('#careers_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
