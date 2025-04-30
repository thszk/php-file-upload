<?php
require_once __DIR__ . '/app/model/ImagemModel.php';

if (!empty($_GET['id'])) {
    $imagemModel = new ImagemModel();
    $imagem = $imagemModel->buscarPorId($_GET['id']);

    if (!isset($imagem)) {
        die('Imagem não encontrada.');
    }

    $caminhoImagem = $imagem['caminho'];
    if (!file_exists($caminhoImagem)) {
        die('Arquivo da imagem não encontrado.');
    }

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $imagem['nome_original'] . '"');
    header('Content-Length: ' . filesize($caminhoImagem));

    readfile($caminhoImagem);
}