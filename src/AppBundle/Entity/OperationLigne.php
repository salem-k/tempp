<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OperationLigne
 *
 * @ORM\Table(name="operation_ligne", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_operation_ligne_Operation_idx", columns={"Operation_id"})})
 * @ORM\Entity
 */
class OperationLigne
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
     * @ORM\Column(name="libelle", type="string", length=250, nullable=true)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=250, nullable=true)
     */
    private $url;

    /**
     * @var \Operation
     *
     * @ORM\ManyToOne(targetEntity="Operation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Operation_id", referencedColumnName="id")
     * })
     */
    private $operation;



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
     * @return OperationLigne
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

    /**
     * Set url
     *
     * @param string $url
     *
     * @return OperationLigne
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set operation
     *
     * @param \AppBundle\Entity\Operation $operation
     *
     * @return OperationLigne
     */
    public function setOperation(\AppBundle\Entity\Operation $operation = null)
    {
        $this->operation = $operation;

        return $this;
    }

    /**
     * Get operation
     *
     * @return \AppBundle\Entity\Operation
     */
    public function getOperation()
    {
        return $this->operation;
    }

    public function __toString(){
      return (string)$this->getId();
    }
}
