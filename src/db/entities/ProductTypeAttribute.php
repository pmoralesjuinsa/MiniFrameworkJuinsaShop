<?php


namespace Juinsa\db\entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product_type_attributes")
 */
class ProductTypeAttribute
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $value;

    /**
     * @ORM\ManyToOne(targetEntity="ProductType", inversedBy="attributes")
     * @ORM\JoinColumn(name="id_product_type", referencedColumnName="id")
     */
    protected $product_type;

    /**
     * @ORM\ManyToOne(targetEntity="ProductAttribute", inversedBy="values")
     * @ORM\JoinColumn(name="id_product_attribute", referencedColumnName="id")
     */
    protected $product_attribute;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="attributes")
     * @ORM\JoinColumn(name="id_product", referencedColumnName="id")
     */
    protected $product;

    /**
     * @return mixed
     */
    public function getProductType()
    {
        return $this->product_type;
    }

    /**
     * @param mixed $product_type
     */
    public function setProductType($product_type): void
    {
        $this->product_type = $product_type;
    }

    /**
     * @return mixed
     */
    public function getProductAttribute()
    {
        return $this->product_attribute;
    }

    /**
     * @param mixed $product_attribute
     */
    public function setProductAttribute($product_attribute): void
    {
        $this->product_attribute = $product_attribute;
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
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    public function __construct()
    {
        $this->created_at = new \DateTime('now');
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
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