<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Services\semantic\StepsGui;
use App\Repository\StepRepository;

class StepsController extends CrudController{

    public function __construct(StepsGui $gui,StepRepository $repo){
        $this->gui=$gui;
        $this->repository=$repo;
        $this->type="steps";
        $this->subHeader="Step list";
        $this->icon="users";
    }
    /**
     * @Route("/steps", name="steps")
     */
    public function index(){
        return $this->_index();
    }

    /**
     * @Route("/steps/refresh", name="steps_refresh")
     */
    public function refresh(){
        return $this->_refresh();
    }

    /**
     * @Route("/steps/edit/{id}", name="steps_edit")
     */
    public function edit($id){
        return $this->_edit($id);
    }

    /**
     * @Route("/steps/new", name="steps_new")
     */
    public function add(){
        return $this->_add("\App\Entity\Step");
    }

    /**
     * @Route("/steps/update", name="steps_update")
     */
    public function update(Request $request){
        return $this->_update($request, "\App\Entity\Step");
    }

    /**
     * @Route("/steps/confirmDelete/{id}", name="steps_confirm_delete")
     */
    public function deleteConfirm($id){
        return $this->_deleteConfirm($id);
    }

    /**
     * @Route("/steps/delete/{id}", name="steps_delete")
     */
    public function delete($id,Request $request){
        return $this->_delete($id, $request);
    }
}
