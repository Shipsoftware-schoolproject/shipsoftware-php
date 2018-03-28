@extends('layouts.app')

@section('content')
<head>
  <meta charset="UTF-8">
</head> 
    <div class="col-lg-3">
        <!-- Tabs box -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('ship.tabs') }}</h3>
            </div>
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-stacked" role="tablist">
                    <li class="active"><a href="#shipinfo" role="tab" data-toggle="tab">{{ trans('ship.info') }}</a></li>
					<li><a href="#editship" role="tab" data-toggle="tab">Laivat</a></li>
                    <li><a href="#editcrew" role="tab" data-toggle="tab">Miehistö</a></li>
                    <li><a href="#editcargo" role="tab" data-toggle="tab">Rahti</a></li>
					<li><a href="#editcompany" role="tab" data-toggle="tab">Yhtiö</a></li>
                </ul>
            </div>
        </div>
        <a href="{{ url('/') }}"><input class="btn btn-primary" type="button" value="{{ trans('misc.back_to_map') }}" /></a>
    </div>
@endsection