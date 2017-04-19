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
				<form id="henkiloFormi" action="sql.php?lisaaHenkilo=1" onsubmit="return validoiFormi()" method="POST">
					<input type="hidden" id="henkLaiva" value="">
					<div class="modal-body">
						<fieldset>
							<legend>Nimi ja sotu</legend>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group" id="divSotu">
										<label for="txtSotu">Sotu:</label>
										<input type="text" class="form-control" id="txtSotu" placeholder="010293-123A">
										<span id="helpSotu" class="help-block hidden"></span>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group" id="divEtunimi">
										<label for="txtEtunimi">Etunimi:</label>
										<input type="text" class="form-control" id="txtEtunimi" placeholder="Erkki">
										<span id="helpEtunimi" class="help-block hidden"></span>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group" id="divSukunimi">
										<label for="txtSukunimi">Sukunimi</label>
										<input type="text" class="form-control" id="txtSukunimi" placeholder="Esimerkki">
										<span id="helpSukunimi" class="help-block hidden"></span>
									</div>
								</div>
							</div>
							<legend>Postitiedot</legend>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group" id="divPostiosoite">
										<label for="txtPostiosoite">Postiosoite:</label>
										<input type="text" class="form-control" id="txtPostiosoite" placeholder="Esimerkkikatu 25-27 A13">
										<span id="helpPostiosoite" class="help-block hidden"></span>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group" id="divPostinumero">
										<label for="txtPostinumero">Postinumero:</label>
										<input type="text" class="form-control" id="txtPostinumero" placeholder="65100">
										<span id="helpPostinumero" class="help-block hidden"></span>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group" id="divPaikkakunta">
										<label for="txtPaikkakunta">Paikkakunta:</label>
										<input type="text" class="form-control" id="txtPaikkakunta" placeholder="Vaasa">
										<span id="helpPaikkakunta" class="help-block hidden"></span>
									</div>
								</div>
							</div>
							<legend>Muut tiedot</legend>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group" id="divPuhelin">
										<label for="txtPuhelin">Puhelin:</label>
										<input type="text" class="form-control" id="txtPuhelin" placeholder="0401234567">
										<span id="helpPuhelin" class="help-block hidden"></span>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group" id="divTitteli">
										<label for="txtTitteli">Titteli</label>
										<input type="text" class="form-control" id="txtTitteli" placeholder="Titteli">
										<span id="helpTitteli" class="help-block hidden"></span>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group" id="divKuva">
										<label for="imgKuva">Kuva:</label>
										<input type="file" id="imgKuva" name="myimage">
										<span id="helpKuva" class="help-block hidden"></span>
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="modal-footer">
						<button type="submit" id="btnSubmithenkilö" class="btn btn-success" id="henkNappi">Lisää henkilö</button>
						<button type="button" id="btnPeruutahenkilö" class="btn btn-default" data-dismiss="modal">Peruuta</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>