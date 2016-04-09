@extends('app')

@section('title') Change User Password | @parent @stop

@section('plugin-styles')
    <link href="{{ asset('theme/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('page-name') Change User Password @stop
@section('page-description') Manage User Passwords @stop
@section('breadcrumb')
    <li>
        <span>Tools</span>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Change User Password</span>
    </li>
@stop

@section('content')
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-user"></i>Change User Password
            </div>

            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>

        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="{{ URL::to('tools/change-password') }}" class="form-horizontal" method="post" id="user_form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                <div class="form-body">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                    </div>
                    <div class="alert alert-success display-hide">
                        <button class="close" data-close="alert"></button> Your form validation is successful. Sending form...
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Select User
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <select class="form-control select2me" name="id">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">New Password
                            <span class="required"> * </span>
                        </label>

                        <div class="col-md-4">
                            <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="password" class="form-control input-circle-right" placeholder="Enter New Password" name="password">
                                <i class="fa"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Confirm Password
                            <span class="required"> * </span>
                        </label>

                        <div class="col-md-4">
                            <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="password" class="form-control input-circle-right" placeholder="Confirm New Password" name="confirm_password">
                                <i class="fa"></i>
                            </div>
                            <span class="help-block">Password should be at least 5 symbols</span>
                        </div>
                    </div>

                    <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-circle green">Submit</button>
                            <button type="button" class="btn btn-circle grey-salsa btn-outline" onclick="location.href='/'">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
@endsection

@section('plugin-scripts')
    <script src="{{ asset('theme/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
@stop

@section('page-level-scripts')
    <script src="{{ asset('theme/pages/scripts/user-form-validation.js') }}" type="text/javascript"></script>
@stop