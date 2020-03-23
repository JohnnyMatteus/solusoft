<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Relatorio</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    Relatorio de pedido
                </h3>
                <div class="row">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <h4>Dados cliente    </h4><br>
                                    <p>Nome: {{{ $data['cliente']['nome'] }}}<br>
                                    CPF: {{{ $data['cliente']['cpf'] }}}<br>
                                    Sexo: {{{ $data['cliente']['sexo'] }}}<br>
                                    E-mail: {{{ $data['cliente']['email'] }}}</p>
                                </td>
                                <td>
                                    <h4>Dados do pedido    </h4><br>
                                    <p>Forma pagamento: {{{ $data['pedido']['forma_pagamento'] }}}<br>
                                    Data: {{{ date('d-M-y', strtotime($data['pedido']['data'])) }}}<br>
                                    observação: {{{ $data['pedido']['observacao'] }}}<br></p>
                                </td>

                            </tr>
                        </tbody>
                    </table>

                </div>
                <table width="100%" style="width:100%" border="0">
                    <thead>
                        <tr>
                            <th>
                                #id
                            </th>
                            <th>
                                Produto
                            </th>
                            <th>
                                Quantidade
                            </th>
                            <th>
                                Valor
                            </th>
                            <th>
                               Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                            @foreach ($data['produtos'] as $produto)
                            <tr>
                                <td> {{ $produto->id }}</td>
                                <td> {{ $produto->nome }}</td>
                                <td> {{ $produto->quantidade }}</td>
                                <td> {{  'R$ '.number_format($produto->valor, 2, ',', '.')  }}</td>
                                <td> {{  'R$ '.number_format($produto->valor_por_produto, 2, ',', '.')  }}</td>
                            </tr>
                            @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td >&nbsp; </td>
                            <td >&nbsp; </td>
                        </tr>
                        <tr>

                          <td colspan="4">Valor total do pedido</td>
                          <td> {{  'R$ '.number_format($data['valor_total'], 2, ',', '.')  }}</td>
                        </tr>
                      </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
