@extends('admin.index')

@section('tab-block')

    {{--Create/Update Role Tab--}}
        <div class="card-header">Create Tariff</div>

        <div class="card-body">
            <form action="{{$action}}" method="post" enctype="multipart/form-data">
                @method($method)
                @csrf
                <label for="tariffName">Name
                    <input type="text" id="tariffName" name="tariffName" value="{{$tariff->name ?? ''}}">
                </label><br>
                <label for="tariffRate">Rate
                    <input type="text" id="tariffRate" name="tariffRate" value="{{$tariff->rate ?? ''}}">
                </label><br>
                <input type="submit">
            </form>
        </div>
    {{--End Create/Update Role Tab--}}

@endsection