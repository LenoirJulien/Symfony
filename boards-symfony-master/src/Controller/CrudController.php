<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Services\semantic\SemanticGui;

/**
 * Abstract controller for all CRUD operation
 * use this class
 * @author jc
 *
 */
abstract class CrudController extends AbstractController{
	protected $type;
	protected $icon;
	protected $subHeader;
	/**
	 * @var SemanticGui
	 */
	protected $gui;
	protected $repository;

    /**
     * Default page : list all objects
     * Require the view {type}\index.html.twig
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function _index(){
    	$this->gui->getHeader(ucfirst($this->type),$this->subHeader, $this->icon);
    	$objects=$this->repository->findAll();
    	$this->gui->dataTable($objects,$this->type);
    	$this->gui->getOnClick("#add-{$this->type}-btn", $this->type."/new","#frm",["attr"=>"","hasLoader"=>false]);
    	return $this->gui->renderView($this->type."/index.html.twig");
    }
    
    /**
     * Refresh the dataTable 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function _refresh(){
    	$objects=$this->repository->findAll();
    	$dt=$this->gui->dataTable($objects,$this->type);
    	return $this->gui->simpleElement($dt);
    }
    
    /**
     * @param mixed $id
     * @param mixed $di
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function _edit($id,$di=null){
    	$object=$this->repository->find($id);
    	$this->gui->dataForm($object,$this->type,$di);
    	$this->gui->execOn("click", "#cancel-btn", '$("#frm").html("");');
    	$this->gui->execOn("click", "#validate-btn", '$("#frm-'.$this->type.'").form("submit");');
    	return $this->gui->renderView($this->type."/frm.html.twig");
    }
    
    /**
     * Require the view {type}\frm.html.twig
     * @param string $className
     * @param mixed $di
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function _add($className,$di=null){
    	$object=new $className();
    	$this->gui->dataForm($object,$this->type,$di);
    	$this->gui->execOn("click", "#cancel-btn", '$("#frm").html("");');
    	$this->gui->execOn("click", "#validate-btn", '$("#frm-'.$this->type.'").form("submit");');
    	return $this->gui->renderView($this->type."/frm.html.twig");
    }

    /**
     * @param Request $request
     * @param string $className
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function _update(Request $request,$className){
    	$op="add";
    	$id=$request->get("id");
    	if(isset($id) && $id!=""){
    		$object=$this->repository->find($id);
    	}else{
    		$object=new $className();
    	}
    	$this->_setValues($object, $request);
    	return $this->gui->realizeOperation(function($obj){
    		return $this->repository->update($obj);
    	},$object, "<b>{$object}</b> has been updated !", "impossible to update <b>{$object}</b> !",$this->type."/refresh","#dt-".$this->type );
    }
    
    /**
     * @param object $instance
     * @param Request $request
     */
    protected function _setValues($instance,Request $request){
    	$this->repository->setValuesToObject($instance,$request->request->all());
    }
    
    /**
     * @param mixed $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function _deleteConfirm($id){
    	$object=$this->repository->find($id);
    	$this->gui->execOn("click", "#cancel-btn", '$("#frm").html("");');
    	$this->gui->getOnClick("#confirm-btn", $this->type."/delete/".$id,"#frm",["attr"=>""]);
    	return $this->gui->messageConfirmation("Remove <b>{$object}</b> from the database ?","warning");
    }
    
    /**
     * @param mixed $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function _delete($id,Request $request){
    	$id=$request->get("id");
    	$object=$this->repository->find($id);
    	return $this->gui->realizeOperation(function($obj){
    		return $this->repository->delete($obj);
    	},$object,"<b>{$object}</b> has been deleted.", "impossible to delete <b>{$object}</b> !", $this->type."/refresh", "#dt-".$this->type );
    }


}
