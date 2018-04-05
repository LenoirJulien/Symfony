<?php

namespace App\Services\semantic;

use Ajax\semantic\html\elements\HtmlLabel;
use App\Entity\Tag;
use Ajax\semantic\html\base\constants\Color;

class TagsGui extends SemanticGui{
	public function dataTable($tags,$type){
		$dt=$this->_semantic->dataTable("dt-".$type, "App\Entity\Tag", $tags);
            $dt->setIdentifierFunction("getId");
		$dt->setFields(["tag"]);
		//$dt->setCaptions(["Tag"]);
		$dt->setValueFunction("tag", function($v,$tag){
			$lbl=new HtmlLabel("",$tag->getTitle());
			$lbl->setColor($tag->getColor());
			return $lbl;
		});
        $dt->addEditDeleteButtons(false, [ "ajaxTransition" => "random","hasLoader"=>false ], function ($bt) {
            $bt->addClass("circular");
        }, function ($bt) {
            $bt->addClass("circular");
        });
        $dt->onPreCompile(function () use (&$dt) {
            $dt->getHtmlComponent()->colRight(1);
        });
        $dt->setUrls(["edit"=>"tags/edit","delete"=>"tags/confirmDelete"]);
        $dt->setTargetSelector("#frm");
        return $dt;
	}

	public function dataForm($tag,$di=null){
		$colors=Color::getConstants();
		$frm=$this->_semantic->dataForm("frm-tags", $tag);
		$frm->setFields(["id","title","color","submit","cancel"]);
		$frm->setCaptions(["","Title","Color","Valider","Annuler"]);
		$frm->fieldAsHidden("id");
		$frm->fieldAsInput("title",["rules"=>["empty","maxLength[30]"]]);
		$frm->fieldAsDropDown("color",\array_combine($colors,$colors));
		$frm->setValidationParams(["on"=>"blur","inline"=>true]);
		$frm->onSuccess("$('#frm-tag').hide();");
		$frm->fieldAsSubmit("submit","positive","tags/submit", "#dt-tags",["ajax"=>["attr"=>"","jqueryDone"=>"replaceWith"]]);
		$frm->fieldAsLink("cancel",["class"=>"ui button cancel"]);
		$this->click(".cancel","$('#frm-tag').hide();");
		$frm->addSeparatorAfter("color");
		return $frm;
	}
}

