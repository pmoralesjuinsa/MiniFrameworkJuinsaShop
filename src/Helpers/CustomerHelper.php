<?php

function destoyAuthenticatedCustomer(): void
{
    unset($_SESSION['customerAuthed']);
}

function setAuthenticatedCustomer($customer): void
{
    if (!is_object($customer)) {
        return;
    }

    cleanSessionVars($customer);
    $_SESSION['customerAuthed'] = $customer;
}

/**
 * @param $customer
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
