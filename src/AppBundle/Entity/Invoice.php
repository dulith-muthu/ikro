<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Table(name="invoice")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InvoiceRepository")
 */
class Invoice
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
     * @var string
     *
     * @ORM\Column(name="invoiceNumber", type="string", length=255)
     */
    private $invoiceNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime")
     */
    private $dateTime;

    /**
     * @ORM\OneToMany(targetEntity="Sale", mappedBy="invoice")
     */

    private $sale;

    /**
     * @var string
     *
     * @ORM\Column(name="customerName", type="string", length=255, nullable=true)
     */
    private $customerName;

    /**
     * @var string
     *
     * @ORM\Column(name="customerAddress", type="string", length=255, nullable=true)
     */
    private $customerAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="customerNic", type="string", length=255, nullable=true)
     */
    private $customerNic;

    /**
     * @var string
     *
     * @ORM\Column(name="customerPhone", type="string", length=255, nullable=true)
     */
    private $customerPhone;


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
     * Set invoiceNumber
     *
     * @param string $invoiceNumber
     * @return Invoice
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    /**
     * Get invoiceNumber
     *
     * @return string 
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * Set dateTime
     *
     * @param \DateTime $dateTime
     * @return Invoice
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
     * Set customerName
     *
     * @param string $customerName
     * @return Invoice
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * Get customerName
     *
     * @return string 
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * Set customerAddress
     *
     * @param string $customerAddress
     * @return Invoice
     */
    public function setCustomerAddress($customerAddress)
    {
        $this->customerAddress = $customerAddress;

        return $this;
    }

    /**
     * Get customerAddress
     *
     * @return string 
     */
    public function getCustomerAddress()
    {
        return $this->customerAddress;
    }

    /**
     * Set customerNic
     *
     * @param string $customerNic
     * @return Invoice
     */
    public function setCustomerNic($customerNic)
    {
        $this->customerNic = $customerNic;

        return $this;
    }

    /**
     * Get customerNic
     *
     * @return string 
     */
    public function getCustomerNic()
    {
        return $this->customerNic;
    }

    /**
     * Set customerPhone
     *
     * @param string $customerPhone
     * @return Invoice
     */
    public function setCustomerPhone($customerPhone)
    {
        $this->customerPhone = $customerPhone;

        return $this;
    }

    /**
     * Get customerPhone
     *
     * @return string 
     */
    public function getCustomerPhone()
    {
        return $this->customerPhone;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sale = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add sale
     *
     * @param \AppBundle\Entity\Sale $sale
     * @return Invoice
     */
    public function addSale(\AppBundle\Entity\Sale $sale)
    {
        $this->sale[] = $sale;

        return $this;
    }

    /**
     * Remove sale
     *
     * @param \AppBundle\Entity\Sale $sale
     */
    public function removeSale(\AppBundle\Entity\Sale $sale)
    {
        $this->sale->removeElement($sale);
    }

    /**
     * Get sale
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSale()
    {
        return $this->sale;
    }
}
