{% extends 'index.volt' %}
{% block title %}
    系列：{{ list.name }}
{% endblock %}
{% block content %}
    {% include 'layouts/edit' with ['Owner':list] %}
{% endblock %}