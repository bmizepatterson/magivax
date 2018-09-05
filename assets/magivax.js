var colorPalette = document.getElementById("color-palette");

function windowMousemove(event) {
	if (event.clientY > window.innerHeight-100) {
		displayPalette();
	} else {
		hidePalette();
	}
}

function displayPalette() {
	colorPalette.style.display = "block";
	colorPalette.classList.add('w3-animate-bottom');
}

function hidePalette() {
	colorPalette.style.display = "none";
}


function init() {	
	colorPalette.style.display = "none";
	// Event Listeners
	colorPalette.addEventListener('mouseover', displayPalette);
	window.addEventListener('mousemove', windowMousemove);
}

init();