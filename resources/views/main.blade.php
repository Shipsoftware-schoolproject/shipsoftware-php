@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/api.js') }}"></script>
    <script src="{{ asset('js/ship.js') }}"></script>
    <script src="{{ asset('js/map.js') }}"></script>
    <script src="{{ asset('js/mainpage.js') }}"></script>
@endsection

@section('content')
    <div class="col-lg-3">
        <!-- Ships box -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ trans_choice('ship.ship', 1) }}</h3>
                </div>
                <div class="panel-body">
                    <!-- TODO: Search button -->
                    <input id="shipSearch" class="search" type="search" placeholder="{{ trans('ship.find') }}" />
                    <select id="lstShips" class="listbox" size="8" name="laivat"></select>
                    <input id="lstShip_errormsg" type="hidden" value="{{ trans('ship.select_first') }}" />
                    <input class="btn btn-primary" type="button" onclick="shipDetails();" value="{{ trans('ship.show_info') }}" />
                </div>
            </div>
        </div>

        <!-- Companies box -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ trans_choice('companies.company', 1) }}</h3>
                </div>
                <div class="panel-body">
                    <!-- TODO: Search companies -->
                    <input id="searchCompanies" class="search" type="search" placeholder="{{ trans('companies.find') }}" />
                    <select id="lstCompanies" class="listbox" size="8" name="companies"></select>
                </div>
            </div>
        </div>
    </div>
    <!-- Map -->
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('misc.map') }}</h3>
            </div>
            <div class="panel-body" id="map"></div>
        </div>
    </div>
@endsection