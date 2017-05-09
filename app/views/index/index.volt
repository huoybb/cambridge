{% extends "index.volt" %}
{% block title %}剑桥双语分级阅读{% endblock %}
{% block content %}
    <ol class="breadcrumb"><li class="active">首页</li>
    </ol>
    <h1>剑桥双语分级阅读</h1>

    <h2>系列</h2>

    <table class="table table-hover">
        <tr>
            <td>#</td>
            <td>级别</td>
            <td>推荐年级（词汇量）</td>
            <td>CEF</td>
            <td>ESOL</td>
            <td>操作</td>
        </tr>
        {% for level in lists %}
            <tr>
                <td>{{ level.index }}</td>
                <td>{{ level.present('showLink') }}</td>
                <td>{{ level.grade }}</td>
                <td>{{ level.cef }}</td>
                <td>{{ level.esol }}</td>
                <td>{{ level.present('operations') }}</td>
            </tr>
        {% endfor %}
    </table>
    <h2>说明</h2>
    <ul class="list-unstyled">
        <li class="tit">
            <span class="span1">级别</span>
            <span class="span2">推荐年级（词汇量）</span>
            <span class="span3">CEF</span>
            <span class="span4">ESOL</span>
        </li>

        <li>
            <span class="span1">第4级</span>
            <span class="span2">高一、高二年级(1,900)</span>
            <span class="span3">B1</span>
            <span class="span4">PET</span>
        </li>
        <li>
            <span class="span1">第5级 </span>
            <span class="span2">高二、高三年级(2,800)</span>
            <span class="span3">B2</span>
            <span class="span4">FCE</span>
        </li>
        <li style="border:none;">
            <span class="span1">第6级</span>
            <span class="span2">高三、大学及以上(3,800)</span>
            <span class="span3">C1</span>
            <span class="span4">CAE</span>
        </li>
    </ul>
    <p>本体系是由剑桥大学出版社经过科学的研究和实践而开发的一套阅读级别测试体系。该体系参照的分级标准是“欧洲共同语言参考框架（CEF）”和剑桥大学外语考试部（ESOL）的“剑桥五级考试”。与“剑桥双语分级阅读•小说馆”分级一致，该测试系统将读者的阅读水平分为7个级别，读者点击进入相应级别，通过轻松、有趣的词汇测试，即可了解自己是否适合阅读该级别的读物。</p>

    {#<h2>下载地址</h2>#}
    {#{% for chapter in chapters %}#}
        {#{{ chapter.mp3_url() }}#}
        {#<br>#}
    {#{% endfor %}#}

{% endblock %}
