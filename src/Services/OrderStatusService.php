<?php


namespace Juinsa\Services;

use Juinsa\db\entities\OrderStatus;

class OrderStatusService extends Service
{
    public function createOrder(OrderStatus $status)
    {
        try {
            $this->doctrineManager->em->persist($status);
            $this->doctrineManager->em->flush();

            return true;
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return false;
    }

    public function getOrderStatusById($id)
    {
        return $this->doctrineManager->em->getRepository(OrderStatus::class)->findOneById($id);
    }
}