<?php 
namespace Sime;

use Rain\Tpl;


class Page{
	private $tpl;
	private $options = [];
	private $def = [
		"header"=>true,
		"footer"=>true,
		"data"=>[]
	];
	
	public function __construct($dir = "/views/", $opts = array()){
		$this->options = array_merge($this->def, $opts);

		$config = array(
			"tpl_dir"=>$_SERVER["DOCUMENT_ROOT"].$dir,
			"cache_dir"=>$_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"=>false
		);

		Tpl::configure($config);

		$this->tpl = new Tpl();

		$this->setData($this->options['data']);
		
		if($this->options['header'] === true) $this->tpl->draw("header");
	}

	public function setTpl($name, $data = array(), $returnHTML = false){
		
		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML);

	}

	private function  setData($data = array()){

		foreach ($data as $key => $value) {

			$this->tpl->assign($key, $value);

		}

	}

	public function __destruct(){

		if($this->options['footer'] === true)$this->tpl->draw("footer");

	}
}


 ?>