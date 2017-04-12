<!-- Modal -->
<div id="henkiloModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-success text-white" id="henkModalColor">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" id="henkModalTitle"></h4>
				</div>
				<form action="sql.php?lisaaHenkilo=1" onsubmit="return validoiFormi()" method="POST">
					<div class="modal-body">
						<fieldset>
							<legend>Nimi ja sotu</legend>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group" id="divSotu">
										<label for="lblSotu">Sotu:</label>
										<input type="text" class="form-control" id="txtSotu" placeholder="010293-123A">
										<span id="sotuHelp" class="help-block hidden"></span>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group" id="divEtunimi">
										<label for="lblEtuniumi">Etunimi:</label>
										<input type="text" class="form-control" id="txtEtunimi" placeholder="Erkki">
										<span id="etunimiHelp" class="help-block hidden"></span>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group" id="divSukunimi">
										<label for="lblSukunimi">Sukunimi</label>
										<input type="text" class="form-control" id="txtSukunimi" placeholder="Esimerkki">
										<span id="sukunimiHelp" class="help-block hidden"></span>
									</div>
								</div>
							</div>
							<legend>Postitiedot</legend>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group" id="divPostiosoite">
										<label for="lblPostiosoite">Postiosoite:</label>
										<input type="text" class="form-control" id="txtPostiosoite" placeholder="Esimerkkikatu 25-27 A13">
										<span id="postiosoiteHelp" class="help-block hidden"></span>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group" id="divPostinumero">
										<label for="lblPostinumero">Postinumero:</label>
										<input type="text" class="form-control" id="txtPostinumero" placeholder="65100">
										<span id="postinumeroHelp" class="help-block hidden"></span>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group" id="divPaikkakunta">
										<label for="lblPaikkakunta">Paikkakunta:</label>
										<input type="text" class="form-control" id="txtPaikkakunta" placeholder="Vaasa">
										<span id="paikkakuntaHelp" class="help-block hidden"></span>
									</div>
								</div>
							</div>
							<legend>Muut tiedot</legend>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group" id="divPuhelin">
										<label for="lblPuhelin">Puhelin:</label>
										<input type="text" class="form-control" id="txtPuhelin" placeholder="0401234567">
										<span id="puhelinHelp" class="help-block hidden"></span>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group" id="divTitteli">
										<label for="txtTitteli">Titteli</label>
										<input type="text" class="form-control" id="txtPuhelin" placeholder="Titteli">
										<span id="titteliHelp" class="help-block hidden"></span>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group" id="divKuva">
										<label for="lblKuva">Kuva:</label>
										<input type="file" id="imgKuva" name="myimage">
										<span id="kuvaHelp" class="help-block hidden"></span>
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="modal-footer">
						<button type="submit" id="btnSubmithekilö" class="btn btn-success" id="henkNappi">Lisää henkilö</button>
						<button type="button" id="btnPeruutahenkilö" class="btn btn-default" data-dismiss="modal">Peruuta</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>