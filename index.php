<?php
require_once __DIR__ . '/app/model/ImagemModel.php';

$imagemModel = new ImagemModel();
$imagens = $imagemModel->listar();
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
    <h2>Exemplo Upload de Imagem</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="imagem" accept="image/*" required>
      <button type="submit">Enviar</button>
    </form>
  </section>

  <section>
    <div class="container">
      <?php foreach ($imagens as $imagem) { ?>
        <div class="image-box">
          <img src="<?= '/php-file-upload/' . $imagem['caminho'] ?>" alt="<?= $imagem['nome_original'] ?>">
        </div>
      <?php } ?>
    </div>
  </section>
</body>

</html>