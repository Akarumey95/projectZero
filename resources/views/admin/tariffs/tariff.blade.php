@extends('admin.index')

@section('tab-block')

    {{--General Cars Tab--}}
    <div class="card-header">Tariffs</div>

    <div class="card-body">
        <a class="nav-link" href="/admin/tariff/create">Create Tariff</a>

        <table class="table">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Rate</th>
                <th>Action</th>
            </tr>
            @foreach($tariffs as $tariff)
                <tr>
                    <td>{{$tariff->id}}</td>
                    <td>{{$tariff->name}}</td>
                    <td>{{$tariff->rate}}</td>
                    <td>
                        <a class="nav-link"
                           href="{{'/admin/tariff/' . $tariff->id . '/edit'}}">Update Car</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{--End General Cars Tab--}}

@endsection