<h2>目录</h2>
<table class="table table-hover">
    <tr>
        <td>#</td>
        <td>章节</td>
    </tr>
    {% for c in chapter.book().chapters() %}
        <tr chapter="{{ c.id }}" {% if chapter.id == c.id %} class="info" {% endif %}>
            <td>{{ c.index }}</td>
            <td><a href="{{ url(['for':'chapters.show','chapter':c.id]) }}">{{ c.name }}</a></td>
        </tr>
    {% endfor %}
</table>
<script src="/js/chapterMp3.js"></script>