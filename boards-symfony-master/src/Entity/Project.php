<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Project
 *
 * @ORM\Table(name="project", uniqueConstraints={@ORM\UniqueConstraint(name="projectName", columns={"name"})}, indexes={@ORM\Index(name="idOwner", columns={"idOwner"})})
 * @ORM\Entity
 */
class Project
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="date", nullable=false)
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dueDate", type="date", nullable=false)
     */
    private $duedate;

    /**
     * @var \App\Entity\Developer
     *
     * @ORM\ManyToOne(targetEntity="Developer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idOwner", referencedColumnName="id")
     * })
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Story", mappedBy="project")
     */
    private $stories;

    public function __construct(){
    	$this->stories=new ArrayCollection();
    	$this->idOwner="";
    	$this->name="New project name";
    }
	/**
	 * @return number
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @return \DateTime
	 */
	public function getStartdate() {
		return $this->startdate;
	}

	/**
	 * @return \DateTime
	 */
	public function getDuedate() {
		return $this->duedate;
	}

	/**
	 * @return Developer
	 */
	public function getOwner() {
		return $this->owner;
	}

	/**
	 * @return mixed
	 */
	public function getStories() {
		return $this->stories;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @param \DateTime $startdate
	 */
	public function setStartdate($startdate) {
		if(is_string($startdate))
			$startdate=\DateTime::createFromFormat("Y-m-d",$startdate);
		$this->startdate = $startdate;
	}

	/**
	 * @param \DateTime $duedate
	 */
	public function setDuedate($duedate) {
		if(is_string($duedate))
			$duedate=\DateTime::createFromFormat("Y-m-d",$duedate);
		$this->duedate = $duedate;
	}

	/**
	 * @param Developer $owner
	 */
	public function setOwner($owner) {
		$this->owner = $owner;
	}

	/**
	 * @param mixed $stories
	 */
	public function setStories($stories) {
		$this->stories = $stories;
	}
	
	public function __toString(){
		return $this->name;
	}
}
