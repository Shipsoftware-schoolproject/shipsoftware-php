<!DOCTYPE html>
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
		<script src="./js/custom.js"></script>
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
								<input class="laivatSearchBox" type="textbox" placeholder="Hae laiva"></input>
									<select class="laivatListBox" size="8" name="laivat">
										<option>Titanic</option>
										<option>USS Manhattan</option>
										<option>HMN Afrika's starliner</option>
										<option>USS Enterprise</option>
										<option>Navetta</option>
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
									<div class="panel-body"><img src="http://opinnot.internetix.fi/fi/muikku2materiaalit/peruskoulu/ge/ge3/1_suomen_karttakuva/01/fi_embedded/yleiskartta.jpg" width="555" height="555"></img></div>
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
													<th>ID</th>
													<th>Etunimi</th>
													<th>Sukunimi</th>
													<th>Tehtävä</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope=row>4341</th>
													<td>Mark</td>
													<td>Otto</td>
													<td>Mosa</td>
												</tr>
												<tr>
													<th scope=row>23</th>
													<td>Jacob</td>
													<td>Thornton</td>
													<td>Kapteeni</td>
												</tr>
												<tr>
													<th scope=row>786</th>
													<td>Larry</td>
													<td>the Bird</td>
													<td>Perämies</td>
												</tr>
												<tr>
													<th scope=row>786</th>
													<td>Larry</td>
													<td>the Bird</td>
													<td>Perämies</td>
												</tr>
												<tr>
													<th scope=row>786</th>
													<td>Larry</td>
													<td>the Bird</td>
													<td>Perämies</td>
												</tr>
												<tr>
													<th scope=row>786</th>
													<td>Larry</td>
													<td>the Bird</td>
													<td>Perämies</td>
												</tr>
												<tr>
													<th scope=row>786</th>
													<td>Larry</td>
													<td>the Bird</td>
													<td>Perämies</td>
												</tr>
												<tr>
													<th scope=row>786</th>
													<td>Larry</td>
													<td>the Bird</td>
													<td>Perämies</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Henkilötiedot</h3>
									</div>
									<div class="panel-body">
										<div class="col-lg-2">
										</div>
										<div class="col-lg-2">
											<table border="5">

												<tr>
													<th><h4>Kuva</h4></th>
													<th>Nimi</th>
													<th>Sotu</th>
													<th>Kotiosoite</th>
												</tr>
												<tr>
													<td><img src="http://vignette3.wikia.nocookie.net/pirates/images/f/f0/OSTJackSmileCropped.jpg/revision/latest/scale-to-width-down/300?cb=20121116204603" width="120"></img></td>
													<td>Jack Sparrow</td>
													<td>000000001</td>
													<td>
														<table>
															<tr>
																<th>Postiosoite</th>
																<th>Kaupunki</th>
																<th>Postinumero</th>
															</tr>
															<tr>
																<td>Kapteeninkatu 1</td>
																<td>Barmuda</td>
																<td>65600</td>
															</tr>
														</table>
													</td>
												</tr>
												

											</table>
										</div>
										<div class="col-lg-10">
											
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Laivan tiedot -välilehti -->
						<div class="tab-pane" id="laivantiedot">
							<div class="col-lg-4">
								<!-- Yleistiedot -laatikko -->
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Yleistiedot</h3>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-8">Pituus:</div>
											<div id="laivaPituus" class="col-md-4 text-right">10 m</div>
										</div>
										<div class="row">
											<div class="col-md-8">Leveys:</div>
											<div id="laivaLeveys" class="col-md-4 text-right">3 m</div>
										</div>
										<div class="row">
											<div class="col-md-8">Paino:</div>
											<div id="laivaPaino" class="col-md-4 text-right">1 T</div>
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
											<div class="col-md-6">Nort:</div>
											<div id="laivaNorth" class="col-md-6 text-right">63.088206</div>
										</div>
										<div class="row">
											<div class="col-md-6">West:</div>
											<div id="laivaWest" class="col-md-6 text-right">21.545583</div>
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
											<div id="laivanTarkkaSuunta" class="col-md-4 text-right">180</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<!-- Minimap -laatikko -->
								<div id="minimap" class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Kartta</h3>
									</div>
									<div class="panel-body">
										<div class="row text-center">
											<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRiORqRxh4O8f_EdLxSbqGVqElPh6I4qIP86sRBiinS5-hp4pBCCw" width="355" height="355"></img>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Rahti -välilehti -->
						<div class="tab-pane" id="rahti">
							<div class="col-lg-12">
								<!-- Minimap -laatikko -->
								<div id="minimap" class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Rahti</h3>
									</div>
									<div class="panel-body">
										<table class=table>
											<thead>
												<tr>
													<th>Barcode</th>
													<th>Sisältö</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope=row>106141410123456786</th>
													<td>Tietokoneen komponentteja</td>
												</tr>
												<tr>
													<th scope=row>9347001000013</th>
													<td>Eletroniikkaa</td>
												</tr>
												<tr>
													<th scope=row>927710174</th>
													<td>Electrolux:n jääkaappeja</td>
												</tr>
											</tbody>
										</table>
									</div>
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
        <script type="text/javascript">
            // Init kompassi
            $(document).ready(function() {
                draw(0);
            })

            // Nappaa suunta "laivanTarkkaSuunta" div:n tekstistä
            $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
                if($('.nav-stacked .active > a').attr('href') == "#laivantiedot") {
                    draw($('#laivanTarkkaSuunta').text());
                }
            })
        </script>
    </body>
</html>
