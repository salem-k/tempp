<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Operation
 *
 * @ORM\Table(name="Operation", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})})
 * @ORM\Entity
 */
class Operation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Libelle", type="string", length=250, nullable=true)
     */
    private $libelle;

    /**
      * @ORM\OneToMany(targetEntity="Qrcode", mappedBy="operation",cascade={"ALL"}, fetch="EAGER", orphanRemoval=true)
      * @ORM\JoinColumn(nullable=false)
      */
     private $qrcodes;


     /**
       * @ORM\OneToMany(targetEntity="OperationLigne", mappedBy="operation",cascade={"ALL"}, fetch="EAGER", orphanRemoval=true)
       * @ORM\JoinColumn(nullable=false)
       */
      private $operationlignes;

    /**
     * constructor
     */
    public function __construct()
    {

        $this->qrcodes = new ArrayCollection();
        $this->operationlignes = new ArrayCollection();
    }
    /**
     * Get Qrcodes
     *
     */
    public function getOperationlignes()
    {
        return $this->operationlignes;
    }
    /**
     * Set Qrcodes
     *
     */
    public function setOperationlignes($operationlignes)
    {
      print_r($operationlignes);
      die;
       foreach ($operationlignes as $temp)
         {
             if (is_null($temp->getOperation()))
             {
                 $temp->setOperation($this);
             }
         }
        $this->operationlignes = $temp;
    }
    /**
     * Get Qrcodes
     *
     */
    public function getQrcodes()
    {
        return $this->qrcodes;
    }
    /**
     * Set Qrcodes
     *
     */
    public function setQrcodes($qrcodes)
    {
      print_r($qrcodes);
      die;
       foreach ($qrcodes as $temp)
         {
             if (is_null($temp->getOperation()))
             {
                 $temp->setOperation($this);
             }
         }
        $this->qrcodes = $temp;
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Operation
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    public function __toString(){
      return (string)$this->getId();
    }


    /**
     * Add Qrcode
     *
     * @param \AppBundle\Entity\Qrcode $qrcode
     *
     * @return Operation
     */
    public function addQrcode(\AppBundle\Entity\Qrcode $qrcode)
    {
        $this->qrcodes[] = $qrcode;

        return $this;
    }

    /**
     * Remove qrcode
     *
     * @param \AppBundle\Entity\Qrcode $qrcode
     */
    public function removeQrcode(\AppBundle\Entity\Qrcode $qrcode)
    {
        $this->qrcodes->removeElement($qrcode);
    }

    /**
     * Add OperationLigne
     *
     * @param \AppBundle\Entity\OperationLigne $operationligne
     *
     * @return Operation
     */
    public function addOperationligne(\AppBundle\Entity\OperationLigne $operationligne)
    {
        $this->operationlignes[] = $operationligne;

        return $this;
    }

    /**
     * Remove $operationligne
     *
     * @param \AppBundle\Entity\OperationLigne $operationligne
     */
    public function removeOperationligne(\AppBundle\Entity\OperationLigne $operationligne)
    {
        $this->operationlignes->removeElement($operationligne);
    }


}
