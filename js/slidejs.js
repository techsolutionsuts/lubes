var imageCount = 1;
var total = 19;

function photo(x) {
	var image = document.getElementById('image');
	imageCount = imageCount + x;
	if(imageCount > total){imageCount = 1;}
	if(imageCount < 1){imageCount = total;}	
	image.src = "images/slide/slide"+ imageCount +".png";
	}
	
window.setInterval(function photoA() {
	var image = document.getElementById('image');
	imageCount = imageCount + 1;
	if(imageCount > total){imageCount = 1;}
	if(imageCount < 1){imageCount = total;}	
	image.src = "images/slide/slide"+ imageCount +".png";
	},5000);