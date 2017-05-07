$ ->
  $('.report-bug').click (e)->
    vex.dialog.open
      message:'请详细描述您遇到的问题！'
      input:"""
          <textarea name="description" placeholder="问题描述" rows='3' required />
        """
      buttons: [
        $.extend({}, vex.dialog.buttons.YES, text: '确定')
        $.extend({}, vex.dialog.buttons.NO, text: '取消')
      ]
      callback: (data) ->
        return console.log('Cancelled') if data is false
        currenturl = location.href
        data.bug_url = currenturl
        url = '/bugs/add'
        $.post url,data
    e.preventDefault()