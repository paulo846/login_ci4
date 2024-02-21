<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcação Dinâmica com Bootstrap</title>
    <!-- Adicione a referência ao Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo para centralizar verticalmente */
        body,
        html {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container{
            display: block;
        }
    </style>
</head>

<body>

    <div class="container">

        <form action="?" method="get">
            <!-- Elemento de texto com estilo Bootstrap -->
            <textarea id="texto" name="msg" class="form-control" cols="50" rows="10"></textarea><br>

            <!-- Marcadores com estilo Bootstrap -->
            <button class="btn btn-primary" type="button" onclick="inserirMarcacao('{nome}')">{nome}</button>
            <button class="btn btn-primary" type="button" onclick="inserirMarcacao('{email}')">{email}</button>

            <button type="submit" class="btn btn-dark">Enviar teste</button>
        </form>


<code>
<?php foreach($msg as $l) : 
echo $l . "\n <br>";
endforeach ; ?>
</code>

    <!-- <?php  print_r($msg) ?> -->
        
    </div>

    <script>
        // Função para inserir uma marcação no texto na posição atual do cursor
        function inserirMarcacao(marcacao) {
            var texto = document.getElementById("texto");
            var inicio = texto.selectionStart; // Obter a posição inicial do cursor
            var fim = texto.selectionEnd; // Obter a posição final do cursor
            var textoAntes = texto.value.substring(0, inicio); // Texto antes do cursor
            var textoDepois = texto.value.substring(fim, texto.value.length); // Texto depois do cursor
            texto.value = textoAntes + marcacao + textoDepois; // Inserir a marcação
            texto.focus(); // Manter o foco no elemento de texto
            // Reposicionar o cursor após a marcação inserida
            texto.setSelectionRange(inicio + marcacao.length, inicio + marcacao.length);
        }
    </script>

    <!-- Adicione a referência ao Bootstrap JS (opcional, se necessário) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>