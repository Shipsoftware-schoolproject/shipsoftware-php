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
                        <tr>
                            <td>{{ $user->FirstName }}</td>
                            <td>{{ $user->LastName }}</td>
                            <td>{{ $user->Email }}</td>
                            <td>{{ $user->role ? $user->role->Name : '-' }}</td>
                            <td>{{ $user->company ? $user->company->Name : '-' }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" onclick="editUser({{ $user->ID }});">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteUser({{ $user->ID }});">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <button type="button" class="btn btn-success" onclick="addUser();">Lisää käyttäjä</button>
        </div>
    </div>
</div>

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="userModalTitle"></h4>
            </div>
            <form id="userForm" action="{{ url('api/user') }}" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="firstName">Etunimi:</label>
                                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Erkki">
                                <span id="helpFirstName" class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="lastName">Sukunimi:</label>
                                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Esimerkki">
                                <span id="helpLastName" class="help-block hidden"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="phoneNumber">Puhelinnumero:</label>
                                <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="0401234567">
                                <span id="helpPhoneNumber" class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="erkki.esimerkki@example.com">
                                <span id="helpEmail" class="help-block hidden"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="username">Käyttäjänimi:</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="eres">
                                <span id="helpUsername" class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <label for="password">Salasana:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default">Generoi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="userPicture">Kuva:</label>
                                <!-- FIXME: Find good default picture and show
                                            that if user doesn't have a profile
                                            picture
                                -->
                                <img style="width: 100%;" src="" id="userPicture">
                                <input type="file" style="padding-top: 1em;" id="picture" name="picture">
                                <span id="helpPicture" class="help-block hidden"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="role">Rooli:</label>
                                <select id="role" class="form-control">
                                    <option value=""></option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->ID }}">{{ $role->Name }}</option>
                                    @endforeach
                                </select>
                                <span id="helpRole" class="help-block hidden"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="company">Yhtiö:</label>
                                <select id="company" class="form-control">
                                    <option value=""></option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->ID }}">{{ $company->Name }}</option>
                                    @endforeach
                                </select>
                                <span id="helpCompany" class="help-block hidden"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sulje</button>
                    <button id="userSubmit" type="submit" class="btn btn-primary">Tallenna</button>
                </div>
            </form>
        </div>
    </div>
</div>