<!DOCTYPE html>
<html>

<head>
    <title>{{ config('app.name') }}</title>
</head>

<body>

    <p>Bugün eklenen kitaplar:</p>
    <ul>
        @foreach ($data as $book)
            <li> {{ $book->translation[0]->name }} </li>
        @endforeach
    </ul>


    Moneo,<br>
    {{ config('app.name') }}
</body>

</html>
