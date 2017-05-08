<div id="info">
    {% for key,value in Owner.infoArray() if Owner.present(key) %}
        <div class="row">
            <div class="col-md-2" align="right">
                {{ value }}:
            </div>
            <div class="col-md-10">
                {{ Owner.present(key) }}
            </div>
        </div>
    {% endfor %}
</div>