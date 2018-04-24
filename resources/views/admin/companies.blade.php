@extends('layouts.admin')

@section('title', 'Yhtiöt')

@section('admin-content')
    <div class="col-lg-12">
        <div class="tab-pane" id="users">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Yhtiöt</h3>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nimi</th>
                        <th>Osoite</th>
                        <th>Postikoodi</th>
                        <th>Kaupunki</th>
                        <th>Maa</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->Name }}</td>
                                <td>{{ $company->MailingAddress }}</td>
                                <td>{{ $company->ZipCode }}</td>
                                <td>{{ $company->City }}</td>
                                <td>{{ $company->Country ? $company->Country->Name : '-' }}</td>
                                <td>
                                    <!-- FIXME: Inline the buttons on small screens? -->
                                    <a href="{{ url('/admin/companies/edit/' . $company->ID) }}">
                                        <button type="button" class="btn btn-sm btn-warning">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                    </a>
                                    <a href="{{ url('/admin/companies/delete/' . $company->ID) }}">
                                        <button type="button" class="btn btn-sm btn-danger">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <a href="{{ url('/admin/companies/add') }}">
                    <button type="button" class="btn btn-success">Lisää yhtiö</button>
                </a>
            </div>
        </div>
    </div>
@endsection()
