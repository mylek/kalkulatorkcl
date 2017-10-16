<?php

namespace Kalkulator\KalkulatorBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Kalkulator\KalkulatorBundle\Repository\DzienRepository")
 * @ORM\Table(name="dzien")
 */
class Dzien {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /** 
     * @ORM\Column(type="datetime") 
     */
    private $data;
    
    /**
     * @ORM\ManyToOne(
     *      targetEntity = "Common\UserBundle\Entity\User"
     * )
     * 
     * @ORM\JoinColumn(
     *      name = "user_id",
     *      referencedColumnName = "id",
     *	    onDelete = "CASCADE"	
     * )
     */
    private $user;
    
     /**
     * @ORM\OneToMany(
     *      targetEntity = "Danie",
     *      mappedBy = "dzien_id"
     * )
     */
    private $dania;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     * @return Dzien
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set user
     *
     * @param \Common\UserBundle\Entity\User $user
     * @return Dzien
     */
    public function setUser(\Common\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Common\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function preSave(){
        
        if(null == $this->data){
            $this->data = new \DateTime();
        }
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dania = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add dania
     *
     * @param \Kalkulator\KalkulatorBundle\Entity\Danie $dania
     * @return Dzien
     */
    public function addDanium(\Kalkulator\KalkulatorBundle\Entity\Danie $dania)
    {
        $this->dania[] = $dania;

        return $this;
    }

    /**
     * Remove dania
     *
     * @param \Kalkulator\KalkulatorBundle\Entity\Danie $dania
     */
    public function removeDanium(\Kalkulator\KalkulatorBundle\Entity\Danie $dania)
    {
        $this->dania->removeElement($dania);
    }

    /**
     * Get dania
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDania()
    {
        return $this->dania;
    }
}
