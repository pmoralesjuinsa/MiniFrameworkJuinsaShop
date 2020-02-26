<?php


namespace Juinsa\Services;


use Juinsa\db\entities\Customer;
use Juinsa\db\repositories\CustomerRepository;
use Juinsa\DoctrineManager;
use Juinsa\LogManager;

class CustomerService extends Service
{
    /**
     * @var CustomerRepository
     */
    private CustomerRepository $customerRepository;

    public function __construct(DoctrineManager $doctrineManager, LogManager $logManagaer)
    {
        parent::__construct($doctrineManager, $logManagaer);

        $this->customerRepository = new CustomerRepository($this->doctrineManager->em);
    }

    public function login(Customer $customer): ?Customer
    {
        return $this->customerRepository->getCustomer($customer);
    }

}