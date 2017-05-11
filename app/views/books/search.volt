{% extends "index.volt" %}
{% block title %}搜索：{{ keywords }}{% endblock %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="/">首页</a></li>
        <li class="active">搜索：{{ keywords }}</li></ol>
    <h1>搜索：{{ keywords }} <span class="badge">{{ books.count() }}</span> </h1>

    <h2>图书</h2>
    <div class="row">
        {% for book in books %}
        <div class="col-xs-6 col-md-3">
            <a href="{{ url(['for':'books.show','book':book.id]) }}" class="thumbnail">
                <img src="{{ book.img() }}" alt="{{ book.name }}">
            </a>
        </div>
        {% endfor %}
    </div>
{% endblock %}
