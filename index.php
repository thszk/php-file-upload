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
    <form action="app/view/pages/upload.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="imagem" accept="image/*" required>
      <button type="submit">Enviar</button>
    </form>
  </section>

  <section>
    <div class="container">
      <?php foreach ($imagens as $imagem) { ?>
        <div class="image-box">
          <img src="<?= 'app/view/pages/download.php?id=' . $imagem['id'] ?>" alt="<?= $imagem['nome_original'] ?>">
          <a href="<?= 'app/view/pages/download.php?id=' . $imagem['id'] ?>" download>
            <?= $imagem['nome_original'] ?>
          </a>
        </div>
      <?php } ?>
    </div>
  </section>
</body>

</html>