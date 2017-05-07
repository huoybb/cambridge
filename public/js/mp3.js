// Generated by CoffeeScript 1.9.1
(function() {
  $(function() {
    $('.mp3').click(function() {
      var mp3player;
      $('tr.info').removeClass('info');
      $(this).parents('tr').addClass('info');
      mp3player = $('.mp3player');
      mp3player.attr('src', $(this).attr('data'));
      mp3player[0].play();
      return false;
    });
    return $('.mp3player').on('ended', function() {
      var next;
      next = parseInt($(this).attr('chapter')) + 1;
      $('.mp3').filter(function() {
        return parseInt($(this).parents('tr').attr('chapter')) === next;
      }).click();
      return $(this).attr('chapter', next);
    });
  });

}).call(this);

//# sourceMappingURL=mp3.js.map