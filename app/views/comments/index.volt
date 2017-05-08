{% extends "index.volt" %}
{% block title %}最新评论{% endblock %}
{% block content %}
    <ol class="breadcrumb"><li><a href="/">首页</a></li><li class="active">最新评论</li></ol>
    <h1>最新评论</h1>
    <ul class="list-unstyled list-group">
        {% for comment in comments %}
            <li class="list-group-item">
                <div>
                    <h4>
                        {#<span>{{ comment.id }}</span>#}
                        <span>To：</span>{{ comment.commentable().present('showLink') }}<span>@ {{ comment.updated_at.diffForhumans() }}</span>
                        <span><a href="{{ url(['for':'comments.edit','comment':comment.id]) }}">编辑</a></span>
                        <span><a href="{{ url(['for':'comments.delete','comment':comment.id]) }}">删除</a></span>
                    </h4>
                </div>
                <div>
                    <pre>{{ comment.content }}</pre>
                </div>
            </li>
        {% endfor %}

    </ul>
{% endblock %}
