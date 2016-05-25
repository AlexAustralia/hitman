@extends('app')

@section('title') Clients | @parent @stop

@section('plugin-styles')
    <link href="{{ asset('theme/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('page-name') Clients @stop
@section('page-description') Clients Management @stop
@section('breadcrumb')
    <li>
        <span>Clients</span>
    </li>
@stop

@section('actions')
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="/clients/create">
                        <i class="icon-plus"></i> Create New Client</a>
                </li>
            </ul>
        </div>
    </div>
@stop

@section('content')
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i>Clients</div>
        </div>

        <div class="portlet-body">

                <table class="table table-striped table-hover" id="table">
                    <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Phone</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            
        </div>
    </div>
@endsection

@section('plugin-scripts')
    <script src="{{ asset('theme/global/scripts/datatable.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
@stop

@section('page-level-scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            var oTable = $('#table').DataTable({
                processing: true,
                serverSide: true,
                lengthMenu: [ 50, 100, 250 ],
                ajax: {
                    url: "{{ URL::to('clients/data') }}",
                    data: function (d) {

                    }
                },
            });


        });
    </script>

@stop