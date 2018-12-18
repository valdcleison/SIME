<?php 
namespace Sime\Controller;

use \Sime\Control;
use \Sime\Model\PlanosDao;

class Planos extends Control{

	public function salvarPlanos(){
		$planosDao = new PlanosDao();
		$planosDao->savePlanos($this);
	}

	public static function buscarPlanos(){
		
		return PlanosDao::buscarPlanos();
	}

	public function buscarPlanosPorId($id){
		$this->setData(PlanosDao::listById($id));

	}

	public function atualizarPlanos(){
		$planosDao = new PlanosDao();
		$planosDao->updatePlanos($this);

	}

	public function deletarPlanos(){
		$planosDao = new PlanosDao();
		$planosDao->deletePlanos($this);
	}
	
}




 ?>