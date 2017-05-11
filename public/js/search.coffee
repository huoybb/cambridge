$ ->
# 搜索功能键的设置
  $("#search-form").submit ->
    keywords = $("#search").val().trim()
    keywords = keywords.replace(/\//,' ') #去除搜索中的"/"，避免出现路由错误;
    return false if keywords is ''
    location.href = "http://#{location.host}/search/#{keywords}"
    false