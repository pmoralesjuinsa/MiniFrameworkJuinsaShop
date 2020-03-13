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
     * @param $id_order
     * @return array|object[]
     */
    public function getOrdersByIdCustomer($id_order)
    {
        return $this->doctrineManager->em->getRepository(Order::class)->findBy(
            array(
                'order' => $id_order
            )
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getOrderById($id) {
        return $this->doctrineManager->em->getRepository(Order::class)->findOneById($id);
    }

    public function getOrders()
    {
        return $this->doctrineManager->em->getRepository(Order::class)->findAll();
    }

    /**
     * @param integer $id
     * @return bool
     */
    public function remove($id)
    {
        try {
            $object = $this->getOrderById($id);

            $this->doctrineManager->em->remove($object);
            $this->doctrineManager->em->flush();

            return true;
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return false;
    }

    /**
     * @param integer|null $id
     * @param string|null $name
     * @return mixed[]|null
     */
    public function getOrderAdminList($id = null, $stringValue = null)
    {
        try {
            $rawQuery = "SELECT o.id, os.value as status, o.total, c.email, o.created_at
                    FROM orders o
                    LEFT JOIN customers c ON c.id = o.id_customer
                    LEFT JOIN order_status os ON os.id = o.id_status
                    ";

            $column = ["alias" => "c", "column" => "email", "value" => $stringValue];

            return $this->modifyQueryForSearchByIdOrColumn("o", $id, $column, $rawQuery);

        } catch (\Exception $exception) {
            $this->logManagaer->error($exception->getMessage());
        }

        return null;
    }
}