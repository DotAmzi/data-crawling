<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="css/app.css" rel="stylesheet" type="text/css">

    </head>
    <body>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Título</th>
            <th>Categoria</th>
            <th>Arquivo</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($values as $categories)
            @foreach ($categories as $bidding)
              <tr>
                <td>{{$bidding['title']}}</td>
                <td>{{$bidding['cat']}}</td>
                <td><a href="{{$bidding['File']}}">Download Edital</a></td>
              </tr>
            @endforeach
          @endforeach
        </tbody>
      </table>
    </body>
</html>
