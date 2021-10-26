<!doctype html>
<html lang="pt-BR">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
      <title>Formulario :: Teste de Rotas</title>
  </head>
  <body>

    <div class="container my-5">
        <form action="{{ url('/users/1') }}" method="POST" autocomplete="off">

          @method('DELETE')
          {{-- <input type="hidden" name="_method" value="PUT"/> --}}

          <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

            <div class="form-group">
                <label for="first-name">Primeiro Nome</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="Jonas">
            </div>

            <div class="form-group">
                <label for="last-name">Segundo Nome</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="Maciel">
            </div>

            <div class="form-group">
                <label for="email">Email Nome</label>
                <input type="text" name="email" id="email" class="form-control" value="Jonas.ferutcci@crossmail.com">
            </div>

            <button class="btn btn-primary">Enviar</button>

        </form>
    </div>

      <script src="{{ asset('js/app.js') }}" ></script>
  </body>
</html>
