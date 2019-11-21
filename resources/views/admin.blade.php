@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header text-center">Menu</div>

                    <div class="card-body">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link nav__link active" href="users">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav__link" href="roles">Roles</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="tab-content">
                        {{--General Users Tab--}}
                        <div class="tab-pane tab__pane show active" id="users">
                            <div class="card-header">Users</div>

                            <div class="card-body">
                                <a class="nav-link nav__link btn__toAction" href="createUser">Create User</a>

                                <table class="table">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->role()->first()->name}}</td>
                                            <td>
                                                <a class="nav-link nav__link btn__toAction"
                                                   href="updateUser" data-id="{{$user->id}}">Update User</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        {{--End General Users Tab--}}
                        {{--General Roles Tab--}}
                        <div class="tab-pane tab__pane" id="roles">
                            <div class="card-header">Roles</div>

                            <div class="card-body">
                                <a class="nav-link nav__link btn__toAction" href="createRole">Create Roles</a>

                                <table class="table">
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{$role->id}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>
                                                <a class="nav-link nav__link btn__toAction"
                                                   href="updateRole" data-id="{{$role->id}}">Update Role</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        {{--End General Roles Tab--}}
                        {{--Create User Tab--}}
                        <div class="tab-pane tab__pane" id="createUser">
                            <div class="card-header">Create User</div>

                            <div class="card-body">
                                <form action="{{route('createUser')}}" method="post" class="form__toSubmit" enctype="multipart/form-data">
                                    @csrf
                                    <label for="userName">Name
                                        <input type="text" id="userName" name="userName">
                                    </label>
                                    <label for="userEmail">Email
                                        <input type="email" id="userEmail" name="userEmail">
                                    </label>
                                    <label for="userPassword">Password
                                        <input type="password" id="userPassword" name="userPassword">
                                    </label>
                                    <label for="userRole">Role
                                        <select name="userRole" id="userRole">
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    <input type="submit">
                                </form>
                            </div>
                        </div>
                        {{--End Create User Tab--}}
                        {{--Update User Tab--}}
                        @foreach($users as $user)
                            <div class="tab-pane tab__pane" id="{{'updateUserID-' . $user->id}}">
                                <div class="card-header">Update User</div>

                                <div class="card-body">
                                    <form action="{{route('updateUser')}}" method="post" class="form__toSubmit" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="userId" value="{{$user->id}}">
                                        <label for="userName">Name
                                            <input type="text" id="userName" name="userName" value="{{$user->name}}">
                                        </label>
                                        <label for="userEmail">Email
                                            <input type="email" id="userEmail" name="userEmail" value="{{$user->email}}">
                                        </label>
                                        <label for="userPassword">Password
                                            <input type="password" id="userPassword" name="userPassword">
                                        </label>
                                        <label for="userRole">Role
                                            <select name="userRole" id="userRole">
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}"
                                                    @if($role->id == $user->role_id)
                                                        selected
                                                    @endif
                                                    >{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                        <input type="submit">
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        {{--End Update User Tab--}}
                        {{--Create Role Tab--}}
                        <div class="tab-pane tab__pane" id="createRole">
                            <div class="card-header">Create Role</div>

                            <div class="card-body">
                                <form action="{{route('createRole')}}" method="post"  class="form__toSubmit" enctype="multipart/form-data">
                                    @csrf
                                    <label for="roleName">Name
                                        <input type="text" id="roleName" name="roleName">
                                    </label>
                                    <input type="submit">
                                </form>
                            </div>
                        </div>

                        {{--End Create Role Tab--}}
                        {{--Update Role Tab--}}
                        @foreach($roles as $role)
                            <div class="tab-pane tab__pane" id="{{'updateRoleID-' . $role->id}}">
                                <div class="card-header">Update Role</div>

                                <div class="card-body">
                                    <form action="{{route('updateRole')}}" method="post" class="form__toSubmit" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="roleId" value="{{$role->id}}">
                                        <label for="roleName">Name
                                            <input type="text" id="roleName" name="roleName" value="{{$role->name}}">
                                        </label>
                                        <input type="submit">
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        {{--End Update Role Tab--}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection