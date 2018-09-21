@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>
@endsection()

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js" integrity="sha512-tAGcCfR4Sc5ZP5ZoVz0quoZDYX5aCtEm/eu1KhSLj2c9eFrylXZknQYmxUssFaVJKvvc0dJQixhGjG2yXWiV9Q==" crossorigin=""></script>
    <script src="{{ asset('js/map.js') }}"></script>
    <script src="{{ asset('js/mainpage.js') }}"></script>
    <script>
        $(document).ready(function() {
            initMap();
            @foreach($ships as $ship)
                @if($ship->latestGps)
                    addMarker('{{ $ship->ShipName }}', {{ $ship->IMO }}, {{ $ship->latestGps->Lat }}, {{ $ship->latestGps->Lng }}, '{{ $ship->latestGps->UpdatedTime }}');
                @else
                    addMarker('{{ $ship->ShipName }}', {{ $ship->IMO }}, 0, 0, 0);
                @endif
            @endforeach
        });
    </script>
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
                    @if ($ships)
                        <select id="lstShips" class="listbox" size="8" name="laivat">
                            @foreach ($ships as $ship)
                                <option value="{{ $ship->IMO }}">{{ $ship->ShipName }}</option>
                            @endforeach
                        </select>
                    @else
                        <span>Ei laivoja</span>
                    @endif
                    <input id="lstShip_errormsg" type="hidden" value="{{ trans('ship.select_first') }}" />
                    <input class="btn btn-primary" type="button" onclick="shipDetails();" value="{{ trans('ship.show_info') }}" />
                </div>
            </div>
        </div>

        @if (Auth::user()->isAdmin())
            <!-- Companies box -->
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans_choice('companies.company', 1) }}</h3>
                    </div>
                    <div class="panel-body">
                        <!-- TODO: Search companies -->
                        <input id="searchCompanies" class="search" type="search" placeholder="{{ trans('companies.find') }}" />
                        @if ($companies)
                            <select id="lstCompanies" class="listbox" size="8" name="companies">
                                @foreach ($companies as $company)
                                    <option value="{{ $company->ID }}">{{ $company->Name }}</option>
                                @endforeach
                            </select>
                        @else
                            <span>Ei yhtiöitä</span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
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
