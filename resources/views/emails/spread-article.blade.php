<h1>Последние публикации</h1>
<ul>
    @foreach ($articles as $article)
    <li>
        <h2>{{ $article->article_title }}</h2>
        <p>{{ $article->text }}</p>
        <span>{{ $article->rubric_title }}</span>
    </li>
    @endforeach
</ul>
<h1>Рубрики на которые вы подписаны</h1>
<ul>
    @foreach ($rubrics as $rubric)
    <li>{{ $rubric->title }}</li>
    @endforeach
</ul>