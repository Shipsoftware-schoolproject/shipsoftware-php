function draw(degrees) {
    //alert(degrees);
    var canvas = document.getElementById('compass');

	// Canvas supported?
	if (canvas.getContext('2d')) {
		ctx = canvas.getContext('2d');

		// Load the needle image
		needle = new Image();
		needle.src = './img/needle.png';

		// Load the compass image
		img = new Image();
		img.src = './img/compass.svg';
		//img.onload = draw;
	} else {
		alert("Canvas not supported!");
	}

    ctx.clearRect(0, 0, 200, 200);

	// Draw the compass onto the canvas
	ctx.drawImage(img, 0, 0, 200, 200);

	// Save the current drawing state
	ctx.save();

	// Now move across and down half the
	ctx.translate(100, 100);

	// Rotate around this point
	ctx.rotate(parseInt(degrees) * (Math.PI / 180));

	// Draw the image back and up
	ctx.drawImage(needle, -100, -100);

	// Restore the previous drawing state
	ctx.restore();
}
