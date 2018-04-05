<?php
namespace App\Services\semantic;

use Ajax\php\symfony\JquerySemantic;
use Ajax\semantic\html\content\view\HtmlItem;

class SemanticGui extends JquerySemantic{
	protected function initialize(){
		$this->setAjaxLoader("<div class=\"ui active centered inline text loader\">Loading</div>");
	}
	
	/**
	 * @param object $objects
	 * @param string $type
	 */
	public function dataTable($objects,$type){
		
	}
	/**
	 * @param object $object
	 * @param string $type
	 */
	public function dataForm($object,$type){
		
	}

	/**
	 * @param string $content
	 * @param string $type
	 * @param string $icon
	 * @return \Ajax\semantic\html\collections\HtmlMessage
	 */
	public function message($content,$type="info",$icon=null){
		$msg= $this->_semantic->htmlMessage("msg",$content,$type);
		if(isset($icon))
			$msg->setIcon($icon);
		return $msg;
	}
	
	/**
	 * @param string $message
	 * @param string $type
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function messageConfirmation($message,$type="info"){
		return $this->renderView("Components/confirmation.html.twig",compact("message","type"));
	}
	
	/**
	 * @param string $content
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function simpleElement($content){
		return $this->renderView("Components/simple.html.twig",["element"=>$content]);
	}
	
	/**
	 * @param callable $callback
	 * @param object $object
	 * @param string $successMessage
	 * @param string $errorMessage
	 * @param string $refreshUrl
	 * @param string $refreshElement
	 * @param array $refreshAttributes
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function realizeOperation($callback,$object,$successMessage,$errorMessage,$refreshUrl,$refreshElement,$refreshAttributes=["jqueryDone"=>"replaceWith","hasLoader"=>false,"attr"=>""]){
		if($callback($object)){
			$msg=$this->message($successMessage,"success","info circle");
			$this->get($refreshUrl,$refreshElement,$refreshAttributes);
		}else{
			$msg=$this->message($errorMessage,"warning","warning circle");
		}
		return $this->simpleElement($msg);
	}
	
	/**
	 * @param string $title
	 * @param string $subHeader
	 * @param string $icon
	 * @return \Ajax\semantic\html\elements\HtmlHeader
	 */
	public function getHeader($title,$subHeader,$icon){
		$semantic=$this->_semantic;
		$header=$semantic->htmlHeader("header", 3);
		$header->asTitle($title, $subHeader);
		$header->addIcon($icon);
		return $header;
	}
}