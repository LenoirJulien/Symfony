<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Developer
 *
 * @ORM\Table(name="developer", uniqueConstraints={@ORM\UniqueConstraint(name="identity", columns={"identity"})})
 * @ORM\Entity
 */
class Developer
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
     * @ORM\Column(name="identity", type="string", length=60, nullable=false)
     */
    private $identity;

    /**
	 * @return string
	 */
	public function getIdentity() {
		return $this->identity;
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
	 * @param string $identity
	 */
	public function setIdentity($identity) {
		$this->identity = $identity;
	}

	public function __toString(){
    	return $this->identity;
    }
}
