<?php


namespace Juinsa\Services;


use Juinsa\db\entities\Order;


class OrderService extends Service
{
    /**
     * @param Order $order
     * @return Order|null
     */
    public function insertOrder(Order $order): ?Order
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

    /**
     * @param $id_customer
     * @return array|object[]
     */
    public function getOrdersByIdCustomer($id_customer)
    {
        return $this->doctrineManager->em->getRepository(Order::class)->findBy(
            array(
                'customer' => $id_customer
            )
        );
    }
}