@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="col-lg-3">
            <div class="valikot">
                <!-- Laivat laatikko -->
                <div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Laivat</h3>
                        </div>
                        <div class="panel-body">
                        <!-- TODO: Search button -->
                        <input id="laivatSearchBox" type="search" placeholder="Hae laiva"></input>
                            <select id="laivatListBox" size="8" name="laivat">
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Välilehdet laatikko -->
                <div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Välilehdet</h3>
                        </div>
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills nav-stacked" role="tablist">
                                <li class="active"><a href="#kartta" role="tab" data-toggle="tab">Kartta</a></li>
                                <li><a href="#miehistö" role="tab" data-toggle="tab">Miehistö</a></li>
                                <li><a href="#laivantiedot" role="tab" data-toggle="tab">Laivan tiedot</a></li>
                                <li><a href="#rahti" role="tab" data-toggle="tab">Rahti</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Kartta -välilehti -->
                <div class="tab-pane active" id="kartta">
                    <div class="col-lg-9">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Kartta</h3>
                            </div>
                            <div class="panel-body" id="map"></div>
                        </div>
                    </div>
                </div>
                <!-- Miehistö -välilehti -->
                <div class="tab-pane" id="miehistö">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Miehistö</h3>
                            </div>
                            <div class="panel-body miehistoTable">
                                <table class=table>
                                    <thead>
                                        <tr>
                                            <td></td>
                                            <th>Sotu</th>
                                            <th>Etunimi</th>
                                            <th>Sukunimi</th>
                                            <th>Tehtävä</th>
                                    </tr>
                                    </thead>
                                    <tbody id="miehistoTaulu">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Henkilötiedot</h3>
                            </div>
                            <div class="panel-body">
                                    <table id="Henkilotiedot" border="5" style="width: 100%">
                                    </table>
                            </div>
                        </div>
                        <div>
                            <!-- lisää henkilö modal -->
                            <!-- Modal -->
                            <div id="henkiloModal" class="modal fade" data-keyboard="false" data-backdrop="static" role="dialog">
                            	<div class="modal-dialog">
                            		<!-- Modal content-->
                            		<div class="modal-dialog modal-lg">
                            			<div class="modal-content">
                            				<div class="modal-header bg-success text-white" id="henkModalColor">
                            					<button type="button" class="close" data-dismiss="modal">&times;</button>
                            					<h4 class="modal-title" id="henkModalTitle"></h4>
                            				</div>
                            				<form id="henkiloFormi" action="sql.php" onsubmit="return validoiFormi()" method="POST" enctype="multipart/form-data">
                            					<input type="hidden" id="henkFormTyyppi" name="henkFormTyyppi" value="lisaa">
                            					<input type="hidden" id="henkLaiva" name="henkLaiva" value="">
                            					<div class="modal-body">
                            						<fieldset>
                            							<legend>Nimi ja sotu</legend>
                            							<div class="row">
                            								<div class="col-sm-4">
                            									<div class="form-group" id="divSotu">
                            										<label for="txtSotu">Sotu:</label>
                            										<input type="text" class="form-control" name="txtSotu" id="txtSotu" placeholder="010293-123A">
                            										<span id="helpSotu" class="help-block hidden"></span>
                            									</div>
                            								</div>
                            								<div class="col-sm-4">
                            									<div class="form-group" id="divEtunimi">
                            										<label for="txtEtunimi">Etunimi:</label>
                            										<input type="text" class="form-control" name="txtEtunimi" id="txtEtunimi" placeholder="Erkki">
                            										<span id="helpEtunimi" class="help-block hidden"></span>
                            									</div>
                            								</div>
                            								<div class="col-sm-4">
                            									<div class="form-group" id="divSukunimi">
                            										<label for="txtSukunimi">Sukunimi</label>
                            										<input type="text" class="form-control" name="txtSukunimi" id="txtSukunimi" placeholder="Esimerkki">
                            										<span id="helpSukunimi" class="help-block hidden"></span>
                            									</div>
                            								</div>
                            							</div>
                            							<legend>Postitiedot</legend>
                            							<div class="row">
                            								<div class="col-sm-4">
                            									<div class="form-group" id="divPostiosoite">
                            										<label for="txtPostiosoite">Postiosoite:</label>
                            										<input type="text" class="form-control" name="txtPostiosoite" id="txtPostiosoite" placeholder="Esimerkkikatu 25-27 A13">
                            										<span id="helpPostiosoite" class="help-block hidden"></span>
                            									</div>
                            								</div>
                            								<div class="col-sm-4">
                            									<div class="form-group" id="divPostinumero">
                            										<label for="txtPostinumero">Postinumero:</label>
                            										<input type="text" class="form-control" name="txtPostinumero" id="txtPostinumero" placeholder="65100">
                            										<span id="helpPostinumero" class="help-block hidden"></span>
                            									</div>
                            								</div>
                            								<div class="col-sm-4">
                            									<div class="form-group" id="divPaikkakunta">
                            										<label for="txtPaikkakunta">Paikkakunta:</label>
                            										<input type="text" class="form-control" name="txtPaikkakunta" id="txtPaikkakunta" placeholder="Vaasa">
                            										<span id="helpPaikkakunta" class="help-block hidden"></span>
                            									</div>
                            								</div>
                            							</div>
                            							<legend>Muut tiedot</legend>
                            							<div class="row">
                            								<div class="col-sm-4">
                            									<div class="form-group" id="divPuhelin">
                            										<label for="txtPuhelin">Puhelin:</label>
                            										<input type="text" class="form-control"  name="txtPuhelin" id="txtPuhelin" placeholder="0401234567">
                            										<span id="helpPuhelin" class="help-block hidden"></span>
                            									</div>
                            								</div>
                            								<div class="col-sm-4">
                            									<div class="form-group" id="divTitteli">
                            										<label for="txtTitteli">Titteli</label>
                            										<input type="text" class="form-control" name="txtTitteli" id="txtTitteli" placeholder="Titteli">
                            										<span id="helpTitteli" class="help-block hidden"></span>
                            									</div>
                            								</div>
                            								<div class="col-sm-4">
                            									<div class="form-group" id="divKuva">
                            										<label for="imgKuva">Kuva:</label>
                            										<input type="file" id="imgKuva" name="imgKuva">
                            										<span id="helpKuva" class="help-block hidden"></span>
                            									</div>
                            								</div>
                            							</div>
                            						</fieldset>
                            					</div>
                            					<div class="modal-footer">
                            						<button type="submit" id="btnSubmithenkilö" class="btn btn-success">Lisää henkilö</button>
                            						<button type="button" id="btnPeruutahenkilö" class="btn btn-default" data-dismiss="modal">Peruuta</button>
                            					</div>
                            				</form>
                            			</div>
                            		</div>
                            	</div>
                            </div>
                            <button type="button" class="btn btn-success" onclick="lisaaHenkilo()">Lisää henkilö</button>
                            <button type="button" class="btn btn-warning" onclick="muokkaaHenkilo()">Muokkaa henkilöä</button>
                            <button type="button" class="btn btn-danger" onclick="poistaHenk()">Poista henkilö</button>
                        </div>
                    </div>
                </div>
                <!-- Laivan tiedot -välilehti -->
                <div class="tab-pane" id="laivantiedot">
                    <!-- Yleistiedot,Sijainti,Suunta -->
                    <div class="col-lg-5">
                        <!-- Yleistiedot -laatikko -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Yleistiedot</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">Laivan nimi:</div>
                                    <div id="laivaNimi" class="col-md-6 text-right"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Laivan Tyyppi:</div>
                                    <div id="laivaTyyppi" class="col-md-6 text-right"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">MMSI:</div>
                                    <div id="laivaMMSI" class="col-md-6 text-right"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Pituus:</div>
                                    <div id="laivaPituus" class="col-md-6 text-right"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">Leveys:</div>
                                    <div id="laivaLeveys" class="col-md-4 text-right"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">Paino:</div>
                                    <div id="laivaPaino" class="col-md-4 text-right"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">Kuollut Paino:</div>
                                    <div id="laivaKuollutPaino" class="col-md-4 text-right"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Sijainti -laatikko -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Sijainti</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-2">Reitti:</div>
                                    <div id="laivaReitti" class="col-md-10 text-right"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Nort:</div>
                                    <div id="laivaNorth" class="col-md-6 text-right"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">East:</div>
                                    <div id="laivaEast" class="col-md-6 text-right"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Suunta -laatikko -->
                        <div id="suunta" class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Suunta</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row text-center">
                                    <!-- Kompassi -->
                                    <canvas id="compass" width="200" height="200"></canvas>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">Tarkka suunta:</div>
                                    <div id="laivanTarkkaSuunta" class="col-md-4 text-right"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Kartta -laatikko -->
                    <div class="col-lg-6">
                        <!-- Minimap -laatikko -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Kartta</h3>
                            </div>
                            <div class="panel-body" id="minimap"></div>
                        </div>
                    </div>
                </div>
                <!-- Rahti -välilehti -->
                <div class="tab-pane" id="rahti">
                    <div class="col-lg-12">
                        <!-- Minimap -laatikko -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Rahti</h3>
                            </div>
                            <div class="panel-body">
                                <table class=table>
                                    <thead>
                                        <tr>
                                            <td></td>
                                            <th>Barcode</th>
                                            <th>Sisältö</th>
                                        </tr>
                                    </thead>
                                    <tbody id="rahtitiedot">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            <div>
                                    <button type="button" class="btn btn-success" id="lisaaRahti">Lisää rahti</button>
                                    <button type="button" class="btn btn-warning" id="muokkaaRahti">Muokkaa rahtia</button>
                                    <button type="button" class="btn btn-danger" id="poistaRahti">Poista rahti</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="push"></div>
    </div>
@endsection