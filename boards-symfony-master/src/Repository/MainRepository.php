<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;

abstract class MainRepository extends ServiceEntityRepository{
 
	public function get($id){
		return $this->find($id);
	}
	
	public function getAll(){
		return $this->findAll();
	}
	/**
	 * Affects member to member the values of the associative array $values to the members of the object $object
	 * Used for example to retrieve the variables posted and assign them to the members of an object
	 * @param object $object
	 * @param associative array $values
	 */
	public static function setValuesToObject($object, $values=null) {
		foreach ( $values as $key => $value ) {
			$accessor="set" . ucfirst($key);
			if (method_exists($object, $accessor)) {
				$object->$accessor($value);
			}
		}
	}
	
    /**
     * Adds or Updates $object in the database
     * @param object $object
     * @return boolean
     */
    public function update($object){
    	$result=true;
    	try{
    		$this->_em->persist($object);
    		$this->_em->flush();
    	}catch (\Exception $e){
    		echo $e->getMessage();
    		$result=false;
    	}
    	return $result;
    }
    
    /**
     * Deletes object from the database 
     * @param object $object
     * @return boolean
     */
    public function delete($object){
    	$result=true;
    	try{
    		$this->_em->remove($object);
    		$this->_em->flush();
    	}catch (\Exception $e){
    		$result=false;
    	}
    	return $result;
    }
    
    /**
     * Finds entities by an array of ids or a string with a comma separator
     * @param string $ids
     * @return array
     */
    public function getFromIds($ids){
    	if(isset($ids)){
    		$ids=explode(",", $ids);
    		return $this->findBy(['id'=>$ids]);
    	}
    	return [];
    }
    
    /**
     * Returns the names of the model classes
     * @param ManagerRegistry $doctrine
     * @return array
     */
    public static function getModelNames($doctrine){
    	$entities = array();
    	$em = $doctrine->getManager();
    	$meta = $em->getMetadataFactory()->getAllMetadata();
    	foreach ($meta as $m) {
    		$entities[] = $m->getName();
    	}
    	return $entities;
    }
    
    /**
     * Returns the model name associated with this repository
     * @return string
     */
    public function getModelName(){
    	$r=new \ReflectionClass($this->_entityName);
    	return $r->getShortName();
    }
}
