@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/map.js') }}"></script>
    <script src="{{ asset('js/compass.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            @if(isset($ship->Course))
                compass_init({{ $ship->Course }});
            @else
                compass_init();
            @endif
        });
    </script>
@endsection

@section('content')
    <div class="col-lg-3">
        <!-- Tabs box -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('ship.tabs') }}</h3>
            </div>
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-stacked" role="tablist">
                    <li class="active"><a href="#shipinfo" role="tab" data-toggle="tab">{{ trans('ship.info') }}</a></li>
                    <li><a href="#miehistö" role="tab" data-toggle="tab">Miehistö</a></li>
                    <li><a href="#rahti" role="tab" data-toggle="tab">Rahti</a></li>
                </ul>
            </div>
        </div>
        <a href="{{ url('/') }}"><input class="btn btn-primary" type="button" value="{{ trans('misc.back_to_map') }}" /></a>
    </div>
    <div class="col-lg-9">
        <!-- Tabs content -->
        <div class="tab-content">
            <!-- Ship info tab -->
            <div class="tab-pane active" id="shipinfo">
                <!-- General info, location, course, etc. -->
                <div class="col-lg-5">
                    <!-- General info box -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('ship.general_info') }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">{{ trans('ship.name') }}:</div>
                                <div id="name" class="col-md-6 text-right">
                                    @if(isset($ship->ShipName))
                                        {{ $ship->ShipName }}
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">{{ trans('ship.type') }}:</div>
                                <div id="type" class="col-md-6 text-right">
                                    @if(isset($ship->Type))
                                        {{ $ship->Type }}
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">MMSI:</div>
                                <div id="mmsi" class="col-md-6 text-right">
                                    @if(isset($ship->MMSI))
                                        {{ $ship->MMSI }}
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">{{ trans_choice('companies.company', 0) }}:</div>
                                <div id="type" class="col-md-6 text-right">
                                    @if(isset($ship->Company))
                                        {{ $ship->Company }}
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">{{ trans('ship.length') }}:</div>
                                <div id="length" class="col-md-6 text-right">
                                    @if(isset($ship->ShipLength))
                                        {{ $ship->ShipLength }}
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">{{ trans('ship.width') }}:</div>
                                <div id="width" class="col-md-4 text-right">
                                    @if(isset($ship->Width))
                                        {{ $ship->Width }}
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">{{ trans('ship.draught') }}:</div>
                                <div id="width" class="col-md-4 text-right">
                                    @if(isset($ship->Draught))
                                        {{ $ship->Draught }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Location box -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('ship.location') }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-2">{{ trans('ship.comment') }}:</div>
                                <div id="comment" class="col-md-10 text-right">
                                    @if(isset($ship->CommentText))
                                        {{ $ship->CommentText }}
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">{{ trans('ship.lat') }}:</div>
                                <div id="lat" class="col-md-6 text-right">
                                    @if(isset($gps->Lat))
                                        {{ $gps->Lat }}
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">{{ trans('ship.lng') }}:</div>
                                <div id="lng" class="col-md-6 text-right">
                                    @if(isset($gps->Lng))
                                        {{ $gps->Lng }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Course -->
                    <div id="course" class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('ship.course') }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row text-center">
                                <!-- Compass -->
                                <canvas id="compass" width="200" height="200"></canvas>
                            </div>
                            <div class="row">
                                <div class="col-md-8">{{ trans('ship.precise_course') }}:</div>
                                <div id="precise_course" class="col-md-4 text-right">
                                    @if(isset($ship->Course))
                                        {{ $ship->Course }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Map box -->
                <div class="col-lg-7">
                    <!-- Minimap box -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('misc.map') }}</h3>
                        </div>
                        <div class="panel-body" id="map"></div>
                    </div>
                </div>
            </div>

            <!-- FIXME: Implementations etc. -->
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
@endsection
