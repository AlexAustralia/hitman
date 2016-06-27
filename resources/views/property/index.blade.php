@extends('app')

@section('title') Property List of {{ $client->name }} {{ $client->surname }} | @parent @stop

@section('page-name') Property List of {{ $client->name }} {{ $client->surname }} @stop
@section('page-description') Editing Client @stop
@section('breadcrumb')
    <li>
        <a href="/clients">Clients</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="/clients/edit/{{ $client->id }}">Edit Clients</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Property List</span>
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
                    <a href="/clients/property/{{ $client->id }}/create">
                        <i class="icon-plus"></i> Create New Property</a>
                </li>
            </ul>
        </div>
    </div>
@stop

@section('content')
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-home"></i>Property List of {{ $client->name }} {{ $client->surname }}
            </div>
        </div>

        <div class="portlet-body">

            <!-- BEGIN TOP TAB PANEL -->
            <div class="tabbable-custom ">

                <ul class="nav nav-tabs ">
                    <li>
                        <a href="/clients/edit/{{ $client->id }}"> Client Details </a>
                    </li>
                    <li class="active">
                        <a href="/clients/property/{{ $client->id }}" data-toggle="tab"> Property List </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active">
            <!-- END TOP TAB PANEL -->

                        <!-- BEGIN PROPERTY LIST TABLE -->
                        <table class="table table-striped table-hover" id="table">
                            <thead>
                            <tr>
                                <th>Address</th>
                                <th width="10%">Postcode</th>
                                <th>Occupant Name</th>
                                <th width="13%">Occupant Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($property as $line)
                                <tr>
                                    <td><a href="/clients/property/edit/{{ $line->id }}">{{ $line->address }}</td>
                                    <td>{{ $line->postcode }}</td>
                                    <td>@if($line->occupant_is_client)
                                            {{ $client->name }} {{ $client->surname }}
                                        @else
                                            {{ $line->occupant_name }} {{ $line->occupant_surname }}
                                        @endif
                                    </td>
                                    <td>@if($line->occupant_is_client)
                                            {{ $client->phone }}
                                        @else
                                            {{ $line->occupant_phone }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- END PROPERTY LIST TABLE -->

            <!-- BEGIN BOTTOM TAB PANEL -->
                    </div>
                </div>
            </div>
            <!-- END BOTTOM TAB PANEL -->

        </div>
    </div>
@endsection

@section('plugin-scripts')
    <script src="{{ asset('theme/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>

    <script src="http://maps.googleapis.com/maps/api/js?libraries=places" type="text/javascript"></script>
    <script src="{{ asset('theme/global/plugins/jquery.geocomplete.js') }}" type="text/javascript"></script>
@stop

@section('page-level-scripts')
    <script src="{{ asset('theme/pages/scripts/client-form-validation.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $('#client_address').geocomplete();
        });
    </script>
@stop
