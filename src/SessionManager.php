<?php


namespace Juinsa;


use Juinsa\db\entities\Customer;
use Juinsa\db\entities\User;
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

        $this->cleanAuthedVars($customer);

        $this->set('customerAuthed', $customer);
        return $customer;
    }

    /**
     * @param Customer|User $customer
     */
    protected function cleanAuthedVars(&$customer): void
    {
        $customer->setPassword(null);
    }

    /**
     * @var User|null $user
     * @return mixed
     */
    public function setUserAuthed(?User $user): ?object
    {
        if(is_null($user)) {
            return null;
        }

        $this->cleanAuthedVars($user);

        $this->set('userAuthed', $user);
        return $user;
    }


}