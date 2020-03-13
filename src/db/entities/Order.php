<?php


namespace Juinsa\db\entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="orders")
 */

class Order extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="float")
     */
    protected $total;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="orders", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="id_customer", referencedColumnName="id")
     */
    protected $customer;

    /**
     * One order has many order lines. This is the inverse side.
     * @ORM\OneToMany(targetEntity="OrderLine", mappedBy="order", cascade={"persist", "remove"}, orphanRemoval=true, fetch="EAGER")
     */
    protected $orderLines;

    /**
     * @ORM\ManyToOne(targetEntity="OrderStatus", inversedBy="orders", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="id_status", referencedColumnName="id")
     */
    protected $status;

    public function __construct()
    {
        $this->created_at = new \DateTime('now');
        $this->orderLines = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total): void
    {
        $this->total = $total;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     */
    public function setCreatedAt(\DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return Collection
     */
    public function getOrderLines(): Collection
    {
        return $this->orderLines;
    }

    /**
     * @param OrderLine $orderLine
     * @return Order
     */
    public function addOrderLines(OrderLine $orderLine)
    {
        $this->orderLines->add($orderLine);
        $orderLine->setOrder($this);

        return $this;
    }

    /**
     * @param OrderLine $orderLine
     * @return Order
     */
    public function removeOrderLines(OrderLine $orderLine)
    {
        $this->orderLines->removeElement($orderLine);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

}