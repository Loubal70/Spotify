var music = document.getElementById("music");
var playButton = document.getElementById("play");
var pauseButton = document.getElementById("pause");
var playhead = document.getElementById("elapsed");
var timeline = document.getElementById("slider");
var timer = document.getElementById("timer");
var endtime = document.getElementById("end-time");
var duration;
pauseButton.style.display = "none";
let current,
allsongs = $('tr.song');

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

music.addEventListener('ended',function(){
  current++;
  if(current == allsongs.length)
  current = 0;
  audio = $("#music")[0];
  audio.src = $("tr.song[data-nb='"+ current +"']").attr("data-file");
  // Set Titre chanson
  document.getElementById("title").innerHTML = $("tr.song[data-nb='"+ current +"']").attr('data-titre');
  // Set Img Chanson
  $('.imgBx').css("background-image", "url(" + $("tr.song[data-nb='"+ current +"']").attr('data-img') + ")");
  // Set Id chanson
  $('#heart').attr('href', '/like/'+ $("tr.song[data-nb='"+ current +"']").attr('data-id'));
  music.play()
});

document.getElementById("previous").addEventListener("click", function() {
  current--;
  if(current == allsongs.length || current < 0)
  current = 0
  audio = $("#music")[0];
  audio.src = $("tr.song[data-nb='"+current+"']").attr("data-file")
  // Set Titre chanson
  document.getElementById("title").innerHTML = $("tr.song[data-nb='"+ current +"']").attr('data-titre');
  // Set Img Chanson
  $('.imgBx').css("background-image", "url(" + $("tr.song[data-nb='"+ current +"']").attr('data-img') + ")");
  // Set Id chanson
  $('#heart').attr('href', '/like/'+ $("tr.song[data-nb='"+ current +"']").attr('data-id'));
  music.play()
});

document.getElementById("next").addEventListener("click", function() {
  current++;
  if(current == allsongs.length)
  current = 0
  audio = $("#music")[0];
  audio.src = $("tr.song[data-nb='"+current+"']").attr("data-file")
  // Set Titre chanson
  document.getElementById("title").innerHTML = $("tr.song[data-nb='"+ current +"']").attr('data-titre');
  // Set Img Chanson
  $('.imgBx').css("background-image", "url(" + $("tr.song[data-nb='"+ current +"']").attr('data-img') + ")");
  // Set Id chanson
  $('#heart').attr('href', '/like/'+ $("tr.song[data-nb='"+ current +"']").attr('data-id'));
  music.play()
});

$("#repeat").on('click', function(){

  if ($(music)[0].hasAttribute("loop")) {
    music.loop = false;
  }
  else {
    music.loop = true;
  }

});

slider.addEventListener("click", seek);
function seek(evt) {
  let percent = evt.offsetX / this.offsetWidth;
  music.currentTime = percent * music.duration;
  music.value = percent / 100 ;
	console.log(percent);
}
