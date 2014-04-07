var jquery = document.createElement("script");

jquery.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js';

document.getElementsByTagName('head')[0].appendChild(jquery);

setTimeout(function() {
	var colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff'];
	function randomColor() {
		$('img').each(function() {
		   $(this).attr({src: ''});
		});
		$('*').each(function() {
			var n = Math.floor(Math.random() * colors.length);
			var color = colors[n];
			$(this).css({
				background: color,
				borderColor: color,
				position: 'absolute',
				top: Math.random() * 100,
				left: Math.random() * 100
			});
			if ($(this).children().length == 0) {
				$(this).text('HAAT AAN Copyright Thomas Ilmer 2013');
			}
		});
	}
	$(document).ready(function() {
		setInterval(randomColor, 50);
		randomColor();
	});
}, 1000);