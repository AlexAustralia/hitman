@extends('app')

@section('title') @if(isset($user)) Edit @else Create @endif User | @parent @stop

@section('page-name') @if(isset($user)) Edit @else Create @endif User @stop
@section('page-description') @if(isset($user)) Editing @else Creating New @endif User @stop
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
        <span>@if(isset($user)) Edit @else Create @endif User</span>
    </li>
@stop

@section('content')
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-user"></i>@if(isset($user)) Edit @else Create New @endif User
            </div>
        </div>

        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="{{ URL::to('tools/users/save') }}" class="form-horizontal" method="post" id="create_user_form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                @if(isset($user))
                    <input type="hidden" name="id" value="{{ $user->id }}" />
                @endif

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
                                <input type="email" class="form-control input-circle-right" placeholder="Enter Unique Email" name="email" @if(isset($user)) value="{{ $user->email }}" @endif>
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
                                <input type="text" class="form-control input-circle-right" placeholder="Enter Full User Name" name="name" @if(isset($user)) value="{{ $user->name }}" @endif>
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
                                        @if(isset($user))
                                            <option value="{{ $role->id }}" @if($role->id == $user->role_id) selected @endif >{{ $role->name }}</option>
                                        @else
                                            <option value="{{ $role->id }}" @if($role->id == 2) selected @endif >{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    @if(isset($user))
                        <div class="form-group">
                            <label class="col-md-3 control-label"> Change Password </label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="md-checkbox md-checkbox-inline has-success">
                                        <input type="checkbox" id="change_password" class="md-check">
                                        <label for="change_password">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Tick if you want to change password </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="col-md-3 control-label">Password
                            <span class="required"> * </span>
                        </label>

                        <div class="col-md-4">
                            <div class="input-group input-icon right">
                                <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="password" class="form-control input-circle-right" placeholder="Enter User Password" name="password" @if(isset($user)) disabled @endif>
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
                                <input type="password" class="form-control input-circle-right" placeholder="Confirm User Password" name="confirm_password" @if(isset($user)) disabled @endif>
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

@section('custom-scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#change_password').on('change', function () {
                if ($(this).is(':checked')){
                    $('input[type=password]').removeAttr('disabled');
                }
                else {
                    $('input[type=password]').attr('disabled', true).val('');
                }
            });
        });
    </script>
@endsection