@extends('layouts.app')

@section('content')
    <div class="col-lg-3">
        <!-- Tabs box -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('ship.tabs') }}</h3>
            </div>
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-stacked" role="tablist">
					<li @if (Request::route()->getName() == 'ships') class="active" @endif><a href="{{ url('/admin/ships') }}" role="tab">Laivat</a></li>
                    <li @if (Request::route()->getName() == 'users') class="active" @endif><a href="{{ url('/admin/users') }}" role="tab">Käyttäjät</a></li>
                    <li @if (Request::route()->getName() == 'cargo') class="active" @endif><a href="{{ url('/admin/cargo') }}" role="tab">Rahti</a></li>
					<li @if (Request::route()->getName() == 'companies') class="active" @endif><a href="{{ url('/admin/companies') }}" role="tab">Yhtiö</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <!-- Tabs content -->
        <div class="tab-content">
            <div class="col-lg-10">
                @foreach(array('success', 'danger') as $flash)
                    @if (session()->has($flash))
                        @foreach(session()->get($flash) as $msg)
                            <div class="alert alert-{{ $flash }}" role="alert">
                                {{ $msg }}
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
            @yield('admin-content')
        </div>
    </div>
@endsection