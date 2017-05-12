{% extends 'index.volt' %}
{% block title %} 出现异常了 {% endblock %}
{% block content %}
    <h1>异常</h1>
    <div class="row">
        <div class="col-md-2" align="right">exception:</div>
        <div class="col-md-10">{{ get_class(exception) }}</div>
        <div class="col-md-2" align="right">file:</div>
        <div class="col-md-10">{{ file }}</div>
        <div class="col-md-2" align="right">line:</div>
        <div class="col-md-10">{{ line }}</div>
        <div class="col-md-2" align="right">code:</div>
        <div class="col-md-10">{{ code }}</div>
        <div class="col-md-2" align="right">message:</div>
        <div class="col-md-10"><pre>{{ message }}</pre></div>
        <div class="col-md-2" align="right">trace:</div>
        <div class="col-md-10"><pre>{{ trace }}</pre></div>
    </div>
{% endblock %}