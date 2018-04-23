@extends('layouts.admin')

@section('title', 'Users')

@section('admin-content')
    <div class="col-lg-12">
        <div class="tab-pane" id="users">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Käyttäjät</h3>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Etunimi</th>
                        <th>Sukunimi</th>
                        <th>Email</th>
                        <th>Rooli</th>
                        <th>Yhtiö</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->FirstName }}</td>
                                <td>{{ $user->LastName }}</td>
                                <td>{{ $user->Email }}</td>
                                <td>{{ $user->role ? $user->role->Name : '-' }}</td>
                                <td>{{ $user->company ? $user->company->Name : '-' }}</td>
                                <td>
                                    <!-- FIXME: Inline the buttons on small screens? -->
                                    <button type="button" class="btn btn-sm btn-warning">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <a href="{{ url('/admin/users/add') }}">
                    <button type="button" class="btn btn-success">Lisää käyttäjä</button>
                </a>
            </div>
        </div>
    </div>
@endsection()