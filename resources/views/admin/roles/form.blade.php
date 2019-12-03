@extends('admin.index')

@section('tab-block')

    {{--Create/Update Role Tab--}}
        <div class="card-header">Create Role</div>

        <div class="card-body">
            <form action="{{$action}}" method="post" enctype="multipart/form-data">
                @method($method)
                @csrf
                <label for="roleName">Name
                    <input type="text" id="roleName" name="roleName" value="{{$role->name ?? ''}}">
                </label><br>
                <input type="submit">
            </form>
        </div>
    {{--End Create/Update Role Tab--}}

@endsection