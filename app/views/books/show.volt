{% extends "index.volt" %}
{% block title %}图书：{{ book.name }}{% endblock %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="/">首页</a></li>
        <li><a href="{{ url(['for':'lists.show','list':book.list().id]) }}">{{ book.list().name }}</a></li>
        <li class="active">{{ book.name }}</li></ol>
    <h1>图书：{{ book.name }} </h1>
    {% include 'books/_info.volt' %}

    {% include 'books/_chapters.volt' %}

    {% include 'layouts/commentList' with ['commentOwner':book] %}

{% endblock %}
