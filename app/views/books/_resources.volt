{% if book.present('answer') OR book.present('teachplan') %}
    <h2>相关资源</h2>

    <div class="panel panel-default">
        <div class="panel-body">
            <ul>
                {% if book.present('answer') %}
                    <li>{{ book.present('answer') }} <pre>{{ book.present('answerfile') }}</pre></li>
                {% endif %}
                {% if book.present('teachplan') %}
                    <li>{{ book.present('teachplan') }} <pre>{{ book.present('teachplanfile') }}</pre></li>
                {% endif %}
            </ul>
        </div>
    </div>
{% endif %}