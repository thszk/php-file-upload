<?php

$diretorioDestino = 'uploads/';
$arquivoImagem = $_FILES['imagem'];

$caminhoTemporario = $arquivoImagem['tmp_name'];
$caminhoDestino = $diretorioDestino . $arquivoImagem['name'];

$salvou = move_uploaded_file($caminhoTemporario, $caminhoDestino);

if ($salvou) {
    echo 'Imagem salva com sucesso em ' . $caminhoDestino;
} else {
    echo 'Erro ao salvar imagem';
}