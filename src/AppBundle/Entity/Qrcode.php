<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Qrcode
 *
 * @ORM\Table(name="QRcode", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_QRcode_Operation1_idx", columns={"Operation_id"})})
 * @ORM\Entity
 */
class Qrcode
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
     * @ORM\Column(name="content", type="string", length=250, nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="device_id", type="string", length=45, nullable=true)
     */
    private $deviceId;


    /**
     * @ORM\ManyToOne(targetEntity="Operation", inversedBy="qrcodes", cascade={"ALL"}, fetch="EAGER")
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
     * Set content
     *
     * @param string $content
     *
     * @return Qrcode
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set deviceId
     *
     * @param string $deviceId
     *
     * @return Qrcode
     */
    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;

        return $this;
    }

    /**
     * Get deviceId
     *
     * @return string
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     * Set operation
     *
     * @param \AppBundle\Entity\Operation $operation
     *
     * @return Qrcode
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
