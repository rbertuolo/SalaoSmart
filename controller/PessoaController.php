<?php 

class PessoaController {
    private $ID;
	private $TIPO;
	private $STATUS;
	private $NOME;
    private $EMAIL;
    private $SENHA;
    private $TELEFONE;
    private $NASCIMENTO;
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

    public function setNome( $Nome )
    {
        $this->Nome = $Nome;
        return $this;
    }
      
    public function getNome()
    {
        return $this->Nome;
    }

    public function getTipo()
    {
        return $this->Tipo;
    }
     
    public function setTipo($Tipo)
    {
        return $this->Tipo = $Tipo;
    }

    public function getStatus()
    {
        return $this->Status;
    }
     
    public function setStatus($Status)
    {
        return $this->Status = $Status;
    }

    public function getEmail()
    {
        return $this->Email;
    }
     
    public function setEmail($Email)
    {
        return $this->Email = $Email;
    }

    public function getSenha()
    {
        return $this->Senha;
    }
     
    public function setSenha($Senha)
    {
        return $this->Senha = $Senha;
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

    public function getNascimento()
    {
        return $this->Nascimento;
    }
    
    public function setNascimento($Nascimento)
    {
        return $this->Nascimento = $Nascimento;
    }

    public function getTelefone()
    {
        return $this->Telefone;
    }
    
    public function setTelefone($Telefone)
    {
        return $this->Telefone = $Telefone;
    }
}

?>