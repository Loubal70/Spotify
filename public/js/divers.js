// Recherche personne / musique
  // $("#search").submit(function(e) {
  //   e.preventDefault();
  //   if ($.support.pjax) {
  //     $.pjax({url})
  //   }
  //   let s = e.target.elements[0].value;
  //   window.location.href = '/search/'+ s;
  // })
$('#search').submit(function (e) {
    e.preventDefault();
    if ($.support.pjax)
        $.pjax({url: "/search/" + e.target.elements[0].value, container: '#pjax-container'});
    else
        window.location.href = "/search/" + e.target.elements[0].value;
  });

$(document).pjax('a:not(.song)', '#pjax-container');
$(document).on('submit', 'form[data-pjax]', function(event) {
  $.pjax.submit(event, '#pjax-container')
})

// Like animation
$(".heart").on('click touchstart', function(){
  $(this).toggleClass('is_animating');
});

$(".heart").on('animationend', function(){
  $(this).toggleClass('animationend');
});


var music = document.getElementById("music");
var playButton = document.getElementById("play");
var pauseButton = document.getElementById("pause");
var playhead = document.getElementById("elapsed");
var timeline = document.getElementById("slider");
var timer = document.getElementById("timer");
var endtime = document.getElementById("end-time");
var duration;
pauseButton.style.display = "none";

function CalculVraiTemps(temps) {
  let minutes = Math.floor(temps / 60),
    seconds_int = temps - minutes * 60,
    seconds_str = seconds_int.toString(),
    seconds = seconds_str.substr(0, 2);
    let time = minutes + ':' + (seconds < 10 ? "0" + seconds : seconds);

  return time;
}

function calculateCurrentValue(currentTime) {
  let current_hour = parseInt(currentTime / 3600) % 24,
    current_minute = parseInt(currentTime / 60) % 60,
    current_seconds_long = currentTime % 60,
    current_seconds = current_seconds_long.toFixed(),
    current_time = (current_minute < 10 ? "0" + current_minute : current_minute) + ":" + (current_seconds < 10 ? "0" + current_seconds : current_seconds);

  return current_time;
}


// Gestion Audio :


var timelineWidth = timeline.offsetWidth - playhead.offsetWidth;

music.addEventListener("timeupdate", timeUpdate, false);

function timeUpdate() {
	var playPercent = timelineWidth * (music.currentTime / duration);
	endtime.innerHTML = CalculVraiTemps(duration);
	console.log(duration);
	let current_time = music.currentTime;
	    // calculate current value time
	    let currentTime = calculateCurrentValue(current_time);
	    jQuery(".start-time").html(currentTime);

	playhead.style.width = playPercent + "px";
}


$(document).ready(function (){
  $("#pjax-container").on("click", "a.song", function (e){
    e.preventDefault();
    var audio = $("#music")[0];
    audio.src = $(this).attr('data-file');
    	music.play();
      playButton.style.display = "none";
      pause.style.display = "inherit";

			// Set Titre chanson
			document.getElementById("title").innerHTML = $(this).attr('data-titre');

      // Set Img Chanson
      $('.imgBx').css("background-image", "url(" + $(this).attr('data-img') + ")");
  });

});

// -------------------
// Actions Boutons
// -------------------
playButton.onclick = function() {
if (music.src) { // If is not empty
	music.play();
	playButton.style.display = "none";
	pause.style.display = "inherit";
}
}

pauseButton.onclick = function() {
	music.pause();
	playButton.style.display = "inherit";
	pause.style.display = "none";
}

music.addEventListener("canplaythrough", function () {
	duration = music.duration;
}, false);

slider.addEventListener("click", seek);
function seek(evt) {
  let percent = evt.offsetX / this.offsetWidth;
  music.currentTime = percent * music.duration;
  music.value = percent / 100 ;
	console.log(percent);
}
