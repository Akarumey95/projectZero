@extends('admin.index')

@section('tab-block')

    {{--General Cars Tab--}}
    <div class="card-header">Cars</div>

    <div class="card-body">
        <a class="nav-link" href="/admin/car/create">Create Car</a>

        <table class="table">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Type</th>
                <th>Body Number</th>
                <th>Action</th>
            </tr>
            @foreach($cars as $car)
                <tr>
                    <td>{{$car->id}}</td>
                    <td>{{$car->name}}</td>
                    <td>{{$car->type}}</td>
                    <td>{{$car->body_number}}</td>
                    <td>
                        <a class="nav-link"
                           href="{{'/admin/car/' . $car->id . '/edit'}}">Update Car</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{--End General Cars Tab--}}

@endsection