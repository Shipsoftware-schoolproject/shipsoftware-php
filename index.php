<DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Shipsoftware</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link href="./css/custom.css" rel="stylesheet">
        <script src="./js/compass.js"></script>
    </head>
    <body>
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="./">Shipsoftware</a><br>
				</div>
			</div>
		</nav>
        <div class="container">
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
								<input id="laivatSearchBox" type="textbox" placeholder="Hae laiva"></input>
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
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#henkiloModal" id="btnlisaaHenkilo">Lisää henkilö</button>
									<?php include 'modal.php'; ?>
									<button type="button" class="btn btn-warning" id="muokkaaHenkilo">Muokkaa henkilöä</button>
									<button type="button" class="btn btn-danger" id="poistaHenkilo">Poista henkilö</button>
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
		</div>
		<footer class="footer">
            <div class="container">
				<p>&#169; Shipsoftware</p>
			</div>
		</footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="./js/custom.js"></script>
		<script>
			var map, miniMap;
			var markers = new Array();

			function initMap() {
				var mapOptions = {
					center: { lat: 63.1022601, lng: 21.5809185 },
					zoom: 8,
					streetViewControl: false
				};

				map = new google.maps.Map(document.getElementById('map'), mapOptions);
			}

			function addMarker(ShipID, sijainti, otsikko, infoIkkuna) {
				var marker = new google.maps.Marker({
					position: sijainti,
					map: map,
					title: otsikko
				});
				markers.push({ ShipID: ShipID, Marker: marker, InfoIkkuna: infoIkkuna });

				google.maps.event.addListener(marker, 'click', function() {
					infoIkkuna.open(map, marker);
				});
			}
		</script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyAK8bzrVV9-fH72e3jyXSSjsWkW5bpduok&callback=initMap"></script>
		<script type="text/javascript">
            // Init kompassi
            $(document).ready(function() {
                draw(0);
            })

            haeLaivat();

            var henkiloFormi = $('#henkiloFormi');
            henkiloFormi.submit(function(ev) {
            	$.ajax({
            		type: henkiloFormi.attr('method'),
            		url: henkiloFormi.attr('action'),
            		data: henkiloFormi.serialize(),
            		success: function(data) {
            			alert('ok');
            		}
            	});

            	ev.preventDefault();
            });
        </script>
    </body>
</html>
