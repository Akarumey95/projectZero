@extends('admin.index')

@section('tab-block')

    {{--General Users Tab--}}
    <div class="tab-pane tab__pane show active" id="users">
        <div class="card-header">Users</div>

        <div class="card-body">
            <a class="nav-link" href="/admin/user/create">Create User</a>

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
                            <a class="nav-link" href="{{'/admin/user/' . $user->id . '/edit'}}">Update User</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    {{--End General Users Tab--}}

@endsection