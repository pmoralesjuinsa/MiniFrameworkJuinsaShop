<?php


namespace Juinsa\Services;

use Juinsa\db\entities\OrderStatus;

class OrderStatusService extends Service
{
    public function getOrderStatusById($id)
    {
        return $this->doctrineManager->em->getRepository(OrderStatus::class)->findOneById($id);
    }

    public function getOrderStatus()
    {
        return $this->doctrineManager->em->getRepository(OrderStatus::class)->findAll();
    }
}