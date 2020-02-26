<?php


namespace Juinsa\db\entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="customers")
 */
class Customer extends Entity
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
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     */
    protected $phone;

    /**
     * @ORM\Column(type="string")
     */
    protected $address;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    public function __construct($customer = null)
    {
        if (is_null($customer)) {
            $this->created_at = new \DateTime('now');
            return;
        }

        $this->address = $customer->address;
        $this->password = $customer->password;
        $this->email = $customer->email;
        $this->phone = $customer->phone;
        $this->name = $customer->name;
        $this->id = $customer->id;
        $this->updated_at = $customer->updated_at;
        $this->created_at = $customer->created_at;
    }
}