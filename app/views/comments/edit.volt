{% extends 'index.volt' %}
{% block title %}
    评论修改
{% endblock %}
{% block content %}
    {% include 'layouts/edit' with ['Owner':comment] %}
{% endblock %}