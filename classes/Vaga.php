<?php
    require_once "Conexao.php";

    class Vaga{
        private $idvaga;
        private $quantidade;
        private $c;

        function __construct()
        {
            $this->idvaga = 1;
            $this->quantidade = 0;
            $this->c = new Conexao();
        }

        

        /**
         * Get the value of idvaga
         */ 
        public function getIdvaga()
        {
                return $this->idvaga;
        }

        /**
         * Set the value of idvaga
         *
         * @return  self
         */ 
        public function setIdvaga($idvaga)
        {
                $this->idvaga = $idvaga;
        }

        /**
         * Get the value of quantidade
         */ 
        public function getQuantidade()
        {
                return $this->quantidade;
        }

        /**
         * Set the value of quantidade
         *
         * @return  self
         */ 
        public function setQuantidade($quantidade)
        {
                $this->quantidade = $quantidade;
        }

        function adicionar($culto){
            if($culto == 1){
                $con = $this->c->conectar();
                $sql = "UPDATE vagas SET quantidade = quantidade + :qtd WHERE idvaga = 1";
                $update = $con->prepare($sql);
                $update->bindParam(":qtd", $this->quantidade);
                $update->execute();
            } else {
                $con = $this->c->conectar();
                $sql = "UPDATE vagas SET quantidade = quantidade + :qtd WHERE idvaga = 2";
                $update = $con->prepare($sql);
                $update->bindParam(":qtd", $this->quantidade);
                $update->execute();
            }
            
        }
    }

?>