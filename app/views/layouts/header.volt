<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand" href="/">剑桥双语分级阅读</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ url(['for':'authors.index']) }}">作者</a></li>
                {#<li><a href="{{ url(['for':'stopovers.index']) }}">停留</a></li>#}
                {#<li><a href="{{ url(['for':'tasks.index']) }}">任务</a></li>#}
                {#<li><a href="{{ url(['for':'actionplans.index']) }}">行动计划</a></li>#}

                {#<li class="dropdown">#}
                    {#<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">相关信息<span class="caret"></span></a>#}
                    {#<ul class="dropdown-menu">#}
                        {#<li><a href="{{ url(['for':'projects.index']) }}">项目</a></li>#}
                        {#<li><a href="{{ url(['for':'trips.index']) }}">行程</a></li>#}
                        {#<li><a href="{{ url(['for':'travels.index']) }}">交通</a></li>#}
                        {#<li><a href="{{ url(['for':'hotels.index']) }}">宾馆</a></li>#}
                        {#<li><a href="{{ url(['for':'restaurants.index']) }}">餐厅</a></li>#}
                        {#<li><a href="{{ url(['for':'meals.index']) }}">餐饮记录</a></li>#}
                        {#<li><a href="{{ url(['for':'contacts.index']) }}">联系人</a></li>#}
                        {#<li><a href="{{ url(['for':'types.index']) }}">项目类型</a></li>#}
                        {#<li><a href="{{ url(['for':'templates.index']) }}">任务模板</a></li>#}
                    {#</ul>#}
                {#</li>#}
                {#<li><a href="{{ url(['for':'bugs.index']) }}">bug追踪</a></li>#}
            </ul>
            {#<ul class="nav navbar-nav navbar-right">#}
                {#<li class="dropdown">#}
                    {#<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ auth.user().name }} <span class="caret"></span></a>#}
                    {#<ul class="dropdown-menu">#}
                        {#<li role="separator" class="divider"></li>#}
                        {#<li><a href="/logout">退出登录</a></li>#}
                    {#</ul>#}
                {#</li>#}
                {#<li><a href="#" class="report-bug">反映问题</a></li>#}
                {#<script src="/js/myVexSetup.js"></script>#}
            {#</ul>#}

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form id="search-form" class="navbar-form navbar-left" role="search">
                        <input type="text" id="search" name="search" class="form-control" placeholder="Search" {% if keywords is defined %} value="{{ keywords }}" {% endif %}>
                        <button type="submit" class="btn btn-default">查询</button>
                    </form>
                    <script src="/js/search.js"></script>
                </li>
            </ul>
        </div>

    </div>
</nav>