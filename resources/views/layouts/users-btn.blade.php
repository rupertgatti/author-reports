@extends('layouts.app')

@section('app')
@include('layouts.nav')
@include('layouts.status')
<div class="container" style="margin-bottom: 1em;">
    <div class="row">
        <div class="col-md-2 pull-left">
            <a class="btn btn-default" href="{{ route('admin-users') }}">
                <i class="glyphicon glyphicon-chevron-left"></i>
                Manage Users
            </a>
        </div>
        <div class="col-lg-2 pull-right">
            @yield('secondary-btn')
        </div>
    </div>
</div>
@yield('content')
@endsection
