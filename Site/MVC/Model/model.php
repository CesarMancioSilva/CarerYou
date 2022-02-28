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

abstract class Arquivo
{
    public function __construct(protected array $dados)
    {
    }

    public abstract function uploadArquivo();

    public function getNomeArquivo(): string
    {
        return time() . $this->dados['name'];
    }
}

class PDF extends Arquivo
{
    public function uploadArquivo(): string | bool
    {
        $pdfExplode = explode('.', $this->dados['name']);
        $pdfExt = end($pdfExplode);
        if (in_array($pdfExt, ['pdf'])) {
            if (move_uploaded_file($this->dados['tmp_name'], "../../View/assets/img/" . time() . $this->dados['name'])) {
                return true;
            } else {
                return "Erro ao fazer upload do arquivo";
            }
        } else {
            "Os arquivos precisam ser do tipo pdf";
        }
    }
}

class Imagem extends Arquivo
{
    public function uploadArquivo(): string | bool
    {
        $imgExplod = explode('.', $this->dados['name']);
        $imgExt = end($imgExplod);
        if (in_array($imgExt, ['png', 'jpg', 'jpeg'])) {
            if (move_uploaded_file($this->dados['tmp_name'], "../../View/assets/img/" . time() . $this->dados['name'])) {
                return true;
            } else {
                return "Erro ao fazer upload da imagem";
            }
        } else {
            return "As imagens precisam ter a extensão png, jpg ou jpeg";
        }
    }
}


class Usuario
{
    public function __construct(protected string $nome, protected string $email, protected string $senha, protected string $rg, protected string $genero, protected string $cidade, protected string $tipoUsuario, protected Imagem $foto)
    {
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRG(): string
    {
        return $this->rg;
    }

    public function getGenero(): string
    {
        return $this->genero;
    }

    public function getArquivoFoto(): Arquivo
    {
        return $this->foto;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function getTipo(): string
    {
        return $this->tipoUsuario;
    }
    public function getSha1Senha(): string
    {
        return sha1($this->senha);
    }
}

class Profissional extends Usuario
{
    private PDF $certificado;

    public function setCertificado(PDF $arq)
    {
        $this->certificado = $arq;
    }
}

class UsuarioDAO
{
    private PDO $connection;
    public function __construct()
    {
        $this->connection = Conexao::getConnection();
    }

    public function verTiposUsuario(): array
    {
        $sql = $this->connection->query("SELECT * FROM TB_TIPO_USUARIO WHERE DS_TIPO_USUARIO !='Admin'");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
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

    public function cadastrarUsuario(Usuario $u): string | bool
    {
        $sql = $this->connection->prepare("SELECT ID_USUARIO FROM TB_USUARIO WHERE DS_EMAIL = :EM");
        $sql->bindValue(":EM", $u->getEmail());
        $sql->execute();
        $res = $sql->fetch(PDO::FETCH_ASSOC);
        if ($res === false) {
            $stmt = $this->connection->prepare("CALL CADASTRAR_USUARIO(:NM, :EM, :SN, :RG, :FT, :TP, :GEN, :CID)");
            $imgName = $u->getArquivoFoto();
            $upload = $imgName->uploadArquivo();
            if ($upload === true) {
                $imgName = $imgName->getNomeArquivo();
                $stmt->bindValue(":NM", $u->getNome());
                $stmt->bindValue(":EM", $u->getEmail());
                $stmt->bindValue(":SN", $u->getSha1Senha());
                $stmt->bindValue(":RG", $u->getRG());
                $stmt->bindValue(":FT", $imgName);
                $stmt->bindValue(":TP", $u->getTipo());
                $stmt->bindValue(":GEN", $u->getGenero());
                $stmt->bindValue(":CID", $u->getCidade());
                $stmt->execute();
                $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return true;
            } else {
                return $upload;
            }
        } else {
            return "O E-mail ja esta cadastrado";
        }
    }
}

$DAO = new UsuarioDAO();
