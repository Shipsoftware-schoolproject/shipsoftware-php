<div class="tab-pane" id="users">
    <div class="col-lg-12">
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
                        <td>{{ $user->FirstName }}</td>
                        <td>{{ $user->LastName }}</td>
                        <td>{{ $user->Email }}</td>
                        <td>{{ $user->role ? $user->role->Name : '-' }}</td>
                        <td>{{ $user->company ? $user->company->Name : '-' }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <button type="button" class="btn btn-success" id="addUser">Lisää käyttäjä</button>
            <button type="button" class="btn btn-warning" id="editUser">Muokkaa käyttäjää</button>
            <button type="button" class="btn btn-danger" id="deleteUser">Poista käyttäjä</button>
        </div>
    </div>
</div>