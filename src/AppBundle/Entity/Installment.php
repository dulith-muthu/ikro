<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Installment
 *
 * @ORM\Table(name="installment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstallmentRepository")
 */
class Installment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="installment", type="float")
     */
    private $installment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime")
     */
    private $dateTime;

    /**
     * @ORM\ManyToOne(targetEntity="Debt", inversedBy="installment")
     * @ORM\JoinColumn(name="dept_id", referencedColumnName="id")
     */
    private $dept;


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
     * Set installment
     *
     * @param float $installment
     * @return Installment
     */
    public function setInstallment($installment)
    {
        $this->installment = $installment;

        return $this;
    }

    /**
     * Get installment
     *
     * @return float 
     */
    public function getInstallment()
    {
        return $this->installment;
    }

    /**
     * Set dateTime
     *
     * @param \DateTime $dateTime
     * @return Installment
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get dateTime
     *
     * @return \DateTime 
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Set dept
     *
     * @param \AppBundle\Entity\Dept $dept
     * @return Installment
     */
    public function setDept(\AppBundle\Entity\Dept $dept = null)
    {
        $this->dept = $dept;

        return $this;
    }

    /**
     * Get dept
     *
     * @return \AppBundle\Entity\Dept 
     */
    public function getDept()
    {
        return $this->dept;
    }
}
