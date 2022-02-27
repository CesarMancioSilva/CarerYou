<?php
class Conexao
{
    const port = "3306";
    const host = "localhost";
    const dbname = "db_carer_you";
    const user = "carer_you";
    const password = "22042003";

    public static function getConnection(): PDO | null
    {
        try {
            $connection = new PDO("mysql:host=" . self::host . ":" . self::port . ";dbname=" . self::dbname, self::user, self::password);
            return $connection;
        } catch (PDOException $ex) {
            echo $ex;
        } catch (Exception $ex) {
            echo $ex;
        }
    }
}

class Usuario
{
    public function __construct(private string $nome, private string $email, private string $senha, private string $rg, private string $genero, private string $cidade, private string $tipoUsuario)
    {
    }
}

class UsuarioDAO
{
    private PDO $connection;
    public function __construct()
    {
        $this->connection = Conexao::getConnection();
    }

    public function verGeneros(): array
    {
        $sql = $this->connection->query("SELECT * FROM TB_GENERO_USUARIO");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verCidades(): array
    {
        $sql = $this->connection->query("SELECT * FROM TB_CIDADE");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}

$DAO = new UsuarioDAO();
