@extends('app')

@section('title') @if(isset($client)) Client Details: {{ $client->name }} {{ $client->surname }} @else Create Client @endif | @parent @stop

@section('page-name') @if(isset($client)) Client Details: {{ $client->name }} {{ $client->surname }} @else Create Client @endif @stop
@section('page-description') @if(isset($client)) Editing @else Creating New @endif Client @stop
@section('breadcrumb')
    <li>
        <a href="/clients">Clients</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>@if(isset($client)) Edit @else Create @endif Client</span>
    </li>
@stop

@section('content')
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-user"></i>@if(isset($client)) Client Details: {{ $client->name }} {{ $client->surname }} @else Create Client @endif
            </div>
        </div>

        <div class="portlet-body">

            <!-- BEGIN TOP TAB PANEL -->
            @if(isset($client))
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="/clients/edit/{{ $client->id }}" data-toggle="tab"> Client Details </a>
                        </li>
                        <li>
                            <a href="/clients/property/{{ $client->id }}"> Property List </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active">
            @endif
            <!-- END TOP TAB PANEL -->

                        <!-- BEGIN FORM-->
                        <form action="{{ URL::to('clients/save') }}" class="form-horizontal" method="post" id="edit_client_form">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            @if(isset($client))
                                <input type="hidden" name="id" value="{{ $client->id }}" />
                            @endif

                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                                </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful. Sending form...
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Type
                                    </label>

                                    <div class="col-md-4">
                                        <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                            <select class="form-control input-circle-right" name="type">
                                                <option value="1">Owner</option>
                                                <option value="2">Agency</option>
                                                <option value="3">Tenant (Occupier)</option>
                                            </select>
                                            <i class="fa"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Title</label>

                                    <div class="col-md-4">
                                        <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                            <select class="form-control input-circle-right" name="title_id">
                                                <option value="0">No Titles</option>
                                                @foreach($titles as $title)
                                                    <option value="{{ $title->id }}" @if(isset($client)) @if($title->id == $client->title_id) selected @endif @endif>{{ $title->name }}</option>
                                                @endforeach
                                            </select>
                                            <i class="fa"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Name
                                        <span class="required"> * </span>
                                    </label>

                                    <div class="col-md-4">
                                        <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                            <input type="text" class="form-control input-circle-right" placeholder="Enter Client Name" name="name" @if(isset($client)) value="{{ $client->name }}" @endif>
                                            <i class="fa"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Surname
                                        <span class="required"> * </span>
                                    </label>

                                    <div class="col-md-4">
                                        <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                            <input type="text" class="form-control input-circle-right" placeholder="Enter Client Surname" name="surname" @if(isset($client)) value="{{ $client->surname }}" @endif>
                                            <i class="fa"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4 col-md-offset-3">
                                        <div class="input-group">
                                            <div class="md-checkbox md-checkbox-inline">
                                                <input type="checkbox" name="previously_cancelled" id="previously_cancelled" class="md-check" value="1" @if(isset($client) && !is_null($client->date_cancel)) checked @endif>
                                                <label for="previously_cancelled">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Client Previously Cancelled a Job on the Day </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Spouse Name</label>

                                    <div class="col-md-4">
                                        <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                            <input type="text" class="form-control input-circle-right" placeholder="Enter Spouse Name if applicable" name="spouse_name" @if(isset($client)) value="{{ $client->spouse_name }}" @endif>
                                            <i class="fa"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Phone Number</label>

                                    <div class="col-md-4">
                                        <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-phone"></i>
                                </span>
                                            <input type="text" class="form-control input-circle-right" placeholder="Enter Phone Number" name="phone" @if(isset($client)) value="{{ $client->phone }}" @endif>
                                            <i class="fa"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Work Number</label>

                                    <div class="col-md-4">
                                        <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-phone"></i>
                                </span>
                                            <input type="text" class="form-control input-circle-right" placeholder="Enter Work Number" name="work" @if(isset($client)) value="{{ $client->work }}" @endif>
                                            <i class="fa"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Mobile Number</label>

                                    <div class="col-md-4">
                                        <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-phone"></i>
                                </span>
                                            <input type="text" class="form-control input-circle-right" placeholder="Enter Mobile Number" name="mobile" @if(isset($client)) value="{{ $client->mobile }}" @endif>
                                            <i class="fa"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Email</label>

                                    <div class="col-md-4">
                                        <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                            <input type="text" class="form-control input-circle-right" placeholder="Enter Email" name="email" @if(isset($client)) value="{{ $client->email }}" @endif>
                                            <i class="fa"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Fax Number</label>

                                    <div class="col-md-4">
                                        <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-phone"></i>
                                </span>
                                            <input type="text" class="form-control input-circle-right" placeholder="Enter Fax Number if applicable" name="fax" @if(isset($client)) value="{{ $client->fax }}" @endif>
                                            <i class="fa"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Client Address</label>

                                    <div class="col-md-4">
                                        <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                            <input type="text" class="form-control input-circle-right" id="client_address" placeholder="Enter Client Address if applicable" name="client_address" @if(isset($client)) value="{{ $client->client_address }}" @endif>
                                            <i class="fa"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-circle green">Submit</button>
                                            <button type="button" class="btn btn-circle grey-salsa btn-outline" onclick="location.href='/clients'">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                        <!-- END FORM-->

            <!-- BEGIN BOTTOM TAB PANEL -->
            @if(isset($client))
                        </div>
                    </div>
                </div>
            @endif
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
