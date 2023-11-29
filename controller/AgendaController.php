<?php 

class AgendaController {
    private $ID;
    private $IDPESSOA;
    private $DATA;
    private $HORAINICIO;
    private $IDCLIENTE;
    private $HORAFINAL;
    private $STATUS;
    private $NOMEPROFISSIONAL;
    private $MANICURE;
    private $PEDICURE;
    private $CABELO;
    private $MAQUIAGEM;

    public function setId( $ID )
    {
        $this->ID = $ID;
        return $this;
    }
      
    public function getId()
    {
        return $this->ID;
    }

    public function getIdCliente()
    {
        return $this->idCliente;
    }
    
    public function setIdCliente($idCliente)
    {
        return $this->idCliente = $idCliente;
    }

    public function getMaquiagem()
    {
        return $this->maquiagem;
    }
    
    public function setMaquiagem($maquiagem)
    {
        return $this->maquiagem = $maquiagem;
    }

    public function getCabelo()
    {
        return $this->Cabelo;
    }
    
    public function setCabelo($Cabelo)
    {
        return $this->Cabelo = $Cabelo;
    }

    public function getPedicure()
    {
        return $this->Pedicure;
    }
    
    public function setPedicure($Pedicure)
    {
        return $this->Pedicure = $Pedicure;
    }

    public function getManicure()
    {
        return $this->Manicure;
    }
    
    public function setManicure($Manicure)
    {
        return $this->Manicure = $Manicure;
    }

    public function getNomeProfissional()
    {
        return $this->NomeProfissional;
    }
    
    public function setNomeProfissional($NomeProfissional)
    {
        return $this->NomeProfissional = $NomeProfissional;
    }

    public function getStatus()
    {
        return $this->Status;
    }
    
    public function setStatus($Status)
    {
        return $this->Status = $Status;
    }

    public function getHoraFinal()
    {
        return $this->HoraFinal;
    }
    
    public function setHoraFinal($HoraFinal)
    {
        return $this->HoraFinal = $HoraFinal;
    }

    public function getHoraInicio()
    {
        return $this->HoraInicio;
    }
    
    public function setHoraInicio($HoraInicio)
    {
        return $this->HoraInicio = $HoraInicio;
    }

    public function getData()
    {
        return $this->Data;
    }
    
    public function setData($Data)
    {
        return $this->Data = $Data;
    }

    public function getIdPessoa()
    {
        return $this->IdPessoa;
    }
    
    public function setIdPessoa($IdPessoa)
    {
        return $this->IdPessoa = $IdPessoa;
    }
}

?>