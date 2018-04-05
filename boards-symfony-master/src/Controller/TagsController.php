<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Repository\TagRepository;
use App\Services\semantic\TagsGui;
use App\Entity\Tag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TagsController extends CrudController{

    public function __construct(TagsGui $gui,TagRepository $repo){
        $this->gui=$gui;
        $this->repository=$repo;
        $this->type="tags";
        $this->subHeader="Tag list";
        $this->icon="users";
    }

    /**
     * @Route("/tags", name="tags")
     */
    public function index(){
        return $this->_index();
    }

    /**
     * @Route("/tags/refresh", name="tags_refresh")
     */
    public function refresh(){
        return $this->_refresh();
    }

    /**
     * @Route("/tags/new", name="tags_new")
     */
    public function add(){
        return $this->_add("\App\Entity\Tag");
    }

    /**
     * @Route("/tags/edit/{id}", name="tags_edit")
     */
    public function edit($id){
        return $this->_edit($id);
    }

    /**
     * @Route("tags/update/{id}", name="tag_update")
     */
    public function update(Request $request){
        return $this->_update($request, "\App\Entity\Tag");
    }

    /**
     * @Route("tags/submit", name="tag_submit")
     */
    public function submit(Request $request,TagRepository $tagRepo){
    	$tag=$tagRepo->find($request->get("id"));
    	if(isset($tag)){
    		$tag->setTitle($request->get("title"));
    		$tag->setColor($request->get("color"));
    		$tagRepo->update($tag);
    	}
    	return $this->redirectToRoute("tags");
    }

    /**
     * @Route("/tags/confirmDelete/{id}", name="tags_confirm_delete")
     */
    public function deleteConfirm($id){
        return $this->_deleteConfirm($id);
    }

    /**
     * @Route("/tags/delete/{id}", name="tags_delete")
     */
    public function delete($id,Request $request){
        return $this->_delete($id, $request);
    }

}
