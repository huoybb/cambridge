{% if book.chapters().count() %}
    <h2>内容</h2>

    <div class="panel panel-default">
        <div class="panel-body">
            <audio class="mp3player" controls="controls" src="{{ book.chapters().getFirst().mp3() }}" chapter="{{ book.chapters().getFirst().id }}"></audio>
            <table class="table table-hover">
                <tr>
                    <td>#</td>
                    <td>章节</td>
                    <td>mp3</td>
                </tr>
                {% for chapter in book.chapters() %}
                    <tr chapter="{{ chapter.id }}">
                        <td>{{ chapter.index }}</td>
                        <td><a href="{{ url(['for':'chapters.show','chapter':chapter.id]) }}">{{ chapter.name }}</a></td>
                        <td><a href="#" data="{{ chapter.mp3() }}" class="mp3">播放</a></td>
                    </tr>
                {% endfor %}
            </table>
        </div>
    </div>

    <script src="/js/mp3.js"></script>
{% endif %}