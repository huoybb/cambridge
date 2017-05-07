{% extends "index.volt" %}
{% block title %}系列：{{ list.name }}{% endblock %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="/">首页</a></li>
        <li class="active">{{ list.name }}</li></ol>
    <h1>系列：{{ list.name }} </h1>

    <h2>图书</h2>
    <table class="table table-hover">
        <tr>
            <td>#</td>
            <td>名字</td>
            <td>图片</td>
        </tr>
        {% for book in list.books() %}
            <tr>
                <td>{{ book.id }}</td>
                <td><a href="{{ url(['for':'books.show','book':book.id]) }}">{{ book.name }}</a></td>
                <td>{{ book.url }}</td>
            </tr>
        {% endfor %}
    </table>

{% endblock %}
