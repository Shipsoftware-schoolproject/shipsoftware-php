@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/api.js') }}"></script>
    <script src="{{ asset('js/users.js') }}"></script>
@endsection

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
					<li class="active"><a href="#ships" role="tab" data-toggle="tab">Laivat</a></li>
                    <li><a href="#users" role="tab" data-toggle="tab">Käyttäjät</a></li>
                    <li><a href="#editcargo" role="tab" data-toggle="tab">Rahti</a></li>
					<li><a href="#editcompany" role="tab" data-toggle="tab">Yhtiö</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <!-- Tabs content -->
        <div class="tab-content">
            @include('admin.users')
			@include('admin.ships')
        </div>
    </div>
@endsection