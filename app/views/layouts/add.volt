<div class="container">
    <p>{{ flash.output() }}</p>
    {{ form("method": "post") }}
    {% include "layouts/csrf.volt" %}
    {% for item in Owner.getForm().fields %}
        <div class="form-group">
            {{ item }}:{{ Owner.getForm().render(item,['class':'form-control']) }}<br/>
        </div>
    {% endfor %}
    <div class="form-group">
        {{ submit_button("添加","class":"btn btn-primary form-control") }}
    </div>
    {{ endform() }}

</div>