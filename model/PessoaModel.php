<?php 
$PATH = "/home//domains/public_html/salao_smart/";
require_once $PATH.'controller/PessoaController.php';
require_once $PATH.'database/connect.php';

class PessoaModel extends Connect{
    
    public function login(PessoaController $pessoa) {
        // logica para salvar dado no banco
        $st_query = "SELECT count(*) AS total, us.*
                     FROM pessoa us
                     WHERE status = 2 
                     AND email ='".$pessoa->getEmail()."'
                     AND senha ='".$pessoa->getSenha()."'
                     AND (tipo = 1 or tipo = 2)
                     LIMIT 1";
        try
        {
            $o_data = $this->o_db->query($st_query);
            $o_ret = $o_data->fetchObject();

            if($o_ret->total >0)
            {
                $pessoa = new PessoaController();
                $pessoa->setId($o_ret->id_pessoa);
                $pessoa->setNome($o_ret->nome);    
                $pessoa->setTipo($o_ret->tipo);    
                return $pessoa;
            }
            else
            {
                return false;
            }
            
        }
        catch (PDOException $e)
        {
            throw $e;
        }
    }

    public function dadosUsuario($cod) {
        // logica para salvar dado no banco
        $st_query = "SELECT *
                     FROM pessoa us
                     WHERE status = 2 
                     AND id_pessoa = $cod
                     LIMIT 1";
        try
        {
            $o_data = $this->o_db->query($st_query);
            $o_ret = $o_data->fetchObject();

            $pessoa = new PessoaController();
            $pessoa->setId($o_ret->id_pessoa);
            $pessoa->setNome($o_ret->nome);    
            $pessoa->setTipo($o_ret->tipo);   
            $pessoa->setEmail($o_ret->email);      
            $pessoa->setTelefone($o_ret->telefone);   
            $pessoa->setNascimento($o_ret->nascimento);    
            return $pessoa;
        }
        catch (PDOException $e)
        {
            throw $e;
        }
    }

    public function save(PessoaController $pessoa) {
        // logica para salvar dado no banco
        $st_query = "SELECT count(*) as total from pessoa where email = '".$pessoa->getEmail()."'";
        $o_data = $this->o_db->query($st_query);
        $o_ret = $o_data->fetchObject();
        $total = $o_ret->total;
        if($total > 0)
        {
            return false;
        }
        else
        {
            $st_query = "INSERT INTO pessoa
                        (
                            nome,
                            email,
                            senha,
                            status,
                            tipo,
                            telefone,
                            nascimento,
                            manicure,
                            pedicure,
                            cabelo,
                            maquiagem
                        )
                        VALUES
                        (
                            '".$pessoa->getNome()."',
                            '".$pessoa->getEmail()."',
                            '".$pessoa->getSenha()."',
                            '".$pessoa->getStatus()."',
                            '".$pessoa->getTipo()."',
                            '".$pessoa->getTelefone()."',
                            '".$pessoa->getNascimento()."',
                            '".$pessoa->getManicure()."',
                            '".$pessoa->getPedicure()."',
                            '".$pessoa->getCabelo()."',
                            '".$pessoa->getMaquiagem()."'
                        );";
            try
            {
                if($this->o_db->exec($st_query) > 0)
                    return $this->o_db->lastInsertId();
            }
            catch (PDOException $e)
            {
                throw $e;
            }
        }
        return false; 
    }
     
    public function update(PessoaController $pessoa) {
        // logica para atualizar dado no banco
        if($pessoa->getSenha())
        {
            $st_query = "UPDATE
                            pessoa
                        SET
                            nome = '".$pessoa->getNome()."',
                            email = '".$pessoa->getEmail()."',
                            senha = '".$pessoa->getSenha()."',
                            status = '".$pessoa->getStatus()."',
                            nascimento = '".$pessoa->getNascimento()."',
                            telefone = '".$pessoa->getTelefone()."',
                            manicure = '".$pessoa->getManicure()."',
                            pedicure = '".$pessoa->getPedicure()."',
                            cabelo = '".$pessoa->getCabelo()."',
                            maquiagem = '".$pessoa->getMaquiagem()."'
                        WHERE
                            id_pessoa =".$pessoa->getID();
        }
        else
        {
            $st_query = "UPDATE
                            pessoa
                        SET
                            nome = '".$pessoa->getNome()."',
                            email = '".$pessoa->getEmail()."',
                            status = '".$pessoa->getStatus()."',
                            nascimento = '".$pessoa->getNascimento()."',
                            telefone = '".$pessoa->getTelefone()."',
                            manicure = '".$pessoa->getManicure()."',
                            pedicure = '".$pessoa->getPedicure()."',
                            cabelo = '".$pessoa->getCabelo()."',
                            maquiagem = '".$pessoa->getMaquiagem()."'
                        WHERE
                            id_pessoa =".$pessoa->getID();
        }
        try
        {
            $this->o_db->exec($st_query);
            return true;
        }
        catch (PDOException $e)
        {
            throw $e;
            return false;
        }
    }

