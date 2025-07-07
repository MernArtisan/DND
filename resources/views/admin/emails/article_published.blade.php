<!DOCTYPE html>
<html>

<head>
    <title>New Article</title>
</head>

<body>
    <h2>{{ $article->name }}</h2>
    <p>{!! $article->description !!}</p>

    <p>
        View on site:
        <a href="{{ url('/news') }}">
            {{ url('/news') }}
        </a>
    </p>

    <p>Thank you!</p>
</body>

</html>