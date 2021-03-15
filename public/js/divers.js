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

//
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

// Modif DESCRIPTION
$("#descriptionform button").hide();

$(document).ready(function(){
  $("#descriptionform button").fadeOut();
  $("#description").on('input', function(e){
    $("#descriptionform button").fadeIn();
  });

  $("#descriptionform").submit(function(e){
    e.target.elements['description'].value = $('#description').html();
    $("#descriptionform button").fadeOut();

    // console.log($('#description').html());
  })

  $('#description').keydown(function(e){
    if (e.keyCode === 13) {
      // Condition : Appuyer sur la touche Entrée
      document.execCommand('insertHTML', false, '<br><br>');
      return false;
    }
  })

})

$(document).ready(function (){
  // $("#pjax-container").on("click", "tr.song", function (e){
  //   e.preventDefault();
  //   var audio = $("#music")[0];
  //   audio.src = $(this).attr('data-file');
  //   	music.play();
  //     playButton.style.display = "none";
  //     pause.style.display = "inherit";
  //
  //     current = $(this).attr('data-nb');
  //
	// 		// Set Titre chanson
	// 		document.getElementById("title").innerHTML = $(this).attr('data-titre');
  //
  //     // Set Img Chanson
  //     $('.imgBx').css("background-image", "url(" + $(this).attr('data-img') + ")");
  //
  //     // Set Id chanson
  //     $('#heart').attr('href', '/like/'+ $(this).attr('data-id'));
  //
  // });
  $("#pjax-container").on("click", "tr.song", function (e){
    e.preventDefault();
    $.get( "/audio/"+ $(this).attr('data-id'), function( data ) {
      $( "#audiocontroller" ).html( data );
    });
  });
});
