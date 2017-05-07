{% extends "index.volt" %}
{% block title %}图书：{{ book.name }}{% endblock %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="/">首页</a></li>
        <li><a href="{{ url(['for':'lists.show','list':book.list().id]) }}">{{ book.list().name }}</a></li>
        <li class="active">{{ book.name }}</li></ol>
    <h1>图书：{{ book.name }} </h1>
    <div class="row">
        <div class="col-md-2"><img src="{{ book.img() }}" alt="poster" width="163" height="250"> </div>
        <div class="col-md-3">{{ book.info }}</div>
        <div class="col-md-7">{{ book.author }}</div>
    </div>
    <div class="row">
        <h2>故事介绍</h2>
        <div class="panel panel-default">
            <div class="panel-body">
                <div>{{ book.story }}</div>
            </div>
        </div>
    </div>

    <h2>内容</h2>
    <table class="table table-hover">
        <tr>
            <td>#</td>
            <td>章节</td>
            <td>mp3</td>
        </tr>
        {% for chapter in book.chapters() %}
            <tr>
                <td>{{ chapter.id }}</td>
                <td>{{ chapter.name }}</td>
                <td>
                    <audio class="mp3player" controls="controls" src="{{ chapter.mp3() }}"></audio></td>
            </tr>
        {% endfor %}
    </table>

{% endblock %}
