<?php

namespace DTL\TrainerBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Weight
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $weight;

    /**
     * @MongoDB\Date
     */
    protected $date;

    /**
     * @MongoDB\String
     */
    protected $comment;


    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set icon
     *
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * Get icon
     *
     * @return string $icon
     */
    public function getIcon()
    {
        return $this->icon;
    }

    public function __toString()
    {
        return (string) $this->title;
    }
}

