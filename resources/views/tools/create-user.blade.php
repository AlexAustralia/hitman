@extends('app')

@section('title') Create User | @parent @stop

@section('page-name') Create User @stop
@section('page-description') Creating New User @stop
@section('breadcrumb')
    <li>
        <span>Tools</span>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="/tools/users">Users</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Create User</span>
    </li>
@stop

@section('content')
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-user"></i>Create New User
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
            <form action="{{ URL::to('tools/users/save') }}" class="form-horizontal" method="post" id="create_user_form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                <div class="form-body">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                    </div>
                    <div class="alert alert-success display-hide">
                        <button class="close" data-close="alert"></button> Your form validation is successful. Sending form...
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Email | Login
                            <span class="required"> * </span>
                        </label>

                        <div class="col-md-4">
                            <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control input-circle-right" placeholder="Enter Unique Email" name="email">
                                <i class="fa"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Full Name
                            <span class="required"> * </span>
                        </label>

                        <div class="col-md-4">
                            <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" class="form-control input-circle-right" placeholder="Enter Full User Name" name="name">
                                <i class="fa"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">User Role</label>

                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <select class="form-control input-circle-right" name="role_id">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @if($role->id == 4) selected @endif >{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Password
                            <span class="required"> * </span>
                        </label>

                        <div class="col-md-4">
                            <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="password" class="form-control input-circle-right" placeholder="Enter User Password" name="password">
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
                                <input type="password" class="form-control input-circle-right" placeholder="Confirm User Password" name="confirm_password">
                                <i class="fa"></i>
                            </div>
                            <span class="help-block">Password should be at least 5 symbols</span>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-circle green">Submit</button>
                                <button type="button" class="btn btn-circle grey-salsa btn-outline" onclick="location.href='/tools/users'">Cancel</button>
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
    <script src="{{ asset('theme/pages/scripts/user-form-validation.js') }}" type="text/javascript"></script>
@stop