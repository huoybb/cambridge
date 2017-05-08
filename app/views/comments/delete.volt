{% extends 'index.volt' %}
{% block title %}确认删除评论{% endblock %}
{% block content %}
    <h1>确认要删除下面的评论内容？</h1>
    <div><pre>{{ comment.content }}</pre></div>
    <form method="post">
        <a href="javascript:history.go(-1);" class="btn btn-primary">取消</a>
        <input name="confirm" type="submit" value="确认" class="btn btn-primary btn-danger">
    </form>
{% endblock %}