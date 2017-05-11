{% extends "index.volt" %}
{% block title %}剑桥双语分级阅读{% endblock %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="{{ url(['for':'home']) }}">首页</a></li>
        <li class="active">作者清单</li>
    </ol>
    <h1>作者清单</h1>

    <h2>系列</h2>

    <table class="table table-hover">
        <tr>
            <td>#</td>
            <td>作者</td>
            <td>图书</td>
        </tr>
        {% for author in authors %}
            <tr>
                <td>{{ author.id }}</td>
                <td><a href="{{ url(['for':'authors.show','author':author.id]) }}">{{ author.name }}</a></td>
                <td>{{ author.books().count() }}</td>
            </tr>
        {% endfor %}
    </table>

{% endblock %}
