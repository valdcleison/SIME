<?php 
namespace Sime\Controller;

use \Sime\Control;
use \Sime\Model\PlanosDao;

class Planos extends Control{

	
	public static function buscarPlanos(){
		return PlanosDao::buscarPlanos();
	}
	
}




 ?>