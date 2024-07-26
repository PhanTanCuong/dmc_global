$(document).ready(function() {
    $('.collapse-item').on('click', function() {
      var target = $(this).data('target');
      $(target).collapse('toggle');
    });
  });