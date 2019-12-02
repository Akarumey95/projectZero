@extends('admin.index')

@section('tab-block')

    {{--Create/Update User Tab--}}
        <div class="card-header">Create User</div>

        <div class="card-body">
            <form action="{{$action}}" method="post" enctype="multipart/form-data">
                @method($method)
                @csrf
                <label for="userName">Name
                    <input type="text" id="userName" name="userName" value="{{$user->name ?? ''}}">
                </label><br>
                <label for="userEmail">Email
                    <input type="email" id="userEmail" name="userEmail" value="{{$user->email ?? ''}}">
                </label><br>
                <label for="userPassword">Password
                    <input type="password" id="userPassword" name="userPassword">
                </label><br>
                <label for="userRole">Role
                    <select name="userRole" id="userRole">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}"
                                @if(isset($user->role_id) && $role->id == $user->role_id)
                                selected
                                @endif
                            >{{$role->name}}</option>
                        @endforeach
                    </select>
                </label><br>
                <input type="submit">
            </form>
        </div>
    {{--End Create/Update User Tab--}}

@endsection