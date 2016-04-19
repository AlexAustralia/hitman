@extends('app')

@section('title') Streets | @parent @stop

@section('plugin-styles')
    <link href="{{ asset('theme/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('page-name') Streets @stop
@section('page-description') Edit Lookup: Streets @stop
@section('breadcrumb')
    <li>
        <span> Edit Lookups </span>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span> Streets </span>
    </li>
@stop

@section('content')

    @include('partials.modals.ajax')

    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-puzzle-piece"></i> Streets </div>
        </div>

        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">
                            <button id="streets_new" class="btn green"> Add New
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-1 control-label">Suburb
                    </label>

                    <div class="col-md-4">
                        <div class="input-group">
                            <select class="form-control select2me">
                                @foreach($suburbs as $suburb)
                                    <option value="{{ $suburb->id }}">{{ $suburb->locality }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>

            <table class="table table-striped table-hover table-bordered" id="streets">
                <thead>
                <tr>
                    <th> Street Name </th>
                    <th> Edit </th>
                    <th> Delete </th>
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
    <script src="{{ asset('theme/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
@stop

@section('page-level-scripts')
    <script src="{{ asset('theme/pages/scripts/streets-datatables-editable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/global/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}" type="text/javascript"></script>
@stop
