<?php

namespace App\Services\semantic;

use Ajax\semantic\html\elements\HtmlLabel;
use App\Entity\Task;

class TasksGui extends SemanticGui{
    public function dataTable($tasks,$type){
        $dt=$this->_semantic->dataTable("dt-".$type, "App\Entity\Task", $tasks);
        $dt->setIdentifierFunction("getId");
        $dt->setFields(["Content","Story"]);

        $dt->addEditDeleteButtons(false, [ "ajaxTransition" => "random","hasLoader"=>false ], function ($bt) {
            $bt->addClass("circular");
        }, function ($bt) {
            $bt->addClass("circular");
        });
        $dt->onPreCompile(function () use (&$dt) {
            $dt->getHtmlComponent()->colRight(2);
        });
        $dt->setUrls(["edit"=>"tasks/edit","delete"=>"tasks/confirmDelete"]);
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