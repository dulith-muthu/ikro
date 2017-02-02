<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stock
 *
 * @ORM\Table(name="stock")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StockRepository")
 */
class Stock
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime")
     */
    private $dateTime;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="stock")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    private $item;

    /**
     * @var string
     *
     * @ORM\Column(name="cost", type="float")
     */
    private $cost;

    /**
     * @var float
     *
     * @ORM\Column(name="sellingPrice", type="float")
     */
    private $sellingPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="isAvailable", type="integer")
     */
    private $isAvailable;



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
     * Set dateTime
     *
     * @param \DateTime $dateTime
     * @return Stock
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
     * Set quantity
     *
     * @param string $quantity
     * @return Stock
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return string 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set cost
     *
     * @param string $cost
     * @return Stock
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string 
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set sellingPrice
     *
     * @param float $sellingPrice
     * @return Stock
     */
    public function setSellingPrice($sellingPrice)
    {
        $this->sellingPrice = $sellingPrice;

        return $this;
    }

    /**
     * Get sellingPrice
     *
     * @return float 
     */
    public function getSellingPrice()
    {
        return $this->sellingPrice;
    }

    /**
     * Set item
     *
     * @param \AppBundle\Entity\Item $item
     * @return Stock
     */
    public function setItem(\AppBundle\Entity\Item $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \AppBundle\Entity\Item 
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set isAvailable
     *
     * @param integer $isAvailable
     * @return Stock
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    /**
     * Get isAvailable
     *
     * @return integer 
     */
    public function getIsAvailable()
    {
        return $this->isAvailable;
    }
}
