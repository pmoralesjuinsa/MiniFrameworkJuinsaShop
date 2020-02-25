<?php


namespace Juinsa\Services;


use Juinsa\db\entities\User;

class UserService extends Service
{
    public function createUser(User $user): User
    {
        try {
            $this->doctrineManager->em->persist($user);
            $this->doctrineManager->em->flush();

            return $user;
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return null;
    }

    public function selectUser(User $user): User
    {
        try {
            $queryBuilder = $this->doctrineManager->em->createQueryBuilder();
            $queryBuilder->select('*')
                ->from('customers')
                ->where('email = ?1')
                ->andWhere('password = ?2')
                ->setParameter(1, $user->email)
                ->setParameter(2, $user->password)
                ->setMaxResults(1);

            $query = $queryBuilder->getQuery();

            return $query->getSingleResult();
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return null;
    }
}