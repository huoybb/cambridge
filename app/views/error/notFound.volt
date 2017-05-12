{% extends 'index.volt' %}
{% block title %}
    没有找到路由：我的视频
{% endblock %}
{% block content %}
    <h1>无效的url</h1>
    <div>
        <pre>{{ myurl }}</pre>不是有效的路由，请检查routes.php文件，确认设置正确
    </div>
{% endblock %}