<?php


namespace Juinsa\Services;


use Juinsa\db\entities\Customer;

class CustomerService extends Service
{

    public function getCustomerByPasswordAndEmail(Customer $customer): ?Customer
    {
        return $this->doctrineManager->em->getRepository(Customer::class)->findOneBy(
            array(
                'email' => $customer->email,
                'password' => $customer->password
            )
        );

    }

    public function getCustomerById($id) {
        return $this->doctrineManager->em->getRepository(Customer::class)->findOneById($id);
    }

    public function createCustomer(Customer $customer): ?Customer
    {
        try {
            $this->doctrineManager->em->persist($customer);
            $this->doctrineManager->em->flush();

            return $customer;
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return null;
    }

}