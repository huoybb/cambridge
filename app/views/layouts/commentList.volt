<hr>
<h2>Comments:</h2>
{% if commentOwner.hasComments() %}
    <ul>
        {% for commentRow in commentOwner.getComments() %}
            <li>
                <div> <span>by <a href="#"> {{ commentRow.user().name }}</a></span>--<span>at: {{ commentRow.updated_at.diffForHumans() }}</span>
                    {#{% if gate.allows('editAndDelete',commentRow) %}#}
                        <span><a href="{{ url(['for':'comments.edit','comment':commentRow.id]) }}">edit</a></span>
                        <span><a href="{{ url(['for':'comments.delete','comment':commentRow.id]) }}" class="delete">delete</a></span>
                    {#{% endif %}#}
                </div>
                <div>
                    {{commentRow.content|nl2br}}
                </div>
            </li>
        {% endfor %}
    </ul>
{% endif %}
{{ form(url(['for':'comments.add','commentable_type':commentOwner.getClassName(),'commentable_id':commentOwner.id]),'method':'post') }}
    {% include "layouts/csrf.volt" %}
    {{ commentOwner.getcommentForm().render('content',['class':'form-control','rows':6]) }}
    {{ commentOwner.getcommentForm().render('增加',['class':'btn btn-primary form-control']) }}
{{ endform() }}