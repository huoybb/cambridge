# MP3 播放
$ ->
  $('.mp3').click ->
#    设置样式
    $('tr.info').removeClass('info')
    $(this).parents('tr').addClass('info')

    mp3player = $('.mp3player')
    mp3player.attr('src',$(this).attr('data'))
    mp3player[0].play()
    return false
  $('.mp3player').on 'ended',->

#    计算下一个播放mp3
    next = parseInt($(this).attr('chapter')) + 1
#    查找目标tr，点击播放
    $('tr').filter(
      -> parseInt($(this).parents('tr').attr('chapter')) is next
    ).filter('.mp3').click()
#    修改mp3player的状态，chapter，以便能够为下一个自动播放准备
    $(this).attr('chapter',next)