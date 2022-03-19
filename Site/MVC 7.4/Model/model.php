<?php
class Conexao
{
    const port = "3306";
    const host = "localhost";
    const dbname = "bd_carer_you";
    const user = "TCC_CARER_YOU";
    const password = "TCC-3DS2-2022";

    public static function getConnection(): PDO
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
    protected $dados;
    public function __construct($Dados)
    {
        $this->dados = $Dados;
    }

    public abstract function uploadArquivo();

    public function getNomeArquivo(): string
    {
        return time() . $this->dados['name'];
    }

    public abstract function getExtensao();
}

class PDF extends Arquivo
{


    public function getExtensao()
    {
        $pdfExplode = explode('.', $this->dados['name']);
        $pdfExt = end($pdfExplode);
        if ($pdfExt === "pdf") {
            return true;
        } else {
            return "Os arquivos precisam ser do tipo PDF";
        }
    }

    public function uploadArquivo()
    {
        if ($this->getExtensao() === true) {
            if (move_uploaded_file($this->dados['tmp_name'], "../../View/assets/archives/" . time() . $this->dados['name'])) {
                return true;
            } else {
                return "Erro ao fazer upload do arquivo";
            }
        } else {
            return $this->getExtensao();
        }
    }
}

class Imagem extends Arquivo
{

    public function getExtensao()
    {
        $imgExplod = explode('.', $this->dados['name']);
        $imgExt = end($imgExplod);
        if (in_array($imgExt, ['png', 'jpg', 'jpeg'])) {
            return true;
        } else {
            return "As imagens precisam ter a extensão jpg, png ou jpeg";
        }
    }

    public function uploadArquivo()
    {
        if ($this->getExtensao() == true) {
            if (move_uploaded_file($this->dados['tmp_name'], "../../View/assets/img/profile pic/" . time() . $this->dados['name'])) {
                return true;
            } else {
                return "Erro ao fazer upload da imagem";
            }
        } else {
            return $this->getExtensao();
        }
    }
}


class Usuario
{
    protected $nome;
    protected $email;
    protected $senha;
    protected $rg;
    protected $genero;
    protected $cidade;
    protected $tipoUsuario;
    protected $foto;
    public function __construct($Nome, $Email, $Senha, $RG, $Genero, $Cidade, $TipoUsuario, Imagem $Foto)
    {
        $this->nome = $Nome;
        $this->email = $Email;
        $this->senha = $Senha;
        $this->rg = $RG;
        $this->genero = $Genero;
        $this->cidade = $Cidade;
        $this->tipoUsuario = $TipoUsuario;
        $this->foto = $Foto;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRG()
    {
        return $this->rg;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getArquivoFoto()
    {
        return $this->foto;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function getTipo()
    {
        return $this->tipoUsuario;
    }
    public function getSha1Senha()
    {
        return sha1($this->senha);
    }
}

class Profissional extends Usuario
{
    private $certificado;

    public function setCertificado(PDF $arq)
    {
        $this->certificado = $arq;
    }

    public function getCertificado()
    {
        return $this->certificado;
    }
}

class UsuarioDAO
{
    protected $connection;
    public function __construct()
    {
        $this->connection = Conexao::getConnection();
    }

    public function verTiposUsuario()
    {
        $sql = $this->connection->query("SELECT * FROM TB_TIPO_USUARIO WHERE DS_TIPO_USUARIO !='Admin'");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ListaProfissionais()
    {
        $sql = $this->connection->query("SELECT * FROM VW_PROFISSIONAIS WHERE STATUS!='Em análise'");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verGeneros()
    {
        $sql = $this->connection->query("SELECT * FROM TB_GENERO_USUARIO");
        if (!$sql) {
            return "Não existem cuidadores...";
        } else {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function infoProfissional($id)
    {
        $sql = $this->connection->query("SELECT * FROM VW_PROFISSIONAIS WHERE ID_PROFISSIONAL = " . $id);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function ListaLocais()
    {
        $sql = $this->connection->query("SELECT * FROM VW_LOCAIS");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verCidades()
    {
        $sql = $this->connection->query("SELECT * FROM TB_CIDADE");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrarUsuario($u)
    {
        $sql = $this->connection->prepare("SELECT ID_USUARIO FROM TB_USUARIO WHERE DS_EMAIL = :EM");
        $sql->bindValue(":EM", $u->getEmail());
        $sql->execute();
        $res = $sql->fetch(PDO::FETCH_ASSOC);
        //Caso não exista algum usuario com o mesmo email
        if ($res === false) {
            //Cadastro para admin e cliente
            $stmt = $this->connection->prepare("CALL CADASTRAR_USUARIO(:NM, :EM, :SN, :RG, :FT, :GEN, :TP, :CID, :ARQ)");
            $stmt->bindValue(":NM", $u->getNome());
            $stmt->bindValue(":EM", $u->getEmail());
            $stmt->bindValue(":SN", $u->getSha1Senha());
            $stmt->bindValue(":RG", $u->getRG());
            $stmt->bindValue(":TP", $u->getTipo());
            $stmt->bindValue(":GEN", $u->getGenero());
            $stmt->bindValue(":CID", $u->getCidade());
            $img = $u->getArquivoFoto();
            if ($u->getTipo() !== "Profissional") {
                //Caso o upload da imgem tenha dado certo
                if ($img->uploadArquivo() === true) {
                    $stmt->bindValue(":FT", $img->getNomeArquivo());
                    $stmt->bindValue(":ARQ", '');
                    $stmt->execute();
                    return true;
                } else {
                    return $img->uploadArquivo();
                }
            }
            //Cadastro para Profissional
            else {
                $certificado = $u->getCertificado();
                if ($certificado->getExtensao() === true) {
                    if ($img->getExtensao() === true) {
                        $img->uploadArquivo();
                        $certificado->uploadArquivo();
                        $stmt->bindValue(":FT", $img->getNomeArquivo());
                        $stmt->bindValue(":ARQ", $certificado->getNomeArquivo());
                        $stmt->execute();
                        return true;
                    } else {
                        return $img->getExtensao();
                    }
                } else {
                    return $certificado->getExtensao();
                }
            }
        }
        //Se existir um usuario com o mesmo email
        else {
            return "O E-mail ja esta cadastrado";
        }
    }

    public function loginUsuario($email, $senha)
    {
        $sql = $this->connection->query("CALL LOGIN_USUARIO('" . $email . "', '" . sha1($senha) . "')");
        $res = $sql->fetch(PDO::FETCH_ASSOC);
        if ($res !== false) {
            session_start();
            $_SESSION['ID'] = $res['ID_USUARIO'];
            $_SESSION['TIPO'] = $res['DS_TIPO_USUARIO'];
            return true;
        } else {
            return false;
        }
    }
}

class AdminDAO extends UsuarioDAO
{
    public function UsuariosAnalise()
    {
        $sql = $this->connection->query("SELECT * FROM VW_PROFISSIONAIS WHERE STATUS = 'Em análise'");
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getDetalhesProfissional(int $id)
    {
        $sql = $this->connection->query("SELECT * FROM VW_PROFISSIONAIS WHERE ID_PROFISSIONAL =" . $id);
        $res = $sql->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function permitirProfissional(int $id): void
    {
        $sql = $this->connection->query("CALL APROVAR_PROFISSIONAL(" . $id . ")");
        $res = $sql->fetch(PDO::FETCH_ASSOC);
    }
}

$DAO = new UsuarioDAO();
