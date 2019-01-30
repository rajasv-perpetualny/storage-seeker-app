@foreach($articles as $article)
    <article>
        <h1>{{$article['title']}}</h1>
        {!!$article['description']!!}
    </article>
@endforeach