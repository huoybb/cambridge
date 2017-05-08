<div class="row">
    <div class="col-md-2"><img src="{{ book.img() }}" alt="poster" width="163" height="250"> </div>
    <div class="col-md-3">{{ book.info }}</div>
    <div class="col-md-7">
        <h2>作者介绍</h2>
        <h4><a href="{{ url(['for':'authors.show','author':book.author().id]) }}">{{ book.author().name }}</a></h4>
        <p>{{ book.author().intr }}</p>
        <h4><a href="{{ url(['for':'authors.show','author':book.translator().id]) }}">{{ book.translator().name }}</a></h4>
        <p>{{ book.translator().intr }}</p>
    </div>
</div>

<h2>故事介绍</h2>
<div class="panel panel-default">
    <div class="panel-body">
        <div>{{ book.story }}</div>
    </div>
</div>
