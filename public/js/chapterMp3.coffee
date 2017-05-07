# MP3 播放
$ ->
  $('.mp3player').on 'ended',->
    next = parseInt($(this).attr('chapter')) + 1
    #    查找目标tr，点击播放
    $('tr a').filter(
      -> parseInt($(this).parents('tr').attr('chapter')) is next
    ).click()
