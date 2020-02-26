<?php


namespace Juinsa\db\repositories;


use Juinsa\db\entities\Customer;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

final class CustomerRepository
{

    /**
     * @var EntityRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Customer::class);
    }

    public function getCustomer(Customer $customer): ?object
    {
        return $this->repository->findOneBy(
            array(
                'email' => $customer->email,
                'password' => $customer->password
            )
        );
    }
}