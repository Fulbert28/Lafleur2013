<?php

class Address {
	private $_rue;
	private $_cp;
	private $_ville;
	
	function Address($rue,$cp,$ville) {
		$this->_rue=$rue;
		$this->_cp=$cp;
		$this->_ville=$ville;
	}

	public function get_rue()
	{
	    return $this->_rue;
	}

	public function set_rue($_rue)
	{
	    $this->_rue = $_rue;
	}

	public function get_cp()
	{
	    return $this->_cp;
	}

	public function set_cp($_cp)
	{
	    $this->_cp = $_cp;
	}

	public function get_ville()
	{
	    return $this->_ville;
	}

	public function set_ville($_ville)
	{
	    $this->_ville = $_ville;
	}
}

?>