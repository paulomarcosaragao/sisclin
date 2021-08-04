<?php
// Classe de Cadastro, Alteração, Exclusão e View de Usuários

class Usuario {

	private $idusuario;
	private $var_email;
	private $var_nome;
	private $var_login;
	private $var_senha;
	private $int_grupousuario;
	private $int_idempresa;
	private $int_idprofissional;
	private $int_idundorganizacional;
	private $dt_cadastro;
	private $bol_ativo;

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setIdusuario($value){
		$this->idusuario=$value;
	}

	public function getVar_email(){
		return $this->var_email;
	}

	public function setVar_email($value){
		$this->var_email=$value;
	}

	public function getVar_nome(){
		return $this->var_nome;
	}

	public function setVar_nome($value){
		$this->var_nome=$value;
	}

	public function getVar_login(){
		return $this->var_login;
	}

	public function setVar_login($value){
		$this->var_login=$value;
	}

	public function getVar_senha(){
		return $this->var_senha;
	}

	public function setVar_senha($value){
		$this->var_senha=$value;
	}

	public function getInt_grupousuario(){
		return $this->int_grupousuario;
	}

	public function setInt_grupousuario($value){
		$this->int_grupousuario=$value;
	}

	public function getInt_idempresa(){
		return $this->int_idempresa;
	}

	public function setInt_idempresa($value){
		$this->int_idempresa=$value;
	}

	public function getInt_idprofissional(){
		return $this->int_idprofissional;
	}

	public function setInt_idprofissional($value){
		$this->int_idprofissional=$value;
	}

	public function getInt_idundorganizacional(){
		return $this->int_idundorganizacional;
	}

	public function setInt_idundorganizacional($value){
		$this->int_idundorganizacional=$value;
	}

	public function getDt_cadastro(){
		return $this->dt_cadastro;
	}

	public function setDt_cadastro($value){
		$this->dt_cadastro=$value;
	}

	public function getBol_ativo(){
		return $this->bol_ativo;
	}

	public function setBol_ativo($value){
		$this->bol_ativo=$value;
	}


	public function loadByidusuario($id){
		
		$sql = new Sql();
		
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(

            ":ID"=>$id

        ));


		if (count($results)>0) {
		
			$row = $results[0];
		
			$this->setData($results[0]);
		}
	}

	public static function getList(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY var_nome");
	}

	public static function search($login){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE var_login LIKE :SEARCH ORDER BY var_login", array(

            ':SEARCH'=>"%".$login."%"

        ));
	}

	public function login($login,$password){

		$sql = new Sql();
		
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE var_login = :LOGIN and var_senha = :PASSWORD", array(

            ":LOGIN"=>$login,
            ":PASSWORD"=>$password

        ));


        if (count($results)>0) {
		
			$row = $results[0];
		
			$this->setData($results[0]);

		} else {

			echo "<script>alert('Login ou senha inválido!')</script>";
			exit;

		}

	}

	public function setData($data) {

		$this->setIdusuario($data['idusuario']);
		$this->setVar_email($data['var_email']);
		$this->setVar_nome($data['var_nome']);
		$this->setVar_login($data['var_login']);
		$this->setVar_senha($data['var_senha']);
		$this->setInt_grupousuario($data['int_grupousuario']);
		$this->setInt_idempresa($data['int_idempresa']);
		$this->setInt_idprofissional($data['int_idprofissional']);
		$this->setInt_idundorganizacional($data['int_idundorganizacional']);
		$this->setDt_cadastro(new DateTime($data['dt_cadastro']));
		$this->setBol_ativo($data['bol_ativo']);

	}

	public function insert() {

		$sql = new Sql();

		$results = $sql->select("CALL sp_usuarios_insert( :EMAIL, :NOME, :LOGIN, :PASSWORD, :GRUPO, :EMPRESA, :PROFISSIONAL, :UO, :CADASTRO, :ATIVO )", array(
			':EMAIL'=>$this->getVar_email(),
			':NOME'=>$this->getVar_nome(),
			':LOGIN'=>$this->getVar_login(),
			':PASSWORD'=>$this->getVar_senha(),
			':GRUPO'=>$this->getInt_grupousuario(),
			':EMPRESA'=>$this->getInt_idempresa(),
			':PROFISSIONAL'=>$this->getInt_idprofissional(),
			':UO'=>$this->getInt_idundorganizacional(),
			':CADASTRO'=>$this->getDt_cadastro(),
			':ATIVO'=>$this->getBol_ativo()
		));


		if (count($results)>0) {

			$this->setData($results[0]);
		}

		

	}

	public function __toString(){
		
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"var_email"=>$this->getVar_email(),
			"var_login"=>$this->getVar_login(),
			"var_senha"=>$this->getVar_senha(),
			"int_grupousuario"=>$this->getInt_grupousuario(),
			"int_idempresa"=>$this->getInt_idempresa(),
			"int_idprofissional"=>$this->getInt_idprofissional(),
			"int_idundorganizacional"=>$this->getInt_idundorganizacional(),
			"dt_cadastro"=>$this->getDt_cadastro(),
			"bol_ativo"=>$this->getBol_ativo()
		));
	}

	
}


?>