<?php


namespace Juinsa\Services;


use Juinsa\db\entities\Product;

class ProductService extends Service
{

    public function getProductsByCategoryId($id_category): ?array
    {
        return $this->doctrineManager->em->getRepository(Product::class)->findBy(
            array(
                "category" => $id_category
            )
        );

    }

    public function getProduct($id): ?object
    {
        return $this->doctrineManager->em->getRepository(Product::class)->findOneById($id);
    }

}