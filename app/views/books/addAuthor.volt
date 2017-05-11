{% extends "index.volt" %}
{% block title %}图书：{{ book.name }}{% endblock %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="/">首页</a></li>
        <li><a href="{{ url(['for':'lists.show','list':book.list().id]) }}">{{ book.list().name }}</a></li>
        <li><a href="{{ url(['for':'books.show','list':book.id]) }}">{{ book.name }}</a></li>
        <li class="active">添加作者</li>
    </ol>
    <h1>添加作者，给图书：{{ book.name }} </h1>
    {{ form("method": "post") }}
    {% include "layouts/csrf.volt" %}
    <div class="form-group">
        作者:{{ text_field("name", "size": 32, "class":"form-control") }}
    </div>
    <div class="form-group">
        {{ submit_button("添加","class":"btn btn-primary form-control") }}
    </div>

{% endblock %}