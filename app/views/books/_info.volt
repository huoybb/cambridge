<div class="row">
    <div class="col-md-2"><img src="{{ book.img() }}" alt="poster" width="163" height="250"> </div>
    <div class="col-md-3">{{ book.info }}</div>
    <div class="col-md-7">{{ book.author }}</div>
</div>
<div class="row">
    <h2>故事介绍</h2>
    <div class="panel panel-default">
        <div class="panel-body">
            <div>{{ book.story }}</div>
        </div>
    </div>
</div>