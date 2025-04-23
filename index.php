<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Upload de Imagem</title>
</head>
<body>
  <h2>Exemplo Upload de Imagem</h2>
  <form action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="imagem" accept="image/*" required>
    <button type="submit">Enviar</button>
  </form>
</body>
</html>