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

        <div class="col-xs-12 well">
            <form id="search-form" class="form-horizontal" autocomplete="off">
                <div class="form-group">
                    <label class="col-md-1 control-label" for="phone">Phone: </label>
                    <div class="col-md-2">
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>

                    <label class="col-md-1 control-label" for="name">Name: </label>
                    <div class="col-md-2">
                        <input type="text" name="name" id="name" class="form-control">
                    </div>

                    <label class="col-md-1 control-label" for="surname">Surname: </label>
                    <div class="col-md-2">
                        <input type="text" name="surname" id="surname" class="form-control">
                    </div>

                    <label class="col-md-1 control-label" for="address">Address: </label>
                    <div class="col-md-2">
                        <input type="text" name="address" id="address" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-1 col-md-11">
                        <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-filter"></span> Search</button>
                    </div>
                </div>
                <div class="col-xs-12 poline-products editting" id="load_info" style="display: none;"></div>
            </form>
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
                bFilter: false,
                lengthMenu: [ 50, 100, 250 ],
                ajax: {
                    url: "{{ URL::to('clients/data') }}",
                    data: function (d) {
                        d.phone = $('#phone').val();
                        d.name = $('#name').val();
                        d.surname = $('#surname').val();
                        d.address = $('#address').val();
                    }
                },
            });

            $('#search-form').on('submit', function(e) {
                oTable.draw();
                e.preventDefault();
            });

        });
    </script>

@stop