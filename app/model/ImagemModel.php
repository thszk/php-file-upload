<?php
require_once __DIR__ . '/../database/Database.php';

class ImagemModel
{

    private $table = 'imagens';
    private $conn;

    public function __construct()
    {
        $this->conn = Database::conectar();
    }

    /**
     * Summary of criar
     * @param array $imagem
     * [
     *   'nome',
     *   'nome_original',
     *   'caminho'
     * ]
     * @return bool
     */
    public function criar($imagem): bool
    {
        try {
            $query = "INSERT INTO $this->table (nome, nome_original, caminho)
            VALUES (:nome, :nome_original, :caminho)";

            $stmt = $this->conn->prepare($query);
            return $stmt->execute([
                ':nome' => $imagem['nome'],
                ':nome_original' => $imagem['nome_original'],
                ':caminho' => $imagem['caminho']
            ]);
        } catch (Exception $e) {
            var_dump($e);
            die('Erro ao criar Imagem');
        }
    }

    /**
     * Summary of listar
     * @return array
     */
    public function listar()
    {
        try {
            $query = "SELECT * FROM $this->table ORDER BY data_envio DESC";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            var_dump($e);
            die('Erro ao buscar Imagens');
        }
    }

    /**
     * Summary of buscarPorId
     * @param int $id
     * @return array
     */
    public function buscarPorId($id)
    {
        try {
            $query = "SELECT * FROM $this->table WHERE id = :id";

            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            var_dump($e);
            die('Erro ao buscar Imagem');
        }
    }
}