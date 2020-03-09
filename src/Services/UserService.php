<?php


namespace Juinsa\Services;


use Juinsa\db\entities\User;

class UserService extends Service
{
    /**
     * @param User $user
     * @return User|null
     */
    public function createUser(User $user): ?User
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

    public function getUserByPasswordAndEmail($user)
    {
        return $this->doctrineManager->em->getRepository(User::class)->findOneBy(
            array(
                'email' => $user->email,
                'password' => $user->password
            )
        );
    }

}