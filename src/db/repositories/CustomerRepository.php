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

    public function getCustomer(Customer $customer): ?Customer
    {
        return $this->repository->findOneBy(
            array(
                'email' => 'ugoyette@gmail.com',
                'password' => '3be6bb49722299655e31b2a98652224387276d3c'
            )
        );
    }
}