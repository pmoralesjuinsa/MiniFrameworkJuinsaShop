<?php


namespace Juinsa\Services;


use Juinsa\db\entities\Customer;

class CustomerService extends Service
{

    public function login(Customer $customer): ?Customer
    {
        return $this->doctrineManager->em->getRepository(Customer::class)->findOneBy(
            array(
                'email' => $customer->email,
                'password' => $customer->password
            )
        );

    }

}