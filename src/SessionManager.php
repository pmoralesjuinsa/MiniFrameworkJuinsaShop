<?php


namespace Juinsa;


use Juinsa\db\entities\Customer;
use Symfony\Component\HttpFoundation\Session\Session;

class SessionManager extends Session
{
    /**
     * @var Customer|null $customer
     * @return mixed
     */
    public function setCustomerAuthed(?Customer $customer): ?object
    {
        if(is_null($customer)) {
            return null;
        }

        $this->cleanCustomerAuthedVars($customer);

        $this->set('customerAuthed', $customer);
        return $customer;
    }

    /**
     * @param Customer $customer
     */
    protected function cleanCustomerAuthedVars(Customer &$customer): void
    {
        $customer->setPassword(null);
    }
}