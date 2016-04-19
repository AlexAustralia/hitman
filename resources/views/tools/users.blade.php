@extends('app')

@section('title') Users | @parent @stop

@section('page-name') Users @stop
@section('page-description') Users Management @stop
@section('breadcrumb')
    <li>
        <span>Tools</span>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Users</span>
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
                    <a href="/tools/users/create">
                        <i class="icon-plus"></i> Create New User</a>
                </li>
            </ul>
        </div>
    </div>
@stop

@section('content')
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i>Users</div>
        </div>

        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Email | Login</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <span class="label label-sm
                                    @if($user->role->id == 1) label-success @endif
                                    @if($user->role->id == 2) label-info @endif
                                    @if($user->role->id == 3) label-warning @endif
                                    @if($user->role->id == 4) label-danger @endif
                                        ">{{ $user->role->name }}
                                </span>
                            <td>
                            <td>
                                <a href="/tools/users/edit/{{ $user->id }}" class="btn btn-outline btn-circle green btn-sm purple">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                     </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
