<?php


namespace Juinsa\Helpers;


use Juinsa\db\entities\Customer;

class CustomerHelper
{
    static protected Customer $customer;

    public static function setAuthenticatedCustomer($customer) : void
    {
        self::$customer = $customer;
    }

    public static function getAuthenticatedCustomer() : Customer
    {
        return self::$customer;
    }
}