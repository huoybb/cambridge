{% extends "index.volt" %}
{% block title %}系列：{{ list.name }}{% endblock %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="/">首页</a></li>
        <li class="active">{{ list.name }}</li></ol>
    <h1>系列：{{ list.name }} </h1>
    {% include 'layouts/info' with ['Owner':list] %}

    <h2>图书</h2>
    <div class="row">
        {% for book in list.books() %}
        <div class="col-xs-6 col-md-3">
            <a href="{{ url(['for':'books.show','book':book.id]) }}" class="thumbnail">
                <img src="{{ book.img() }}" alt="{{ book.name }}">
            </a>
        </div>
        {% endfor %}
    </div>

    <table class="table table-hover">
        <tr>
            <td>#</td>
            <td>名字</td>
            <td>链接</td>
        </tr>
        {% for book in list.books() %}
            <tr>
                <td>{{ book.id }}</td>
                <td><a href="{{ url(['for':'books.show','book':book.id]) }}">{{ book.name }}</a></td>
                <td>{{ book.url }}</td>
            </tr>
        {% endfor %}
    </table>

    {% include 'layouts/commentList' with ['commentOwner':list] %}
{% endblock %}
