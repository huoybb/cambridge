{% if book.present('answer') OR book.present('teachplan') %}
    <h2>相关资源</h2>

    <div class="panel panel-default">
        <div class="panel-body">
            <ul>
                {% if book.present('answer') %}
                    <li>{{ book.present('answer') }} <pre>files answers {{ book.present('pdf') }}</pre></li>
                {% endif %}
                {% if book.present('teachplan') %}
                    <li>{{ book.present('teachplan') }} <pre>files teachplans {{ book.present('pdf') }}</pre></li>
                {% endif %}
            </ul>
        </div>
    </div>
{% endif %}