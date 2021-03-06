<div class="row">
    <div class="col-md-2"><img src="{{ book.img() }}" alt="poster" width="163" height="250"> </div>
    <div class="col-md-4">
        {{ book.present('info') }}
        链接：{{ book.present('links') }} <br>
        操作：{{ book.present('operations') }} <br>
    </div>
    <div class="col-md-6">
        <h2>作者介绍</h2>

        {% if book.author().count() %}
            {% for author in book.author() %}
                <h4><a href="{{ url(['for':'authors.show','author':author.id]) }}">{{ author.name }}</a></h4>
                <p>{{ author.intr }}</p>
            {% endfor %}

            {% for author in book.translator() %}
                <h4><a href="{{ url(['for':'authors.show','author':author.id]) }}">{{ author.name }}</a></h4>
                <p>{{ author.intr }}</p>
            {% endfor %}
        {% else %}
            {{ book.author }}
        {% endif %}


    </div>
</div>

<h2>故事介绍</h2>
<div class="panel panel-default">
    <div class="panel-body">
        <div>{{ book.story }}</div>
    </div>
</div>
