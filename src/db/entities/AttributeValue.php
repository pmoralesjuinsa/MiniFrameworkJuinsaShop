<?php


namespace Juinsa\db\entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="attributes_values")
 */

class AttributeValue extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="attributeValues", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="id_product", referencedColumnName="id")
     */
    protected $product;

    /**
     * @ORM\ManyToOne(targetEntity="ProductAttributeValue", inversedBy="attributeValues", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="id_product_attribute_value", referencedColumnName="id")
     */
    protected $attributeValue;

    /**
     * @ORM\ManyToOne(targetEntity="ProductAttribute", inversedBy="attributeValues", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="id_product_attribute", referencedColumnName="id")
     */
    protected $productAttribute;

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
    public function getAttributeValue()
    {
        return $this->attributeValue;
    }

    /**
     * @param mixed $attributeValue
     */
    public function setAttributeValue($attributeValue): void
    {
        $this->attributeValue = $attributeValue;
    }

    /**
     * @return mixed
     */
    public function getProductAttribute()
    {
        return $this->productAttribute;
    }

    /**
     * @param mixed $productAttribute
     */
    public function setProductAttribute($productAttribute): void
    {
        $this->productAttribute = $productAttribute;
    }


}