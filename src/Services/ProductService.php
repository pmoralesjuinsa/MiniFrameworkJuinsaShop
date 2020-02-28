<?php


namespace Juinsa\Services;


use Juinsa\db\entities\Product;

class ProductService extends Service
{

    public function getCategoryProducts($id_category): ?array
    {
        return $this->doctrineManager->em->getRepository(Product::class)->findBy(
            array(
                "id_category" => $id_category
            )
        );
    }

    public function getProduct($id): ?object
    {
        return $this->doctrineManager->em->getRepository(Product::class)->findOneById($id);
    }

}