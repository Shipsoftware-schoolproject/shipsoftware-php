@extends('layouts.admin')

@section('title', $type . 'käyttäjä')

@section('admin-content')
<div class="col-lg-10">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $type }} käyttäjä</h3>
        </div>
        <form id="userForm" action="{{ $form_action }}" enctype="multipart/form-data" method="POST" autocomplete="off">
            {{ csrf_field() }}
            <div class=panel-body" style="padding-top: 1em; padding-left: 1.5em;">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group @if ($errors->has('FirstName')) has-error @endif">
                            <label class="control-label" for="FirstName">Etunimi:</label>
                            <input type="text" class="form-control" name="FirstName" id="FirstName" placeholder="Erkki" value="{{ $user->FirstName }}">
                            @if ($errors->has('FirstName'))
                                <span id="helpFirstName" class="help-block">
                                    {{ $errors->first('FirstName') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group @if ($errors->has('LastName')) has-error @endif">
                            <label class="control-label" for="LastName">Sukunimi:</label>
                            <input type="text" class="form-control" name="LastName" id="LastName" placeholder="Esimerkki" value="{{ $user->LastName }}">
                            @if ($errors->has('LastName'))
                                <span id="helpLastName" class="help-block">
                                    {{ $errors->first('LastName') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group @if ($errors->has('Phone')) has-error @endif">
                            <label class="control-label" for="Phone">Puhelinnumero:</label>
                            <input type="text" class="form-control" name="Phone" id="Phone" placeholder="0401234567" value="{{ $user->Phone }}">
                            @if ($errors->has('Phone'))
                                <span id="helpPhone" class="help-block">
                                    {{ $errors->first('Phone') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group @if ($errors->has('Email')) has-error @endif">
                            <label class="control-label" for="Email">Email:</label>
                            <input type="text" class="form-control" name="Email" id="Email" placeholder="erkki.esimerkki@example.com" value="{{ $user->Email }}">
                            @if ($errors->has('Email'))
                                <span id="helpEmail" class="help-block">
                                    {{ $errors->first('Email') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group @if ($errors->has('Username')) has-error @endif">
                            <label class="control-label" for="Username">Käyttäjänimi:</label>
                            <input type="text" class="form-control" name="Username" id="Username" placeholder="eres" value="{{ $user->Username }}">
                            @if ($errors->has('Username'))
                                <span id="helpUsername" class="help-block">
                                    {{ $errors->first('Username') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-1"><!-- padding --></div>
                    <div class="col-sm-6">
                        <div @if($errors->has('Password')) class="has-error" @endif>
                            <label class="control-label" for="Password">Salasana:</label>
                            <div class="input-group @if ($errors->has('Password')) has-error @endif">
                                <input type="password" class="form-control" name="Password" id="Password">
                                <span class="input-group-btn">
                                    <!-- TODO: Implement password generator -->
                                    <button type="button" class="btn @if ($errors->has('Password')) btn-danger @else btn-default @endif">Generoi</button>
                                </span>
                            </div>
                            @if ($errors->has('Password'))
                                <span id="helpPassword" class="help-block">
                                    {{ $errors->first('Password') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group @if ($errors->has('Picture')) has-error @endif">
                            <label class="control-label" for="userPicture">Kuva:</label>
                            <!-- FIXME: Find good default Picture and show
                                        that if user doesn't have a profile
                                        picture
                            -->
                            <img style="width: 100%;" src="" id="userPicture">
                            <input type="file" style="padding-top: 1em;" id="Picture" name="Picture">
                            @if ($errors->has('Picture'))
                                <span id="helpPicture" class="help-block">
                                    {{ $errors->first('Picture') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group @if ($errors->has('RoleID')) has-error @endif">
                            <label class="control-label" for="RoleID">Rooli:</label>
                            <select id="RoleID" name="RoleID" class="form-control">
                                <option value=""></option>
                                @foreach($roles as $role)
                                    @if (Request::old('RoleID') == $role->ID || $user->RoleID == $role->ID)
                                        <option value="{{ $role->ID }}" selected="selected">{{ $role->Name }}</option>
                                    @else
                                        <option value="{{ $role->ID }}">{{ $role->Name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('RoleID'))
                                <span id="helpRoleID" class="help-block">
                                    {{ $errors->first('RoleID') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group @if ($errors->has('CompanyID')) has-error @endif">
                            <label class="control-label" for="CompanyID">Yhtiö:</label>
                            <select id="CompanyID" name="CompanyID" class="form-control">
                                <option value=""></option>
                                @foreach($companies as $company)
                                    @if (Request::old('CompanyID') == $company->ID || $user->Company == $company->ID)
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
            </div>
            <div class="panel-footer">
                <span class="pull-right">
                    <a href="{{ url('/admin/users') }}">
                        <button type="button" class="btn btn-danger">Peruuta</button>
                    </a>
                    <a href="{{ url('/admin/users/add') }}">
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
