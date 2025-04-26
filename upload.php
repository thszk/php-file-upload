<?php

require_once __DIR__ . '/app/model/ImagemModel.php';

// Validação caso a request não seja POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    return header('Location: index.php');
}

// Validação caso a request não tenha atributo imagem como file
if (!isset($_FILES['imagem'])) {
    return header('Location: index.php');
}

$arquivoImagem = $_FILES['imagem'];

// https://developer.mozilla.org/en-US/docs/Web/HTTP/Guides/MIME_types/Common_types
$tiposPermitidos = ['image/jpeg', 'image/png'];
$extensoesPermitidas = ['jpg', 'jpeg', 'png'];

// Validação do tipo do arquivo
if (!in_array($arquivoImagem['type'], $tiposPermitidos)) {
    die('Tipo de arquivo inválido. Apenas JPG, JPEG, PNG são permitidos.');
}

// Validação da extensão do arquivo
$extensaoArquivo = strtolower(pathinfo($arquivoImagem['name'], PATHINFO_EXTENSION));
if (!in_array($extensaoArquivo, $extensoesPermitidas)) {
    die('Extensão de arquivo inválida. Apenas JPG, JPEG, PNG são permitidos.');
}

$diretorioDestino = './uploads/';

// Validação caso o diretório destino não exista, então cria
if (!is_dir($diretorioDestino)) {
    mkdir($diretorioDestino, 0777, true);
}

$caminhoTemporario = $arquivoImagem['tmp_name'];

// Tratamento para salvar os arquivos com nome único
$nomeUnico = uniqid() . '_' . $arquivoImagem['name'];
$caminhoDestino = $diretorioDestino . $nomeUnico;

$salvou = move_uploaded_file($caminhoTemporario, $caminhoDestino);

$sucesso = false;
if ($salvou) {
    // Salva no banco de dados os metadados da imagem
    $imagemModel = new ImagemModel();
    $sucesso = $imagemModel->criar([
        'nome' => $nomeUnico,
        'nome_original' => $arquivoImagem['name'],
        'caminho' => $caminhoDestino
    ]);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Upload de Imagem</title>

    <style>
        <?php require_once __DIR__ . '/app/view/assets/css/style.css'; ?>
    </style>
</head>

<body>
    <section>
        <p>
            <?php
                if ($sucesso) {
                    echo 'Imagem salva com sucesso em ' . $caminhoDestino . ' ';
                } else {
                    echo 'Erro ao salvar imagem ';
                }
            ?>
        </p>
        <a href="index.php">Voltar</a>
    </section>
</body>

</html>