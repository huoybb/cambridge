# MP3 播放
$ ->
  $('.mp3').click ->
    mp3player = $('.mp3player')
    mp3player.attr('src',$(this).attr('data'))
    mp3player[0].play()
    return false
  $('.mp3player').on 'ended',->
    next = parseInt($(this).attr('chapter')) + 1
    $('.mp3').filter(
      -> parseInt($(this).parents('tr').attr('chapter')) is next
    ).click()
    $(this).attr('chapter',next)