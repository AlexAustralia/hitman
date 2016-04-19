@extends('app')

@section('title') Default Franchisee Settings | @parent @stop

@section('page-name') Default Franchisee Settings @stop
@section('page-description') Manage Default Franchisee Settings @stop
@section('breadcrumb')
    <li>
        <span>Tools</span>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Default Franchisee Settings</span>
    </li>
@stop

@section('content')
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gears"></i>Default Franchisee Settings
            </div>
        </div>

        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="{{ URL::to('tools/franchisee-settings') }}" class="form-horizontal" method="post" id="franchisee_settings_form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                <div class="form-body">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                    </div>
                    <div class="alert alert-success display-hide">
                        <button class="close" data-close="alert"></button> Your form validation is successful. Sending form...
                    </div>

                    @foreach($settings as $key => $setting)
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ $setting->name }} @if($key > 5) (%) @endif
                                <span class="required"> * </span>
                            </label>

                            <div class="col-md-4">
                                <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa @if($key < 6) fa-dollar @else fa-pie-chart @endif"></i>
                                </span>
                                    <input type="number" class="form-control input-circle-right" placeholder="Enter {{ $setting->name }}" name="value[{{ $key }}]" value="{{ $setting->value }}">
                                    <i class="fa"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-circle green">Submit</button>
                                <button type="button" class="btn btn-circle grey-salsa btn-outline" onclick="location.href='/'">Cancel</button>
                            </div>
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
@stop

@section('page-level-scripts')
    <script src="{{ asset('theme/pages/scripts/franchisee-settings-form-validation.js') }}" type="text/javascript"></script>
@stop