<?php

session_start();

function destroyAuthenticatedCustomer(): void
{
    unset($_SESSION['customerAuthed']);
    session_unset();
    session_destroy();
}

function setAuthenticatedCustomer($customer): void
{
    if (!is_object($customer)) {
        return;
    }

    $customerWrapper = new \Juinsa\Helpers\CustomerWrapper($customer);
    $customerPublic = wrapperProperties($customerWrapper);
    cleanSessionVars($customerPublic);
    $_SESSION['customerAuthed'] = $customerPublic;
}

/**
 * @param $customerWrapper
 * @return object
 */
function wrapperProperties(\Juinsa\Helpers\CustomerWrapper $customerWrapper): object
{
    $customer['id'] = $customerWrapper->getId();
    $customer['name'] = $customerWrapper->getName();
    $customer['address'] = $customerWrapper->getAddress();
    $customer['email'] = $customerWrapper->getEmail();
    $customer['created_at'] = $customerWrapper->getCreatedAt();
    $customer['updated_at'] = $customerWrapper->getUpdatedAt();
    $customer['phone'] = $customerWrapper->getPhone();
    $customer['password'] = $customerWrapper->getPassword();

    return (object)$customer;
}

/**
 * @param $customer
 * @return void
 */
function cleanSessionVars(&$customer): void
{
    unset($customer->password);
    unset($customer->created_at);
    unset($customer->updated_at);
}

function getAuthenticatedCustomer(): ?object
{
    return $_SESSION['customerAuthed'];
}
