<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Story
 *
 * @ORM\Table(name="story", indexes={@ORM\Index(name="idDeveloper", columns={"idDeveloper"}), @ORM\Index(name="idProject", columns={"idProject"})})
 * @ORM\Entity
 */
class Story
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
     * @ORM\Column(name="code", type="string", length=10, nullable=false)
     */
    private $code;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descriptif", type="text", length=65535, nullable=true)
     */
    private $descriptif;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tags", type="text", length=65535, nullable=true)
     */
    private $tags;

    /**
     * @var string|null
     *
     * @ORM\Column(name="step", type="string", length=50, nullable=true)
     */
    private $step;

    /**
     * @var \App\Entity\Developer
     *
     * @ORM\ManyToOne(targetEntity="Developer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idDeveloper", referencedColumnName="id")
     * })
     */
    private $developer;

    /**
     * @var \App\Entity\Project
     *
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProject", referencedColumnName="id")
     * })
     */
    private $project;

    
    public function __construct(){
    	$this->tags=new ArrayCollection();
    }
    /**
	 * @return number
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * @return string
	 */
	public function getDescriptif() {
		return $this->descriptif;
	}

	/**
	 * @return string
	 */
	public function getTags() {
		return $this->tags;
	}

	/**
	 * @return string
	 */
	public function getStep() {
		return $this->step;
	}

	/**
	 * @return \App\Entity\Developer
	 */
	public function getDeveloper() {
		return $this->developer;
	}

	/**
	 * @return \App\Entity\Project
	 */
	public function getProject() {
		return $this->project;
	}

	/**
	 * @param string $code
	 */
	public function setCode($code) {
		$this->code = $code;
	}

	/**
	 * @param Ambigous <string, NULL> $descriptif
	 */
	public function setDescriptif($descriptif) {
		$this->descriptif = $descriptif;
	}

	/**
	 * @param Ambigous <string, NULL> $tags
	 */
	public function setTags($tags) {
		$this->tags = $tags;
	}

	/**
	 * @param Ambigous <string, NULL> $step
	 */
	public function setStep($step) {
		$this->step = $step;
	}

	/**
	 * @param \App\Entity\Developer $developer
	 */
	public function setDeveloper($developer) {
		$this->developer = $developer;
	}

	/**
	 * @param \App\Entity\Project $project
	 */
	public function setProject($project) {
		$this->project = $project;
	}

	public function __toString(){
    	return $this->descriptif;
    }
}
