@extends('app')

@section('title') Clients | @parent @stop

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
            <div class="table-scrollable">
                TABLE
            </div>
        </div>
    </div>
@endsection
