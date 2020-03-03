<?php


namespace Juinsa\Services;


class OrderService extends Service
{
    public function createOrder($cart)
    {
        try {
            //TODO DEUDA TÉNICA
            $this->doctrineManager->em->createQueryBuilder()
                    ->insert('orders')
                    ->values(
                        array(
                            'id_status' => ':status',
                            'total' => ':totalAmount'
                        )
                    )
                    ->setParameter("status", 1)
                    ->setParameter("totalAmount", $cart['totalAmount'])
                ;

            return true;
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return false;
    }
}