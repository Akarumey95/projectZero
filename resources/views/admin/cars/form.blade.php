@extends('admin.index')

@section('tab-block')

    {{--Create/Update Role Tab--}}
        <div class="card-header">Create Car</div>

        <div class="card-body">
            <form action="{{$action}}" method="post" enctype="multipart/form-data">
                @method($method)
                @csrf
                <label for="carName">Name
                    <input type="text" id="carName" name="carName" value="{{$car->name ?? ''}}">
                </label><br>
                <label for="carType">Type
                    <input type="text" id="carType" name="carType" value="{{$car->type ?? ''}}">
                </label><br>
                <label for="carBodyNumber">Body Number
                    <input type="text" id="carBodyNumber" name="carBodyNumber" value="{{$car->body_number ?? ''}}">
                </label><br>
                <input type="submit">
            </form>
        </div>
    {{--End Create/Update Role Tab--}}

@endsection