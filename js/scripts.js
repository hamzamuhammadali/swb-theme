(function (root, $, undefined) {
  "use strict";

  $(function () {
    function animateValue(id, start, end, duration, callback) {
      if (start === end) return;
      var range = end - start;
      var current = start;
      var increment = end > start ? 1 : -1;
      var stepTime = Math.abs(Math.floor(duration / range));
      var obj = document.getElementById(id);
      var timer = setInterval(function () {
        current += increment;
        obj.innerHTML = current;
        if (current == end) {
          clearInterval(timer);
          if (typeof callback === 'function' && callback()) {
            callback();
          }
        }
      }, stepTime);
    }

    var counter = 0;

    if ($('.counter').length) {
      $(window).scroll(function () {
        var top_of_element = $(".counter").offset().top;
        var bottom_of_element = $(".counter").offset().top + $(".counter").outerHeight();
        var bottom_of_screen = $(window).scrollTop() + $(window).innerHeight();
        var top_of_screen = $(window).scrollTop();

        if ((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element) && (counter === 0)) {
          animateValue("counter", 1, 10, 1000, function () {
            animateValue("counter2", 4500, 4600, 1000, function () {
              animateValue("counter3", 10, 32, 1000);
              $(window).unbind('scroll');
            });
          });
          counter = 1;
        }
      });
    }

    $('#contactform').on('submit', function (e) {
      e.preventDefault();

      jQuery.post($(this).attr('action') + '?' + $(this).serialize(), function (data) {
        $('#contactform').append(data);
        $('input, textarea').val('');
      });
    });


    if ($('#splide').length) {
      new Splide('#splide', {
        focus: 'center',
        perPage: 3.5,
        rewind: true,
        trimSpace: false,
        //autoplay: true,
        start: 1,
        breakpoints: {
          990: {
            focus: 'center',
            perPage: 2.5,
            rewind: true,
          },
          640: {
            focus: 'center',
            perPage: 1.5,
            rewind: true,
          },
        }
      }).mount();
    }


  });

}(this, jQuery));
