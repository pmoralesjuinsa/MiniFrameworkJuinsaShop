<?php


namespace Juinsa\Services;


use Juinsa\db\entities\Order;


class OrderService extends Service
{
    public function createOrder(Order $order): Order
    {
        try {
            $this->doctrineManager->em->persist($order);
            $this->doctrineManager->em->flush();

            return $order;
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return null;
    }
}