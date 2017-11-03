<?php

namespace Kalkulator\KalkulatorBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Kalkulator\KalkulatorBundle\Repository\PosilekRepository")
 * @ORM\Table(name="posilek")
 */
class Posilek {
    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;
    
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
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank
     * @Assert\Length(
     *      max = 255
     * )
     */
    private $nazwa;
    
    /**
     * @ORM\OneToMany(
     *      targetEntity = "PosilekProdukty",
     *      mappedBy = "posilek_id"
     * )
     * @ORM\JoinColumn(
     *      name = "posilek_id",
     *      referencedColumnName = "id",
     *      onDelete = "CASCADE"	
     * )
     */
    private $posilek_produkty;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posilek_produkty = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set user
     *
     * @param \Common\UserBundle\Entity\User $user
     * @return Posilek
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
     * Add posilek_produkty
     *
     * @param \Kalkulator\KalkulatorBundle\Entity\PosilekProdukty $posilekProdukty
     * @return Posilek
     */
    public function addPosilekProdukty(\Kalkulator\KalkulatorBundle\Entity\PosilekProdukty $posilekProdukty)
    {
        $this->posilek_produkty[] = $posilekProdukty;

        return $this;
    }

    /**
     * Remove posilek_produkty
     *
     * @param \Kalkulator\KalkulatorBundle\Entity\PosilekProdukty $posilekProdukty
     */
    public function removePosilekProdukty(\Kalkulator\KalkulatorBundle\Entity\PosilekProdukty $posilekProdukty)
    {
        $this->posilek_produkty->removeElement($posilekProdukty);
    }

    /**
     * Get posilek_produkty
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosilekProdukty()
    {
        return $this->posilek_produkty;
    }

    /**
     * Set nazwa
     *
     * @param string $nazwa
     * @return Posilek
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    /**
     * Get nazwa
     *
     * @return string 
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }
}
