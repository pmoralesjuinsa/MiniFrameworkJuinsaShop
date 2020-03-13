<?php


namespace Juinsa\Services;


use Juinsa\db\entities\Customer;

class CustomerService extends Service
{

    /**
     * @param Customer $customer
     * @return object|null
     */
    public function getCustomerByPasswordAndEmail(Customer $customer)
    {
        return $this->doctrineManager->em->getRepository(Customer::class)->findOneBy(
            array(
                'email' => $customer->getEmail(),
                'password' => $customer->getPassword()
            )
        );

    }

    /**
     * @param $id
     * @return mixed
     */
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

    public function getCustomers()
    {
        return $this->doctrineManager->em->getRepository(Customer::class)->findAll();
    }

    /**
     * @param integer $id
     * @return bool
     */
    public function remove($id)
    {
        try {
            $object = $this->getCustomerById($id);

            $this->doctrineManager->em->remove($object);
            $this->doctrineManager->em->flush();

            return true;
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return false;
    }

    /**
     * @param integer|null $id
     * @param string|null $name
     * @return mixed[]|null
     */
    public function getCustomerAdminList($id = null, $name = null)
    {
        try {
            $rawQuery = "SELECT c.id, c.name, c.updated_at, c.email, c.created_at
                    FROM customers c";

            return $this->modifyQueryForSearchByIdOrColumn("c", $id, $name, $rawQuery);

        } catch (\Exception $exception) {
            $this->logManagaer->error($exception->getMessage());
        }

        return null;
    }

}