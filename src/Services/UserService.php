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

    public function getUsers()
    {
        return $this->doctrineManager->em->getRepository(User::class)->findAll();
    }

    /**
     * @param integer $id
     * @return bool
     */
    public function remove($id)
    {
        try {
            $object = $this->getUserById($id);

            $this->doctrineManager->em->remove($object);
            $this->doctrineManager->em->flush();

            return true;
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUserById($id)
    {
        return $this->doctrineManager->em->getRepository(User::class)->findOneById($id);
    }

    /**
     * @param integer|null $id
     * @param string|null $name
     * @return mixed[]|null
     */
    public function getUserAdminList($id = null, $name = null)
    {
        try {
            $rawQuery = "SELECT u.id, u.name, u.email, u.updated_at, u.created_at
                    FROM users u";

            return $this->modifyQueryForSearchByIdOrColumn("u", $id, $name, $rawQuery);

        } catch (\Exception $exception) {
            $this->logManagaer->error($exception->getMessage());
        }

        return null;
    }

}