<?php 
namespace App\Services\semantic;



class DevelopersGui extends SemanticGui{
	
	public function dataTable($developers,$type){
		$dt=$this->_semantic->dataTable("dt-".$type, "App\Entity\Developer", $developers);
		$dt->setIdentifierFunction("getId");
		$dt->setFields(["identity"]);
		$dt->addEditDeleteButtons(false, [ "ajaxTransition" => "random","hasLoader"=>false ], function ($bt) {
			$bt->addClass("circular");
		}, function ($bt) {
			$bt->addClass("circular");
		});
		$dt->onPreCompile(function () use (&$dt) {
			$dt->getHtmlComponent()->colRight(1);
		});
		$dt->setUrls(["edit"=>"developers/edit","delete"=>"developers/confirmDelete"]);
		$dt->setTargetSelector("#frm");
		return $dt;
	}
	
	public function dataForm($developer,$type,$di=null){
		$df=$this->_semantic->dataForm("frm-".$type,$developer);
		$df->setFields(["identity\n","id\n","identity"]);
		$df->setCaptions(["Modification","","Identity"]);
		$df->fieldAsMessage(0,["icon"=>"info circle"]);
		$df->fieldAsHidden(1);
		$df->fieldAsInput("identity",["rules"=>"empty"]);
		$df->setValidationParams(["on"=>"blur","inline"=>true]);
		$df->setSubmitParams("developers/update","#frm",["attr"=>"","hasLoader"=>false]);
		return $df;
	}
	
}