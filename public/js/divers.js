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

$(document).ready(function(){
  $('[data-toggle="popover"]').popover({html:true});
});
