{% extends 'index.volt' %}
{% block title %}
    图书修改：{{ book.name }}
{% endblock %}
{% block content %}
    <h1>图书修改：{{ book.name }}</h1>
    {% include 'layouts/edit' with ['Owner':book] %}
{% endblock %}