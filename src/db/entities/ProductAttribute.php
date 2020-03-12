<?php


namespace Juinsa\db\entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product_attributes")
 */
class ProductAttribute
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
    protected $name;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /**
     * @ORM\OneToMany(targetEntity="ProductTypeAttribute", mappedBy="productAttribute", cascade={"persist", "remove"}, orphanRemoval=true, fetch="EAGER")
     */
    protected $productTypeAttributes;

    /**
     * @ORM\OneToMany(targetEntity="ProductAttributeValue", mappedBy="attributes", cascade={"persist"})
     */
    protected $values;

    /**
     * @ORM\OnetoMany(targetEntity="AttributeValue", mappedBy="productAttribute", cascade={"persist"})
     */
    protected $attributeValues;

    public function __construct()
    {
        $this->created_at = new \DateTime('now');
        $this->productTypeAttributes = new ArrayCollection();
        $this->values = new ArrayCollection();
        $this->attributeValues = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getAttributeValues(): Collection
    {
        return $this->attributeValues;
    }

    /**
     * @param ArrayCollection $attributeValues
     */
    public function setAttributeValues(ArrayCollection $attributeValues): void
    {
        $this->attributeValues = $attributeValues;
    }

    /**
     * @return Collection
     */
    public function getProductTypeAttributes(): Collection
    {
        return $this->productTypeAttributes;
    }

    /**
     * @param ProductTypeAttribute $productTypeAttributes
     * @return ProductAttribute
     */
    public function addProductTypeAttributes(ProductTypeAttribute $productTypeAttributes)
    {
        $this->productTypeAttributes->add($productTypeAttributes);
        $productTypeAttributes->setProductAttribute($this);

        return $this;
    }

    /**
     * @param ProductTypeAttribute $productTypeAttributes
     * @return ProductAttribute
     */
    public function removeProductTypeAttributes(ProductTypeAttribute $productTypeAttributes)
    {
        $this->productTypeAttributes->removeElement($productTypeAttributes);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
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
     * @return ArrayCollection
     */
    public function getProductTypes(): ArrayCollection
    {
        return $this->product_types;
    }

    /**
     * @param ArrayCollection $product_types
     */
    public function setProductTypes(ArrayCollection $product_types): void
    {
        $this->product_types = $product_types;
    }

    /**
     * @return Collection
     */
    public function getValues(): Collection
    {
        return $this->values;
    }

    /**
     * @param ArrayCollection $values
     */
    public function setValues(ArrayCollection $values): void
    {
        $this->values = $values;
    }


}