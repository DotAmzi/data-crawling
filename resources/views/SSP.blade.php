<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body>
        @foreach ($values as $categories)
          @foreach ($categories as $bidding)
            {{$bidding['title']}}
            <br>
            {{$bidding['cat']}}
            <br>
            {{$bidding['File']}}
            <br>
          @endforeach
        @endforeach
    </body>
</html>
