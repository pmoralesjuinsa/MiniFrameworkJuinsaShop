<?php


namespace Juinsa\db\entities;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\ManyToMany(targetEntity="ProductType", inversedBy="attributes")
     * @ORM\JoinTable(name="product_type_attributes")
     */
    protected $product_types;

    /**
     * @ORM\OneToMany(targetEntity="ProductAttributeValues")
     */
    protected $values;

    /**
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="attributes")
     * @ORM\JoinTable(name="attributes_values")
     */
    protected $products;

    public function __construct()
    {
        $this->created_at = new \DateTime('now');
        $this->product_types = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->values = new ArrayCollection();
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
     * @return ArrayCollection
     */
    public function getValues(): ArrayCollection
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

    /**
     * @return ArrayCollection
     */
    public function getProducts(): ArrayCollection
    {
        return $this->products;
    }

    /**
     * @param ArrayCollection $products
     */
    public function setProducts(ArrayCollection $products): void
    {
        $this->products = $products;
    }

}