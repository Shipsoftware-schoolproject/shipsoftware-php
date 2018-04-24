@extends('layouts.admin')

@section('title', $type)

@section('admin-content')
<div class="col-lg-10">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $type }}</h3>
        </div>
        <form id="userForm" action="{{ url('/admin/companies/' . $form_action) }}" enctype="multipart/form-data" method="POST" autocomplete="off">
            {{ csrf_field() }}
            <div class=panel-body" style="padding-top: 1em; padding-left: 1.5em;">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group @if ($errors->has('Name')) has-error @endif">
                            <label class="control-label" for="Name">Nimi:</label>
                            <input type="text" class="form-control" name="Name" id="Name" placeholder="Shipsoftware" value="{{ old('Name') ? old('Name') : $company->Name }}">
                            @if ($errors->has('Name'))
                                <span id="helpName" class="help-block">
                                    {{ $errors->first('Name') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group @if ($errors->has('MailingAddress')) has-error @endif">
                            <label class="control-label" for="MailingAddress">Postiosoite:</label>
                            <input type="text" class="form-control" name="MailingAddress" id="MailingAddress" placeholder="Esimerkkitie 1" value="{{ old('MailingAddress') ? old('MailingAddress') : $company->MailingAddress }}">
                            @if ($errors->has('MailingAddress'))
                                <span id="helpMailingAddress" class="help-block">
                                    {{ $errors->first('MailingAddress') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group @if ($errors->has('ZipCode')) has-error @endif">
                            <label class="control-label" for="ZipCode">Postikoodi:</label>
                            <input type="text" class="form-control" name="ZipCode" id="ZipCode" placeholder="01000" value="{{ old('ZipCode') ? old('ZipCode') : $company->ZipCode }}">
                            @if ($errors->has('ZipCode'))
                                <span id="helpZipCode" class="help-block">
                                    {{ $errors->first('ZipCode') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group @if ($errors->has('City')) has-error @endif">
                            <label class="control-label" for="City">Kaupunki:</label>
                            <input type="text" class="form-control" name="City" id="City" placeholder="Vaasa" value="{{ old('City') ? old('City') : $company->City }}">
                            @if ($errors->has('City'))
                                <span id="helpCity" class="help-block">
                                    {{ $errors->first('City') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group @if ($errors->has('CountryID')) has-error @endif">
                            <label class="control-label" for="Country">Maa:</label>
                            <select id="CountryID" name="CountryID" class="form-control">
                                <option></option>
                                @foreach($countries as $country)
                                    @if (old('CountryID') == $country->ID || $company->CountryID == $country->ID)
                                        <option value="{{ $country->ID }}" selected="selected">{{ $country->Name }}</option>
                                    @else
                                        <option value="{{ $country->ID }}">{{ $country->Name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('CountryID'))
                                <span id="helpCountryID" class="help-block">
                                    {{ $errors->first('CountryID') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <span class="pull-right">
                    <a href="{{ url('/admin/companies') }}">
                        <button type="button" class="btn btn-danger">Peruuta</button>
                    </a>
                    <a href="{{ url('/admin/companies/add') }}">
                        <button type="button" class="btn btn-warning">Tyhjennä</button>
                    </a>
                    <button id="userSubmit" type="submit" class="btn btn-success">Tallenna</button>
                </span>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>
</div>
@endsection()
