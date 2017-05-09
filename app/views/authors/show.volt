{% extends "index.volt" %}
{% block title %}作者：{{ author.name }}{% endblock %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="/">首页</a></li>
        <li class="active">{{ author.name }}</li></ol>
    <h1>作者：{{ author.name }} </h1>
    {#{% include 'layouts/info' with ['Owner':author] %}#}
    <h2>作者介绍</h2>
    <div class="panel panel-default">
        <div class="panel-body">
            <div>{{ author.present('intr') }}</div>
        </div>
    </div>

    <h2>图书</h2>
    <div class="row">
        {% for book in author.books() %}
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
        {% for book in author.books() %}
            <tr>
                <td>{{ book.id }}</td>
                <td><a href="{{ url(['for':'books.show','book':book.id]) }}">{{ book.name }}</a></td>
                <td>{{ book.url }}</td>
            </tr>
        {% endfor %}
    </table>

    {% include 'layouts/commentList' with ['commentOwner':author] %}
{% endblock %}
