@extends('app')

@section('title') @if(isset($property)) Property Details @else Create Property @endif of {{ $client->name }} {{ $client->surname }} | @parent @stop

@section('page-name') @if(isset($property)) Property Details @else Create Property @endif of {{ $client->name }} {{ $client->surname }} @stop
@section('page-description') @if(isset($client)) Editing @else Creating New @endif Propery @stop
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
        <a href="/clients/property/{{ $client->id }}">Property List</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>@if(isset($property)) Edit @else Create @endif Property</span>
    </li>
@stop

@section('content')
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-home"></i>@if(isset($property)) Property Details: {{ $property->address }} @else Create Property @endif
            </div>
        </div>

        <div class="portlet-body">

            <!-- BEGIN FORM-->
            <form action="{{ URL::to('clients/property/' . $client->id . '/save') }}" class="form-horizontal" method="post" id="edit_property_form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                @if(isset($property))
                    <input type="hidden" name="id" value="{{ $property->id }}" />
                @endif

                <div class="form-body">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                    </div>
                    <div class="alert alert-success display-hide">
                        <button class="close" data-close="alert"></button> Your form validation is successful. Sending form...
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Address
                            <span class="required"> * </span>
                        </label>

                        <div class="col-md-4">
                            <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="text" class="form-control input-circle-right" id="address" placeholder="Enter Property Address" name="address" @if(isset($property)) value="{{ $property->address }}" @endif>
                                <i class="fa"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Suburb</label>

                        <div class="col-md-4">
                            <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="text" class="form-control input-circle-right" name="locality" placeholder="Filled automatically" @if(isset($property)) value="{{ $property->suburb }}" @endif readonly>
                                <i class="fa"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Postcode</label>

                        <div class="col-md-4">
                            <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="text" class="form-control input-circle-right" name="postal_code" placeholder="Filled automatically" @if(isset($property)) value="{{ $property->postcode }}" @endif readonly>
                                <i class="fa"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Property Notes</label>

                        <div class="col-md-4">
                            <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                <textarea class="form-control" rows="3" name="property_notes">@if(isset($property)) {{ $property->property_notes }} @endif</textarea>
                                <i class="fa"></i>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-3">
                            <div class="input-group">
                                <div class="md-checkbox md-checkbox-inline">
                                    <input type="checkbox" name="occupant_is_client" id="occupant_is_client" class="md-check" value="1" @if(isset($property) && ($property->occupant_is_client == 1)) checked @endif>
                                    <label for="occupant_is_client">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> Occupant is a Client </label>
                                </div>
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
                                <select class="form-control input-circle-right occupant" name="occupant_title_id"
                                        @if(isset($property) && ($property->occupant_is_client == 1)) disabled @endif>
                                    <option value="0">No Titles</option>
                                    @foreach($titles as $title)
                                        <option value="{{ $title->id }}" @if(isset($property)) @if($title->id == $property->occupant_title_id) selected @endif @endif>{{ $title->name }}</option>
                                    @endforeach
                                </select>
                                <i class="fa"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>

                        <div class="col-md-4">
                            <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" class="form-control input-circle-right occupant" placeholder="Enter Occupant Name" name="occupant_name" @if(isset($property)) value="{{ $property->occupant_name }}" @endif
                                @if(isset($property) && ($property->occupant_is_client == 1)) disabled @endif>
                                <i class="fa"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Surname</label>

                        <div class="col-md-4">
                            <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" class="form-control input-circle-right occupant" placeholder="Enter Occupant Surname" name="occupant_surname" @if(isset($property)) value="{{ $property->occupant_surname }}" @endif
                                @if(isset($property) && ($property->occupant_is_client == 1)) disabled @endif>
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
                                <input type="text" class="form-control input-circle-right occupant" placeholder="Enter Occupant's Phone Number" name="occupant_phone" @if(isset($property)) value="{{ $property->occupant_phone }}" @endif
                                @if(isset($property) && ($property->occupant_is_client == 1)) disabled @endif>
                                <i class="fa"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-circle green">Submit</button>
                                <button type="button" class="btn btn-circle grey-salsa btn-outline" onclick="location.href='/clients/property/{{ $client->id }}'">Cancel</button>
                            </div>
                        </div>
                    </div>
            </form>
            <!-- END FORM-->

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
    <script src="{{ asset('theme/pages/scripts/property-form-validation.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $('#address').geocomplete({details: "form"});

            $('#occupant_is_client').on('change', function () {
                if ($(this).is(':checked')){
                    $('.occupant').attr('disabled', true).val('');
                }
                else {
                    $('.occupant').removeAttr('disabled');
                }
            });
        });
    </script>
@stop
