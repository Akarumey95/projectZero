@extends('admin.index')

@section('tab-block')

    {{--General Roles Tab--}}
        <div class="card-header">Roles</div>

        <div class="card-body">
            <a class="nav-link" href="/admin/role/create">Create Role</a>

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
                            <a class="nav-link"
                               href="{{'/admin/role/' . $role->id . '/edit'}}">Update Role</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    {{--End General Roles Tab--}}

@endsection