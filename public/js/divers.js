// Recherche personne / musique
  // $("#search").submit(function(e) {
  //   e.preventDefault();
  //   if ($.support.pjax) {
  //     $.pjax({url})
  //   }
  //   let s = e.target.elements[0].value;
  //   window.location.href = '/search/'+ s;
  // })

  // &('a.flag-icon'){
  //   e.preventDefault();
  //   if($.support.pjax){
  //     $.pjax({url: })
  //   }
  // }

  $('#search').submit(function (e) {
    e.preventDefault();
    var href = window.location.pathname.substr(0,4);

    if (window.location.pathname.substr(4,6) === "search") {
      if ($.support.pjax)
        $.pjax({url: href + "search/" + e.target.elements[0].value, container: 'body'});
      else
        window.location.href = href + "search/" + e.target.elements[0].value;
    }
    else {
      if ($.support.pjax)
        $.pjax({url: href + "/search/" + e.target.elements[0].value, container: 'body'});
      else
        window.location.href = href + "/search/" + e.target.elements[0].value;
    }

  });

$(document).pjax('a:not(.song)', '#pjax-container');
$(document).on('submit', 'form[data-pjax]', function(event) {
  $.pjax.submit(event, 'body')
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
