<?php


namespace Juinsa\db\entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="order_lines")
 */

class OrderLine extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $product_quantity;

    /**
     * @ORM\Column(type="float")
     */
    protected $product_price;

    /**
     * @ORM\Column(type="float")
     */
    protected $total;

    /**
     * @ORM\Column(type="string")
     */
    protected $product_name;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /**
     * Many order lines have one order. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="orderLines", cascade={"persist"})
     * @ORM\JoinColumn(name="id_order", referencedColumnName="id")
     */
    protected $order;

    /**
     * Many order lines have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="orderLines", cascade={"persist"})
     * @ORM\JoinColumn(name="id_product", referencedColumnName="id")
     */
    protected $product;

    public function __construct()
    {
        $this->created_at = new \DateTime('now');
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
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * @param mixed $product_name
     */
    public function setProductName($product_name): void
    {
        $this->product_name = $product_name;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param Order $order
     * @return OrderLine
     */
    public function setOrder(Order $order): OrderLine
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product): void
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getProductQuantity()
    {
        return $this->product_quantity;
    }

    /**
     * @param mixed $productQuantity
     */
    public function setProductQuantity($productQuantity): void
    {
        $this->product_quantity = $productQuantity;
    }

    /**
     * @return mixed
     */
    public function getProductPrice()
    {
        return $this->product_price;
    }

    /**
     * @param mixed $productPrice
     */
    public function setProductPrice($productPrice): void
    {
        $this->product_price = $productPrice;
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

}