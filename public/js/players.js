

var music = document.getElementById("music");
var playButton = document.getElementById("play");
var pauseButton = document.getElementById("pause");
var playhead = document.getElementById("elapsed");
var timeline = document.getElementById("slider");
var timer = document.getElementById("timer");
var endtime = document.getElementById("end-time");
var duration;
pauseButton.style.display = "none";

if (typeof current === 'undefined') {
    let current;
}
allsongs = $('a.song');
allsongs.length = allsongs.length/2;

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
	// console.log(duration);
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
    audio.setAttribute('src', $(this).attr('data-file'));
    console.log(audio.src);

    music.play();
    playButton.style.display = "none";
    pauseButton.style.display = "inherit";

    current = $(this).attr('data-nb');

		// Set Titre chanson
		document.getElementById("title").innerHTML = $(this).attr('data-titre');

    // Set Img Chanson
    $('.imgBx').css("background-image", "url(" + $(this).attr('data-img') + ")");

    // Set Id chanson
      $("#heart").addClass("heart");

      $.get("/liked/"+$(this).attr("data-id"), function( data ) {
            if(data == 1)
                $("#heart").addClass("animationend");
            else
                $("#heart").removeClass("animationend");

      });


      $('#heart').attr('href', '/like/'+ $(this).attr('data-id'));

  });

  $("#heart").click(function(e) {
      e.preventDefault();
      $.get( $(this).attr("href"), function( data ) {
          $("#heart").toggleClass("animationend")
      });
  })

  // $("#pjax-container").on("click", "a.song", function (e){
  //   e.preventDefault();
  //   $.get( "/audio/"+ $(this).attr('data-id'), function( data ) {
  //     $( "#audiocontroller" ).html( data );
  //   });
  //   // music.play();
  // });

});


// -------------------
// Actions Boutons
// -------------------
playButton.onclick = function() {
if (music.src) { // If is not empty
	music.play();
	playButton.style.display = "none";
	pauseButton.style.display = "inherit";
}
}

pauseButton.onclick = function() {
	music.pause();
	playButton.style.display = "inherit";
	pauseButton.style.display = "none";
}

music.addEventListener("canplaythrough", function () {
	duration = music.duration;
}, false);

music.addEventListener('ended',function(){
  current++;
  console.log(current);
  if(current == allsongs.length || current > allsongs.length)
  current = 1;
  audio = $("#music")[0];
  audio.src = $("a.song[data-nb='"+ current +"']").attr("data-file");
  // Set Titre chanson
  document.getElementById("title").innerHTML = $("a.song[data-nb='"+ current +"']").attr('data-titre');
  // Set Img Chanson
  $('.imgBx').css("background-image", "url(" + $("a.song[data-nb='"+ current +"']").attr('data-img') + ")");
  // Set Id chanson
  $("#heart").addClass("heart");

  $.get("/liked/"+$("a.song[data-nb='"+ current +"']").attr("data-id"), function( data ) {
        if(data == 1)
            $("#heart").addClass("animationend");
        else
            $("#heart").removeClass("animationend");

  });


  $('#heart').attr('href', '/like/'+ $("a.song[data-nb='"+ current +"']").attr('data-id'));

  music.play()
});

document.getElementById("previous").addEventListener("click", function() {
  current--;
  // alert("Current :" + current + "\nAll songs :"+ allsongs.length);
  if(current == allsongs.length || current == 0)
  current = 1
  audio = $("#music")[0];
  audio.src = $("a.song[data-nb='"+current+"']").attr("data-file")
  // Set Titre chanson
  document.getElementById("title").innerHTML = $("a.song[data-nb='"+ current +"']").attr('data-titre');
  // Set Img Chanson
  $('.imgBx').css("background-image", "url(" + $("a.song[data-nb='"+ current +"']").attr('data-img') + ")");
  // Set Id chanson
  $.get("/liked/"+$("a.song[data-nb='"+ current +"']").attr("data-id"), function( data ) {
        if(data == 1)
            $("#heart").addClass("animationend");
        else
            $("#heart").removeClass("animationend");

  });
  $('#heart').attr('href', '/like/'+ $("a.song[data-nb='"+ current +"']").attr('data-id'));
  music.play()
});

document.getElementById("next").addEventListener("click", function() {
  current++;
  // alert("Current :" + current + "\nAll songs :"+ allsongs.length);
  if(current == allsongs.length || current > allsongs.length)
    current = 1

  audio = $("#music")[0];
  audio.src = $("a.song[data-nb='"+current+"']").attr("data-file")
  // Set Titre chanson
  document.getElementById("title").innerHTML = $("a.song[data-nb='"+ current +"']").attr('data-titre');
  // Set Img Chanson
  $('.imgBx').css("background-image", "url(" + $("a.song[data-nb='"+ current +"']").attr('data-img') + ")");
  // Set Id chanson
  $.get("/liked/"+$("a.song[data-nb='"+ current +"']").attr("data-id"), function( data ) {
        if(data == 1)
            $("#heart").addClass("animationend");
        else
            $("#heart").removeClass("animationend");

  });
  $('#heart').attr('href', '/like/'+ $("a.song[data-nb='"+ current +"']").attr('data-id'));
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

//Gestion du volume dans le player
var silence = false;
$('.volume').click(function (e) {
  if (silence == true) {
    music.muted = false;
    silence = false;

  }
  else {
    music.muted = true;
    silence = true;
  }
  $('.volume').toggleClass('fa-volume-up').toggleClass('fa-volume-mute');


  // if ($(music)[0].hasAttribute('muted')) {
  //   music.muted = false;
  //   $('.volume').removeClass('fa-volume-up');
  //   $('.volume').addClass('fa-volume-mute');
  // }
  // else {
  //   music.muted = true;
  // }
});


slider.addEventListener("click", seek);
function seek(evt) {
  let percent = evt.offsetX / this.offsetWidth;
  music.currentTime = percent * music.duration;
  music.value = percent / 100 ;
	// console.log(percent);
}

// Responsive JS

if ( $(document).width() < 992 ) {
  $('#audio .container-fluid').on('click', () => {
    $("#audio .container-fluid").toggleClass('mobile');
    $('#audio .container-fluid .col-lg-3').fadeToggle('slow');
    $('#audio .container-fluid .col-lg-2').fadeToggle('slow');
  });
}
