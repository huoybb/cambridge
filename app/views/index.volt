<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{% block title %}Phalcon PHP Framework{% endblock %}</title>
    <link rel="stylesheet" href="/css/app.css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/jquery-2.1.4.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <!--Vex 设置 -->
    <script src="/js/vex.combined.min.js"></script>
    <script>vex.defaultOptions.className = 'vex-theme-bottom-right-corner';</script>
    <link rel="stylesheet" href="/css/vex.css" />
    <link rel="stylesheet" href="/css/vex-theme-bottom-right-corner.css" />

</head>
<body>
{% include "layouts/header.volt" %}
{{ flash.output() }}
<div class="container">
    {% block content %}{% endblock %}
</div>
{% block footer %}
    <div class="container">
        <div class="row">
            <?php echo xdebug_time_index();?>
        </div>
    </div>
{% endblock %}
</body>
</html>
