<div class="container">
    <p>{{ flash.output() }}</p>
    {{ form("method": "post") }}
    {% include "layouts/csrf.volt" %}
    {% set myform = Owner.getForm() %}
    {% for item in myform.fields %}
        <div class="form-group">
            {{ myform.get(item).getLabel() }}:{{ myform.render(item,['class':'form-control']) }}<br/>
        </div>
    {% endfor %}
    <div class="form-group">
        {{ submit_button("修改","class":"btn btn-primary form-control") }}
    </div>
    {{ endform() }}

</div>