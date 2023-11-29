<?php
 /**
 * Classe Abstrata responsável por centralizar a conexão
 * com o banco de dados
 *
 * 
 * Diretório Pai - database
 * Arquivo - connect.php
 */
abstract class Connect
{
    /**
    * Variável responsável por guardar dados da conexão do banco
    * @var resource
    */
    protected $o_db;
      
    function __construct()
    {
        
        //Inicio de conexão com MySQL
        $st_host = 'localhost';
        $st_banco = '_smart';
        $st_usuario = '5135_smart';
        $st_senha = 'V6hhWz';
         
          
        $st_dsn = "mysql:host=$st_host;dbname=$st_banco";
        $this->o_db = new PDO
        (
            $st_dsn,
            $st_usuario,
            $st_senha
        );
        //Fim de conexão com MySQL
    }
}
?>