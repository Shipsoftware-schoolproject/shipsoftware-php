@extends('layouts.app')

@section('scripts')
    <script async defer src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyAK8bzrVV9-fH72e3jyXSSjsWkW5bpduok&callback=initMap"></script>
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
                    @if ($ships)
                        <select id="lstShips" class="listbox" size="8" name="laivat">
                            @foreach ($ships as $ship)
                                @if ($ship->latestGps)
                                    <option value="{{ $ship->IMO }}" data-lat="{{ $ship->latestGps->Lat }}" data-lng="{{ $ship->latestGps->Lng }}" data-updated="{{ $ship->latestGps->UpdatedTime }}">{{ $ship->ShipName }}</option>
                                @else
                                    <option value="{{ $ship->IMO }}" data-lat="0" data-lng="0" data-updated="0">{{ $ship->ShipName }}</option>
                                @endif
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
