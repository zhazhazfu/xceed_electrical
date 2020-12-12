@extends('layouts.app')

@section('title', 'User Management')

@section('content')

@if (Auth::user() && Auth::user()->role != 'admin')
<div class="mx-auto mt-5" style="width: 200px;">
    <h2>
        Access denied
    </h2>
</div>

@elseif (Auth::user() && Auth::user()->role == 'admin')

<!-- Button trigger modal -->
<div class=" p-3 mb-5 bg-white rounded border">
    <div>
        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
        @endif
    </div>


    <!-- Add user button -->
    <button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal" data-target="#userModal">
        Add User
    </button>

    <!-- Active/Archived buttons -->
    <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
        <label class="btn btn-secondary active">
            <input type="radio" name="options" id="active" autocomplete="off" checked> Active
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="options" id="archived" autocomplete="off"> Archived
        </label>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Enter user details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="{{ url('users') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_archived" value="0">
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Username</label>
                                <input type="text" class="form-control" id="inputName" name="user_name"
                                    placeholder="Username">
                            </div>
                            <div class="form-group col-sm">
                                <label for="input">Full name</label>
                                <input type="text" class="form-control" id="inputCompany" name="user_firstlast"
                                    placeholder="Full Name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Password</label>
                                <input type="password" class="form-control" id="inputPhone" name="password"
                                    placeholder="Password">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">User type</label>
                                <select id="role" name="role" class="form-control">
                                    <option value="user" selected>User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End modal -->

    <!-- Active content -->
    <div id="active_div">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Users</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-right" id="active_input" onkeyup="activeFunction()"
                    placeholder="Search username">
            </div>
        </div>

        <div class='table-responsive'>
            <table id="active_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortActive(0)">Username</th>
                        <th scope="col" onclick="sortActive(1)">Full Name</th>
                        <th scope="col" onclick="sortActive(2)">Type</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    @if($user->user_archived == '0')
                    <tr>
                        <td>{{ $user->user_name }}</td>
                        <td>{{ $user->user_firstlast }}</td>
                        <td>{{ $user->role }}</td>
                        <td><a href="{{action('UserController@edit', $user['pk_user_id'])}}">Edit</a></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Archived content -->
    <div id="archived_div" style="display: none">

        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Archived Users</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-right" id="archived_input" onkeyup="archivedFunction()"
                    placeholder="Search username">

            </div>
        </div>
        <table id="archived_table" class="display table table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col" onclick="sortArchived(0)">Username</th>
                    <th scope="col" onclick="sortArchived(1)">Full Name</th>
                    <th scope="col" onclick="sortArchived(2)">Type</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                @if($user->user_archived == '1')
                <tr>
                    <td>{{ $user->user_name }}</td>
                    <td>{{ $user->user_firstlast }}</td>
                    <td>{{ $user->role }}</td>
                    <td><a href="{{action('UserController@edit', $user['pk_user_id'])}}">Edit</a></td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@stop
