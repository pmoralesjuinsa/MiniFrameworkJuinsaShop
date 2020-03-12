<?php


namespace Juinsa\controllers\Admin\Customer;


class CustomerListAdminController extends CustomerAdminController
{
    public function index($customers = null)
    {
        if(is_null($customers)) {
            $customers = $this->customerService->getCustomers();
        }
        $this->myRenderTemplate('admin/customer/list.twig.html', ['customers' => $customers]);
    }

    public function search()
    {
        $customers = [];
        if(isset($_POST['nameOrId']) && $_POST['nameOrId'] != '') {
            $nameOrId = $_POST['nameOrId'];
            if(is_numeric($_POST['nameOrId'])) {
                $customers = $this->customerService->getCustomerAdminList((int)$nameOrId);
            } else {
                $customers = $this->customerService->getCustomerAdminList(null, $nameOrId);
            }
        }

        $this->index($customers);
    }
}