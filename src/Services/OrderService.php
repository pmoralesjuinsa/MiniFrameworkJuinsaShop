<?php


namespace Juinsa\Services;


class OrderService extends Service
{
    public function createOrder()
    {
        try {
            //TODO DEUDA TÉNICA
            $this->doctrineManager->em->persist($order);
            $this->doctrineManager->em->flush();

            return true;
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return false;
    }
}