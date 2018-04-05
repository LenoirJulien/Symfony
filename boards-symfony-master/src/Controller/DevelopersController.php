<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Services\semantic\DevelopersGui;
use App\Repository\DeveloperRepository;

class DevelopersController extends CrudController{
	
	public function __construct(DevelopersGui $gui,DeveloperRepository $repo){
		$this->gui=$gui;
		$this->repository=$repo;
		$this->type="developers";
		$this->subHeader="Developer list";
		$this->icon="users";
	}
    /**
     * @Route("/developers", name="developers")
     */
    public function index(){
    	return $this->_index();
    }
    
    /**
     * @Route("/developers/refresh", name="developers_refresh")
*/
    public function refresh(){
        return $this->_refresh();
    }
    
    /**
     * @Route("/developers/edit/{id}", name="developers_edit")
     */
    public function edit($id){
    	return $this->_edit($id);
    }
    
    /**
     * @Route("/developers/new", name="developers_new")
     */
    public function add(){
    	return $this->_add("\App\Entity\Developer");
    }

    /**
     * @Route("/developers/update", name="developers_update")
     */
    public function update(Request $request){
    	return $this->_update($request, "\App\Entity\Developer");
    }
    
    /**
     * @Route("/developers/confirmDelete/{id}", name="developers_confirm_delete")
     */
    public function deleteConfirm($id){
    	return $this->_deleteConfirm($id);
    }
    
    /**
     * @Route("/developers/delete/{id}", name="developers_delete")
     */
    public function delete($id,Request $request){
    	return $this->_delete($id, $request);
    }
}
