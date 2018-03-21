<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Titel</label>
		<input type="text" name="title" class="form-control" placeholder="Fx 'Min computer tænder ikke'">
	</div>
	<div class="form-group">
		<label>Beskrivelse</label>
		<textarea name="content" class="form-control" placeholder="Fx 'Jeg spildte vand i min computer, hvad gør jeg?'" rows="5"></textarea>
	</div>
	<div class="form-group">
		<label>Billede</label>
		<input type="file" name="img">
	</div>
	<div class="form-group">
		<button class="btn btn-success" value="easter egg" name="opret" type="submit">Opret</button>
	</div>
</form>