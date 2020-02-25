<?php


namespace Juinsa\Services;


use Juinsa\db\entities\Customer;

class CustomerService extends Service
{
    public function getCustomer(Customer $customer): ?Customer
    {
//        try {
        $queryBuilder = $this->doctrineManager->em->createQueryBuilder();
        $queryBuilder->select('c')
            ->from('customers', 'c')
            ->where('c.email = ?1')
            ->andWhere('c.password = ?2')
            ->setParameter(1, "ugoyette@gmail.com")
            ->setParameter(2, '3be6bb49722299655e31b2a98652224387276d3c');
//            ->setMaxResults(1)

        $query = $queryBuilder->getQuery();
        var_dump($query->getResult()); die();
        return $query->getSingleResult();

//        } catch (\Exception $e) {
//            $this->logManagaer->error($e->getMessage());
//        }

        return null;
    }
}