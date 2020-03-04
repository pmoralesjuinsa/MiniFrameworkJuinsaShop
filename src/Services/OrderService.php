<?php


namespace Juinsa\Services;


use Juinsa\db\entities\Order;

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
}