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
                                <a class="nav-link" href="/admin/user">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/role">Roles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/car">Cars</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/tariff">Tariffs</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @hasSection('tab-block')
                <div class="col-md-9">
                    <div class="card">
                        <div class="tab-content">
                            @yield('tab-block')
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection