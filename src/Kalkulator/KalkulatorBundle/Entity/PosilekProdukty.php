<?php

namespace Kalkulator\KalkulatorBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="posilek_produkty")
 */
class PosilekProdukty {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="smallint", length=4)
     * 
     * @Assert\NotBlank
     * @Assert\Length(
     *      max = 9999
     * )
     */
    private $gram;
    
    /**
     * @ORM\ManyToOne(
     *      targetEntity = "Produkt"
     * )
     * @ORM\JoinColumn(
     *      name = "produkt_id",
     *      referencedColumnName = "id",
     *      onDelete = "SET NULL"
     * )
     */    
    private $produkty;
    
    /**
     * @ORM\ManyToOne(
     *      targetEntity = "Posilek",
     *	    inversedBy = "posilek_produkty"
     * )
     * @ORM\JoinColumn(
     *      name = "posilek_id",
     *      referencedColumnName = "id",
     *      onDelete = "CASCADE"
     * )
     */
     private $posilek_id;

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
     * Set gram
     *
     * @param integer $gram
     * @return PosilekProdukty
     */
    public function setGram($gram)
    {
        $this->gram = $gram;

        return $this;
    }

    /**
     * Get gram
     *
     * @return integer 
     */
    public function getGram()
    {
        return $this->gram;
    }

    /**
     * Set produkty
     *
     * @param \Kalkulator\KalkulatorBundle\Entity\Produkt $produkty
     * @return PosilekProdukty
     */
    public function setProdukty(\Kalkulator\KalkulatorBundle\Entity\Produkt $produkty = null)
    {
        $this->produkty = $produkty;

        return $this;
    }

    /**
     * Get produkty
     *
     * @return \Kalkulator\KalkulatorBundle\Entity\Produkt 
     */
    public function getProdukty()
    {
        return $this->produkty;
    }

    /**
     * Set posilek_id
     *
     * @param \Kalkulator\KalkulatorBundle\Entity\Posilek $posilekId
     * @return PosilekProdukty
     */
    public function setPosilekId(\Kalkulator\KalkulatorBundle\Entity\Posilek $posilekId = null)
    {
        $this->posilek_id = $posilekId;

        return $this;
    }

    /**
     * Get posilek_id
     *
     * @return \Kalkulator\KalkulatorBundle\Entity\Posilek 
     */
    public function getPosilekId()
    {
        return $this->posilek_id;
    }
}
