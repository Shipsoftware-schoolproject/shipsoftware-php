@extends('layouts.admin')

@section('title', $type)

@section('admin-content')
<div class="col-lg-10">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $type }}</h3>
        </div>
        <form id="userForm" action="{{ url('/admin/ships/' . $form_action) }}" method="POST" autocomplete="off">
            {{ csrf_field() }}
            <div class=panel-body" style="padding-top: 1em; padding-left: 1.5em;">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group @if ($errors->has('ShipName')) has-error @endif">
                            <label class="control-label" for="ShipName">Ship Name:</label>
                            <input type="text" class="form-control" name="ShipName" id="ShipName" placeholder="M/S Wasa Express" value="{{ old('ShipName') ? old('ShipName') : $ship->ShipName }}">
                            @if ($errors->has('ShipName'))
                                <span id="helpShipName" class="help-block">
                                    {{ $errors->first('ShipName') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group @if ($errors->has('CompanyID')) has-error @endif">
                            <label class="control-label" for="CompanyID">Company:</label>
                            <select id="CompanyID" name="CompanyID" class="form-control">
                                <option value=""></option>
                                @foreach($companies as $company)
                                    @if (old('CompanyID') == $company->ID || $ship->CompanyID == $company->ID)
                                        <option value="{{ $company->ID }}" selected="selected">{{ $company->Name }}</option>
                                    @else
                                        <option value="{{ $company->ID }}">{{ $company->Name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('CompanyID'))
                                <span id="helpCompanyID" class="help-block">
                                {{ $errors->first('CompanyID') }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group @if ($errors->has('IMO')) has-error @endif">
                            <label class="control-label" for="IMO">IMO:</label>
                            <input type="text" class="form-control" name="IMO" id="IMO" placeholder="8000226" value="{{ old('IMO') ? old('IMO') : $ship->IMO }}">
                            @if ($errors->has('IMO'))
                                <span id="helpIMO" class="help-block">
                                    {{ $errors->first('IMO') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group @if ($errors->has('MMSI')) has-error @endif">
                            <label class="control-label" for="MMSI">MMSI:</label>
                            <input type="text" class="form-control" name="MMSI" id="MMSI" placeholder="230636000" value="{{ old('MMSI') ? old('MMSI') : $ship->MMSI }}">
                            @if ($errors->has('MMSI'))
                                <span id="helpMMSI" class="help-block">
                                    {{ $errors->first('MMSI') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group @if ($errors->has('TypeID')) has-error @endif">
                            <label class="control-label" for="TypeID">Tyyppi:</label>
                            <select id="TypeID" name="TypeID" class="form-control">
                                <option value=""></option>
                                @foreach($types as $type)
                                    @if (old('TypeID') == $type->ID || $ship->TypeID == $type->ID)
                                        <option value="{{ $type->ID }}" selected="selected">{{ $type->Name }}</option>
                                    @else
                                        <option value="{{ $type->ID }}">{{ $type->Name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('TypeID'))
                                <span id="helpTypeID" class="help-block">
                                {{ $errors->first('TypeID') }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group @if ($errors->has('CommentText')) has-error @endif">
                            <label class="control-label" for="CommentText">Kommentti:</label>
                            <input type="text" class="form-control" name="CommentText" id="CommentText" placeholder="APRS comment or AIS destination" value="{{ old('CommentText') ? old('CommentText') : $ship->CommentText }}">
                            @if ($errors->has('CommentText'))
                                <span id="helpCommentText" class="help-block">
                                    {{ $errors->first('CommentText') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group @if ($errors->has('ShipLength')) has-error @endif">
                            <label class="control-label" for="ShipLength">Length:</label>
                            <input type="text" class="form-control" name="ShipLength" id="ShipLength" placeholder="141.00" value="{{ old('ShipLength') ? old('ShipLength') : $ship->ShipLength }}">
                            @if ($errors->has('ShipLength'))
                                <span id="helpShipLength" class="help-block">
                                    {{ $errors->first('ShipLength') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group @if ($errors->has('Width')) has-error @endif">
                            <label class="control-label" for="Width">Width:</label>
                            <input type="text" class="form-control" name="Width" id="Width" placeholder="22.81" value="{{ old('Width') ? old('Width') : $ship->Width }}">
                            @if ($errors->has('Width'))
                                <span id="helpWidth" class="help-block">
                                    {{ $errors->first('Width') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group @if ($errors->has('Draught')) has-error @endif">
                            <label class="control-label" for="Draught">Draught:</label>
                            <input type="text" class="form-control" name="Draught" id="Draught" placeholder="4.95" value="{{ old('Draught') ? old('Draught') : $ship->Draught }}">
                            @if ($errors->has('Draught'))
                                <span id="helpDraught" class="help-block">
                                        {{ $errors->first('Draught') }}
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group @if ($errors->has('RefFront')) has-error @endif">
                            <label class="control-label" for="RefFront">RefFront:</label>
                            <input type="text" class="form-control" name="RefFront" id="RefFront" placeholder="" value="{{ old('RefFront') ? old('RefFront') : $ship->RefFront }}">
                            @if ($errors->has('RefFront'))
                                <span id="helpRefFront" class="help-block">
                                        {{ $errors->first('RefFront') }}
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group @if ($errors->has('RefLeft')) has-error @endif">
                            <label class="control-label" for="RefLeft">RefLeft:</label>
                            <input type="text" class="form-control" name="RefLeft" id="RefLeft" placeholder="" value="{{ old('RefLeft') ? old('RefLeft') : $ship->RefLeft }}">
                            @if ($errors->has('RefLeft'))
                                <span id="helpRefLeft" class="help-block">
                                        {{ $errors->first('RefLeft') }}
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <span class="pull-right">
                    <a href="{{ url('/admin/ships') }}">
                        <button type="button" class="btn btn-danger">Peruuta</button>
                    </a>
                    <a href="{{ url('/admin/ships/add') }}">
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
