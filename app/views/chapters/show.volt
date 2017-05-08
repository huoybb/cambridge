{% extends "index.volt" %}
{% block title %}图书：{{ chapter.name }}{% endblock %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="/">首页</a></li>
        <li><a href="{{ url(['for':'lists.show','list':chapter.book().list().id]) }}">{{ chapter.book().list().name }}</a></li>
        <li><a href="{{ url(['for':'books.show','book':chapter.book().id]) }}">{{ chapter.book().name }}</a></li>
        <li class="active">{{ chapter.present('name') }}</li>
    </ol>
    <h1>章节：{{ chapter.present('name') }} </h1>
    <audio class="mp3player" controls="controls" src="{{ chapter.mp3() }}" chapter="{{ chapter.id }}" autoplay></audio>

    {% include 'chapters/_chapters.volt' %}

    {% include 'layouts/commentList' with ['commentOwner':chapter] %}

{% endblock %}
