<?php

class Client extends Entity {
	
	private $_id;
	private $_nom;
	private $_prenom;
	private $_adress;
	
	function Client(array $params=null) {
	
		$this->lierDB("Client","client");
	
		//var_dump($params);
	
		if(isset($params)){
			$this->_id=$params[0];
			$this->_nom=$params[1];
			$this->_prenom=$params[2];
			
			$sonadresse=new Address($params[3], $params[4], $params[5]);
			
			$this->_adress=$sonadresse;
		}
	
	}
	

	public function get_id()
	{
	    return $this->_id;
	}

	public function set_id($_id)
	{
	    $this->_id = $_id;
	}

	public function get_nom()
	{
	    return $this->_nom;
	}

	public function set_nom($_nom)
	{
	    $this->_nom = $_nom;
	}

	public function get_prenom()
	{
	    return $this->_prenom;
	}

	public function set_prenom($_prenom)
	{
	    $this->_prenom = $_prenom;
	}

	public function get_adress()
	{
	    return $this->_adress;
	}

	public function set_adress($_adress)
	{
	    $this->_adress = $_adress;
	}
}

?>