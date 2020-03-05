<?php


namespace Juinsa\Services;


use Juinsa\db\entities\Customer;
use Juinsa\db\entities\Order;
use Juinsa\db\entities\OrderStatus;

class OrderService extends Service
{
    public function createOrder(Order $order)
    {
        try {
            $this->doctrineManager->em->persist($order);
            $this->doctrineManager->em->flush();

            return true;
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return false;
    }

    public function getOrderStatus($id) {
        return $this->doctrineManager->em->getRepository(OrderStatus::class)->findOneById($id);
    }

    public function getCustomerSession($id) {
        return $this->doctrineManager->em->getRepository(Customer::class)->findOneById($id);
    }
}