// Recherche personne / musique
// $("#search").submit(function(e) {
//   e.preventDefault();
//   if ($.support.pjax) {
//     $.pjax('/search/'+ s);
//     break;
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

$('#search').submit(function(e) {
    e.preventDefault();
    var href = window.location.pathname.substr(0, 4);

    if (window.location.pathname.substr(4, 6) === "search") {
        if ($.support.pjax)
            $.pjax({
                url: href + "search/" + e.target.elements[0].value,
                container: '#pjax-container'
            });
        else
            window.location.href = href + "search/" + e.target.elements[0].value;
    } else {
        if ($.support.pjax)
            $.pjax({
                url: href + "/search/" + e.target.elements[0].value,
                container: '#pjax-container'
            });
        else
            window.location.href = href + "/search/" + e.target.elements[0].value;
    }

});

$(document).pjax('a:not(.song)', '#pjax-container');
$(document).on('submit', 'form[data-pjax]', function(event) {
    $.pjax.submit(event, 'body')
})

if (typeof toggleButton == "undefined") {
  var toggleButton = document.querySelector('.dark-light');
}

toggleButton.addEventListener('click', () => {
    let lightmode = true;
    document.body.classList.toggle('light-mode');
});

$('.majplaylist').click(function(e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    let idplaylist = $(this).attr('data-idplaylist');
    let status = $(this).attr('data-status');
    let clic = $(this);
    $.get("/update/" + idplaylist + "/" + id, '', function(data) {
        $('#p' + idplaylist + '-' + id).toggleClass('danslaplaylist');
        $('#check' + idplaylist + '-' + id).toggleClass('invisible');
        if (status === 'contient') {
            clic.attr('data-status', 'necontientpas');
        } else {
            clic.attr('data-status', 'contient');
        }
    });
});

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
// Like animation
$(".heart").on('click touchstart', function() {
    $(this).toggleClass('is_animating');
});

$(".heart").on('animationend', function() {
    $(this).toggleClass('animationend');
});
