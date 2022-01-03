<?php
    require_once "Conexao.php";

    class Usuario{
        private $idusuario;
        private $nome;
        private $login;
        private $senha;
        private $c;

        function __construct()
        {
            $this->idusuario = 0;
            $this->nome = "";
            $this->login = "";
            $this->senha = "";
            $this->c = new Conexao();
        }

        /**
         * Get the value of idusuario
         */ 
        public function getIdusuario()
        {
                return $this->idusuario;
        }

        /**
         * Set the value of idusuario
         *
         * @return  self
         */ 
        public function setIdusuario($idusuario)
        {
                $this->idusuario = $idusuario;
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
         * Get the value of login
         */ 
        public function getLogin()
        {
                return $this->login;
        }

        /**
         * Set the value of login
         *
         * @return  self
         */ 
        public function setLogin($login)
        {
                $this->login = $login;

                return $this;
        }

        /**
         * Get the value of senha
         */ 
        public function getSenha()
        {
                return $this->senha;
        }

        /**
         * Set the value of senha
         *
         * @return  self
         */ 
        public function setSenha($senha)
        {
                $this->senha = $senha;
        }

        function logar(){
            $conexao = $this->c->conectar();
            $sql = "SELECT idusuario, count(*) 'qtd' FROM usuario WHERE login = :login AND senha = :senha ";
            $comando = $conexao->prepare($sql);
            $comando->bindParam(':login', $this->login);
            $comando->bindParam(':senha', $this->senha);
            $comando->execute();
            $dados = $comando->fetch(PDO::FETCH_OBJ);
            if ($dados->qtd == 1){
                session_start();
                $_SESSION['idusuario'] = $dados->idusuario;
                return true;
            } else {
                return false;
            }
        }
    }

?>