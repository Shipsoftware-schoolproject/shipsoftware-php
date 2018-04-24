@extends('layouts.admin')

@section('title', 'Laivat')

@section('admin-content')
<div class="tab-pane active" id="ships">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Laivat</h3>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>IMO</th>
                    <th>MMSI</th>
                    <th>Name</th>
                    <th>Tyyppi</th>
                    <th>Yhtiö</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($ships as $ship)
						<tr>
                        <td>{{ $ship->IMO }}</td>
                        <td>{{ $ship->MMSI }}</td>
                        <td>{{ $ship->ShipName }}</td>
                        <td>{{ $ship->type->Name }}</td>
                        <td>{{ $ship->company ? $ship->company->Name : '-' }}</td>
                        <td>
                            <a href="{{ url('/admin/ships/edit/' . $ship->IMO) }}">
                                <button type="button" class="btn btn-sm btn-warning">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                            </a>
                            <a href="{{ url('/admin/ships/delete/' . $ship->IMO) }}">
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
            <a href="/admin/ships/add">
                <button type="button" class="btn btn-success">Lisää laiva</button>
            </a>
        </div>
    </div>
</div>
@endsection
