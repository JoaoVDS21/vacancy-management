<?php
    require_once "Conexao.php";

    class Inscricao{
        private $idinscricao;
        private $nome;
        private $sobreNome;
        private $cnoite;
        private $c;

        function __construct()
        {
            $this->idinscricao = 0;
            $this->nome = "";
            $this->sobreNome = "";
            $this->cnoite = 1;
            $this->c = new Conexao();
        }

        /**
         * Get the value of idinscricao
         */ 
        public function getIdinscricao()
        {
                return $this->idinscricao;
        }

        /**
         * Set the value of idinscricao
         *
         * @return  self
         */ 
        public function setIdinscricao($idinscricao)
        {
                $this->idinscricao = $idinscricao;
        }

        /**
         * Get the value of nome
         */ 
        public function getNome()
        {
                return $this->nome;
        }

        /**
         * Set the value of nome
         *
         * @return  self
         */ 
        public function setNome($nome)
        {
                $this->nome = $nome;
        }

         /**
         * Get the value of sobreNome
         */ 
        public function getSobreNome()
        {
                return $this->sobreNome;
        }

        /**
         * Set the value of sobreNome
         *
         * @return  self
         */ 
        public function setSobreNome($sobreNome)
        {
                $this->sobreNome = $sobreNome;
        }

        /**
         * Get the value of cnoite
         */ 
        public function getCnoite()
        {
                return $this->cnoite;
        }

        /**
         * Set the value of cnoite
         *
         * @return  self
         */ 
        public function setCnoite($cnoite)
        {
                $this->cnoite = $cnoite;
        }

        function cadastrar(){
            $conexao = $this->c->conectar();
            $sql = "INSERT INTO inscricoes VALUES(0, :nome, :sobrenome, ".$this->cnoite.")";
            $insert = $conexao->prepare($sql);
            $insert->bindParam(":nome", $this->nome);
            $insert->bindParam(":sobrenome", $this->sobreNome);
            $insert->execute();

            if($this->cnoite == 1){
                $sql = "UPDATE vagas SET quantidade = quantidade - 1 WHERE idvaga = 1";
                $update = $conexao->prepare($sql);
                $update->execute();
            } else if($this->cnoite == 0){
                $sql = "UPDATE vagas SET quantidade = quantidade - 1 WHERE idvaga = 2";
                $update = $conexao->prepare($sql);
                $update->execute();
            }
            
        }

        function deletar(){
            $con = new Conexao();

            $sql = $con->conectar()->prepare("SELECT cnoite FROM inscricoes WHERE idinscricao = :id");
            $sql->bindParam(":id", $this->idinscricao);
            $sql->execute();
            $dado = $sql->fetch(PDO::FETCH_OBJ);
            if($dado->cnoite == 1){
                $sql = "UPDATE vagas SET quantidade = quantidade + 1 WHERE idvaga = 1";
                $update = $con->conectar()->prepare($sql);
                $update->execute();
            } else if($dado->cnoite == 0){
                $sql = "UPDATE vagas SET quantidade = quantidade + 1 WHERE idvaga = 2";
                $update = $con->conectar()->prepare($sql);
                $update->execute();
            }

            $sql = "DELETE FROM inscricoes WHERE idinscricao = :id";
            $del = $con->conectar()->prepare($sql);
            $del->bindParam(":id", $this->idinscricao);
            $del->execute();

            $sql = "ALTER TABLE inscricoes DROP idinscricao";
            $alter = $con->conectar()->prepare($sql);
            $alter->execute();

            $sql = "ALTER TABLE inscricoes ADD idinscricao INT(11) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`idinscricao`)";
            $alter = $con->conectar()->prepare($sql);
            $alter->execute();
        }

        function deleteAll(){
            $con = new Conexao();
            $sql = "DELETE FROM inscricoes";
            $del = $con->conectar()->prepare($sql);
            $del->execute();

            $sql = "UPDATE vagas SET quantidade = 50 WHERE idvaga = 1";
            $update = $con->conectar()->prepare($sql);
            $update->execute();

            $sql = "UPDATE vagas SET quantidade = 50 WHERE idvaga = 2";
            $update = $con->conectar()->prepare($sql);
            $update->execute();

            $sql = "ALTER TABLE inscricoes DROP idinscricao";
            $alter = $con->conectar()->prepare($sql);
            $alter->execute();

            $sql = "ALTER TABLE inscricoes ADD idinscricao INT(11) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`idinscricao`)";
            $alter = $con->conectar()->prepare($sql);
            $alter->execute();
        }

        function deleteAllManha(){
            $con = new Conexao();
            $sql = "DELETE FROM inscricoes WHERE cnoite = 0";
            $del = $con->conectar()->prepare($sql);
            $del->execute();

            $sql = "UPDATE vagas SET quantidade = 50 WHERE idvaga = 2";
            $update = $con->conectar()->prepare($sql);
            $update->execute();

            $sql = "ALTER TABLE inscricoes DROP idinscricao";
            $alter = $con->conectar()->prepare($sql);
            $alter->execute();

            $sql = "ALTER TABLE inscricoes ADD idinscricao INT(11) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`idinscricao`)";
            $alter = $con->conectar()->prepare($sql);
            $alter->execute();
        }

        function consulta(){
            $con = new Conexao();
            $con = $con->conectar();
            $sql = "SELECT distinct nome, sobrenome, count(*) 'qtd' FROM inscricoes WHERE nome = :n AND sobrenome = :sn";
            $select = $con->prepare($sql);
            $select->bindParam(':n', $this->nome);
            $select->bindParam(':sn', $this->sobreNome);
            $select->execute();
            $res = $select->fetchAll(PDO::FETCH_OBJ);
            foreach($res as $dado){
                if($dado->qtd == 0){
                    return true;
                } else{
                    return false;
                }
            }
        }

        
    }
?>