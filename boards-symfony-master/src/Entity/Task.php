<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="task", indexes={@ORM\Index(name="idStory", columns={"idStory"})})
 * @ORM\Entity
 */
class Task
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
     * @ORM\Column(name="content", type="text", length=65535, nullable=false)
     */
    private $content;

    /**
     * @var \App\Entity\Story
     *
     * @ORM\ManyToOne(targetEntity="Story")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idStory", referencedColumnName="id")
     * })
     */
    private $story;
	/**
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @return \App\Entity\Story
	 */
	public function getStory() {
		return $this->story;
	}

	/**
	 * @param \App\Entity\Story $story
	 */
	public function setStory($story) {
		$this->story = $story;
	}

	/**
	 * @param string $content
	 */
	public function setContent($content) {
		$this->content = $content;
	}

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->_content;
    }


}
