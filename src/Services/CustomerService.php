<?php


namespace Juinsa\Services;


use Juinsa\db\entities\Customer;

class CustomerService extends Service
{
    public function selectUser(Customer $user): ?Customer
    {
//        try {
        $queryBuilder = $this->doctrineManager->em->createQueryBuilder();
        $queryBuilder->select('c.name')
            ->from('customers', 'c')
            ->where('c.email = ?email')
            ->andWhere('c.password = ?password')
            ->setParameter('email', $user->email)
            ->setParameter('password', '3be6bb49722299655e31b2a98652224387276d3c')
            ->setMaxResults(1);

        $query = $queryBuilder->getQuery();
        var_dump($query->getResult()); die();
        return $query->getSingleResult();
//        } catch (\Exception $e) {
//            $this->logManagaer->error($e->getMessage());
//        }

        return null;
    }
}