<?php


namespace Juinsa\db\entities;

use AttributesValues;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */

class Product extends Entity
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
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products", fetch="EAGER")
     * @ORM\JoinColumn(name="id_category", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\ManyToOne(targetEntity="ProductType", inversedBy="products", fetch="EAGER")
     * @ORM\JoinColumn(name="id_product_type", referencedColumnName="id")
     */
    protected $product_type;

    /**
     * One product has many order lines. This is the inverse side.
     * @ORM\OneToMany(targetEntity="OrderLine", mappedBy="orderLines")
     */
    protected $orderLines;

    /**
     * @ORM\OnetoMany(targetEntity="AttributeValue", mappedBy="product", cascade={"persist", "remove"}, orphanRemoval=true, fetch="EAGER")
     */
    protected $attributeValues;

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
        $this->orderLines = new ArrayCollection();
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
     * @param AttributeValue $attributeValue
     * @return Product
     */
    public function addAttributeValues(AttributeValue $attributeValue)
    {
        $this->attributeValues->add($attributeValue);
        $attributeValue->setProduct($this);

        return $this;
    }

    /**
     * @param AttributeValue $attributeValue
     * @return Product
     */
    public function removeAttributeValues(AttributeValue $attributeValue)
    {
        $this->attributeValues->removeElement($attributeValue);

        return $this;
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
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

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
    public function getOrderLines()
    {
        return $this->orderLines;
    }

    /**
     * @param mixed $orderLines
     */
    public function setOrderLines($orderLines): void
    {
        $this->orderLines = $orderLines;
    }


}