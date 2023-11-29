<?php 
$PATH = "/home//domains/public_html/salao_smart/";
require_once $PATH.'controller/AgendaController.php';
require_once $PATH.'database/connect.php';

class AgendaModel extends Connect{
    
    public function save(AgendaController $agenda) {
        // logica para salvar dado no banco
        $st_query = "SELECT count(*) as total from agenda where data = '".$agenda->getData()."' AND id_pessoa = '".$agenda->getIdPessoa()."' AND hora_inicio = '".$agenda->getHoraInicio()."'";
        $o_data = $this->o_db->query($st_query);
        $o_ret = $o_data->fetchObject();
        $total = $o_ret->total;
        if($total > 0)
        {
            return false;
        }
        else
        {
            $st_query = "INSERT INTO agenda
                        (
                            id_pessoa,
                            data,
                            hora_inicio,
                            hora_final,
                            status
                        )
                        VALUES
                        (
                            '".$agenda->getIdPessoa()."',
                            '".$agenda->getData()."',
                            '".$agenda->getHoraInicio()."',
                            '".$agenda->getHoraFinal()."',
                            '".$agenda->getStatus()."'
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
     
    public function update(AgendaController $agenda) {
        // logica para atualizar dado no banco
        $st_query = "UPDATE
                        agenda
                    SET
                        id_pessoa = '".$agenda->getIdPessoa()."',
                        data = '".$agenda->getData()."',
                        hora_inicio = '".$agenda->getHoraInicio()."',
                        hora_final = '".$agenda->getHoraFinal()."',
                        status = '".$agenda->getStatus()."'
                    WHERE
                        id_agenda =".$agenda->getID();
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

    public function updateStatus(AgendaController $agenda) {
        // logica para atualizar dado no banco
        $st_query = "UPDATE
                        agenda
                    SET
                        status = '".$agenda->getStatus()."',
                        id_cliente = '".$agenda->getIdCliente()."'
                    WHERE
                        id_agenda = '".$agenda->getId()."'";
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
        $st_query = "DELETE FROM agenda WHERE id_agenda = $cod";
        if($this->o_db->exec($st_query) > 0)
            return true;
        else
            return false;
    }

    public function listAll($pessoa, $data) 
    {
        if($data) $filtro = " AND data = '".$data."'";
        if($pessoa) $filtro2 = " AND ag.id_pessoa = '".$pessoa."'";
        
        $st_query = "SELECT ag.*, ps.nome as pessoanome 
                     FROM agenda ag
                     INNER JOIN pessoa ps ON (ps.id_pessoa = ag.id_pessoa)
                     WHERE 1=1
                     $filtro2
                     $filtro 
                     ORDER BY data, hora_inicio";

        $dados = array();
        try
        {
            $o_data = $this->o_db->query($st_query);
            while($o_ret = $o_data->fetchObject())
            {
                $dado = new AgendaController();
                $dado->setIdPessoa($o_ret->id_pessoa);
                $dado->setNomeProfissional($o_ret->pessoanome);
                $dado->setId($o_ret->id_agenda);
                $dado->setData(($o_ret->data));
                $dado->setHoraInicio($o_ret->hora_inicio);
                $dado->setHoraFinal($o_ret->hora_final);
                $dado->setStatus($o_ret->status);
                array_push($dados, $dado);
            }
        }
        catch(PDOException $e)
        {
            die("Erro: <code>" . $i->getMessage() . "</code>");
        }             
        return $dados;
    }

    public function listLivres($pessoa, $data) 
    {
        if($data) $filtro = " AND data = '".$data."'";
        if($pessoa) $filtro2 = " AND ag.id_pessoa = '".$pessoa."'";
        
        $st_query = "SELECT ag.*, ps.nome as pessoanome, ps.manicure as manicure, ps.pedicure as pedicure, ps.cabelo as cabelo, ps.maquiagem as maquiagem
                     FROM agenda ag
                     INNER JOIN pessoa ps ON (ps.id_pessoa = ag.id_pessoa)
                     WHERE ag.status = 2
                     $filtro 
                     $filtro2
                     ORDER BY data, hora_inicio";

        $dados = array();
        try
        {
            $o_data = $this->o_db->query($st_query);
            while($o_ret = $o_data->fetchObject())
            {
                $dado = new AgendaController();
                $dado->setIdPessoa($o_ret->id_pessoa);
                $dado->setNomeProfissional($o_ret->pessoanome);
                $dado->setId($o_ret->id_agenda);
                $dado->setData(($o_ret->data));
                $dado->setHoraInicio($o_ret->hora_inicio);
                $dado->setHoraFinal($o_ret->hora_final);
                $dado->setStatus($o_ret->status);
                $dado->setManicure($o_ret->manicure);   
                $dado->setPedicure($o_ret->pedicure);   
                $dado->setCabelo($o_ret->cabelo);   
                $dado->setMaquiagem($o_ret->maquiagem);       
                array_push($dados, $dado);
            }
        }
        catch(PDOException $e)
        {
            die("Erro: <code>" . $i->getMessage() . "</code>");
        }             
        return $dados;
    } 

    public function agrupamentoDatas() {
        // logica para listar toodos os dados do banco
        
        $st_query = "SELECT data
                     FROM agenda
                     GROUP BY data
                     ORDER BY data";

        $dados = array();
        try
        {
            $o_data = $this->o_db->query($st_query);
            while($o_ret = $o_data->fetchObject())
            {
                $dado = new AgendaController();
                $dado->setData(($o_ret->data));
                array_push($dados, $dado);
            }
        }
        catch(PDOException $e)
        {
            die("Erro: <code>" . $i->getMessage() . "</code>");
        }             
        return $dados;
    } 

    public function quantidadeAgendamentos($id) {
        // logica para listar toodos os dados do banco
        
        $st_query = "SELECT count(*) as total
                     FROM agenda
                     where status = 1
                     and id_cliente = $id";

        try
        {
            $o_data = $this->o_db->query($st_query);
            $o_ret = $o_data->fetchObject();
            return $o_ret->total;
        }
        catch(PDOException $e)
        {
            die("Erro: <code>" . $i->getMessage() . "</code>");
        }             
    } 

    public function listById($cod)
    {
        $agenda = new AgendaController();
        $st_query = "SELECT * FROM agenda WHERE id_agenda = $cod";
        $o_data = $this->o_db->query($st_query);
        $o_ret = $o_data->fetchObject();
        $agenda = new AgendaController();
        $agenda->setIdPessoa($o_ret->id_pessoa);
        $agenda->setId($o_ret->id_agenda);
        $agenda->setData(($o_ret->data));
        $agenda->setHoraInicio($o_ret->hora_inicio);
        $agenda->setHoraFinal($o_ret->hora_final);
        $agenda->setStatus($o_ret->status);  
        return $agenda;
    }
}
?>