@extends('app')

@section('title') Technician Types | @parent @stop

@section('plugin-styles')
    <link href="{{ asset('theme/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('page-name') Technician Types @stop
@section('page-description') Edit Lookup: Technician Types @stop
@section('breadcrumb')
    <li>
        <span>Edit Lookups</span>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Technician Types</span>
    </li>
@stop

@section('content')

    @include('partials.modals.ajax')

    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-puzzle-piece"></i>Technician Types</div>
        </div>

        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">
                            <button id="technician_types_new" class="btn green"> Add New
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered" id="technician_types">
                <thead>
                <tr>
                    <th> Technician Types </th>
                    <th> Edit </th>
                    <th> Delete </th>
                </tr>
                </thead>
                <tbody>
                @foreach($technician_types as $technician_type)
                    <tr>
                        <td> {{ $technician_type->name }} </td>
                        <td>
                            <a class="edit" href="javascript:;"> Edit </a>
                        </td>
                        <td>
                            <a class="delete" href="javascript:;" data-toggle="confirmation" data-singleton="true"> Delete </a>
                        </td>
                    </tr>
                @endforeach
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
    <script src="{{ asset('theme/pages/scripts/technician-types-datatables-editable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/global/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}" type="text/javascript"></script>
@stop
