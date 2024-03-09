@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>{{ __('Notes') }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <a href="{{ route('notes.create') }}" class="btn btn-primary m-2">{{ __('Add Note') }}</a>
                            </div>
                            <br>

                            {!! $dataTable->table(['class' => 'table table-bordered']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('javascript')
    @push("scripts")
    {!! $dataTable->scripts() !!}
    @endpush

    {{-- <script>
        $(document).ready(function () {
            $('#notes-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('notes.datatables') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'content', name: 'content' },
                    { data: 'note_type', name: 'note_type' },
                    { data: 'applies_to_date', name: 'applies_to_date' },
                    { data: 'user.name', name: 'user.name', title: 'User Name' },
                    { data: 'status.name', name: 'status.name', title: 'Status Name' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    {
                        render: function (data, type, full, meta) {
                            return `

                            `;
                        }
                    },
                ]
            });
        });
    </script> --}}


    @endsection

@endsection
