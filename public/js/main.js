var url = 'http://laravel.dev.com';
window.addEventListener('load', function () {
  const like = document.getElementsByClassName("heart-like");

  for (let index = 0; index < like.length; index++) {
    like[index].addEventListener('click', likeFunction);
    like[index].style.cursor = 'pointer';
  }

  function likeFunction(e) {
    if (e.target.src == 'http://laravel.dev.com/icons/heart-grey.png') {
      e.target.src = 'http://laravel.dev.com/icons/heart-red.png';
      $.ajax({
        url: url + '/like/' + e.target.getAttribute('info'),
        type: 'GET',
        success: function (response) {
          console.log('Like');
        }
      });

    } else {
      e.target.src = 'http://laravel.dev.com/icons/heart-grey.png';
      $.ajax({
        url: url + '/dislike/' + e.target.getAttribute('info'),
        type: 'GET',
        success: function (response) {
          console.log('Dislike');
        }
      });
    }
  }

  $('#form-search').submit(function (e) {

    $(this).attr('action', url + '/getUsers/' + $('#search').val());

  });

});