    public function updateByUser(PessoaController $pessoa) {
        // logica para atualizar dado no banco
        if($pessoa->getSenha())
        {
            $st_query = "UPDATE
                            pessoa
                        SET
                            nome = '".$pessoa->getNome()."',
                            email = '".$pessoa->getEmail()."',
                            senha = '".$pessoa->getSenha()."',
                            telefone = '".$pessoa->getTelefone()."',
                            nascimento = '".$pessoa->getNascimento()."'
                        WHERE
                            id_pessoa =".$pessoa->getID();
        }
        else
        {
            $st_query = "UPDATE
                            pessoa
                        SET
                            nome = '".$pessoa->getNome()."',
                            email = '".$pessoa->getEmail()."',
                            telefone = '".$pessoa->getTelefone()."',
                            nascimento = '".$pessoa->getNascimento()."'
                        WHERE
                            id_pessoa =".$pessoa->getID();

        }
        try
        {
            $this->o_db->exec($st_query);
            return true;
        }
        catch (PDOException $e)
        {
            throw $e;
            return false;
        }
    }

    public function remove($cod) {
        // logica para remover dado do banco
        $st_query = "DELETE FROM pessoa WHERE id_pessoa = $cod";
        if($this->o_db->exec($st_query) > 0)
            return true;
        else
            return false;
    }
     
    public function listAll($inicio, $limite, $filtro, $tipo) {
        // logica para listar toodos os dados do banco
        if($tipo == 1)
        {
            $filtro2 = " AND tipo = 1";
        }
        if($tipo == 2)
        {
            $filtro2 = " AND tipo = 2";
        }
        if($tipo == 3)
        {
            $filtro2 = " AND tipo = 3";
        }

        if($filtro)
        {
            $st_query = "SELECT * FROM pessoa WHERE nome LIKE '%$filtro%' OR email LIKE '%$filtro%' $filtro2";
        }
        else
        {
            $st_query = "SELECT * FROM pessoa where 1=1 $filtro2 LIMIT $inicio, $limite";
        }
         $dados = array();
        try
        {
            $o_data = $this->o_db->query($st_query);
            while($o_ret = $o_data->fetchObject())
            {
                $dado = new PessoaController();
                $dado->setId($o_ret->id_pessoa);
                $dado->setNome($o_ret->nome);
                $dado->setTipo($o_ret->tipo);
                array_push($dados, $dado);
            }
        }
        catch(PDOException $e)
        {
            die("Erro: <code>" . $i->getMessage() . "</code>");
        }             
        return $dados;
    } 

    public function contador($filtro, $tipo) {
        // logica para listar toodos os dados do banco
        if($tipo == 1)
        {
            $filtro2 = " AND tipo = 1";
        }
        if($tipo == 2)
        {
            $filtro2 = " AND tipo = 2";
        }
        if($tipo == 3)
        {
            $filtro2 = " AND tipo = 3";
        }

        if($filtro)
        {
            $st_query = "SELECT COUNT(*)AS total FROM pessoa WHERE nome LIKE '%$filtro%' OR nome LIKE '%$filtro%' $filtro2";
        }
        else
        {
            $st_query = "SELECT COUNT(*)AS total FROM pessoa where 1=1 $filtro2";
        }
        try
        {
            $o_data = $this->o_db->query($st_query);
            $o_ret = $o_data->fetchObject();
            $total = $o_ret->total;
            return $total;
        }
        catch(PDOException $e)
        {
            die("Erro: <code>" . $i->getMessage() . "</code>");
        }             
        return $dados;
    }

    public function listById($cod)
    {
        $pessoa = new PessoaController();
        $st_query = "SELECT * FROM pessoa WHERE id_pessoa = $cod";
        $o_data = $this->o_db->query($st_query);
        $o_ret = $o_data->fetchObject();
        $pessoa->setId($o_ret->id_pessoa);
        $pessoa->setNome($o_ret->nome);    
        $pessoa->setEmail($o_ret->email);    
        $pessoa->setStatus($o_ret->status);    
        $pessoa->setTelefone($o_ret->telefone);    
        $pessoa->setTipo($o_ret->tipo);    
        $pessoa->setNascimento($o_ret->nascimento);    
        $pessoa->setManicure($o_ret->manicure);   
        $pessoa->setPedicure($o_ret->pedicure);   
        $pessoa->setCabelo($o_ret->cabelo);   
        $pessoa->setMaquiagem($o_ret->maquiagem);       
        return $pessoa;
    }
}
?>