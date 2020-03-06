<?php


namespace Juinsa\Services;


use Doctrine\ORM\Query\Expr\Join;
use Juinsa\db\entities\Product;
use Juinsa\db\entities\ProductAttribute;
use Juinsa\db\entities\ProductType;
use Juinsa\db\entities\ProductTypeAttribute;


class ProductService extends Service
{

//    public function getProductsByCategoryId($idCategory): ?array
//    {
//        return $this->doctrineManager->em->getRepository(Product::class)->findBy(
//            array(
//                "category" => $idCategory
//            )
//        );
//
//    }

    public function getProduct($id): ?object
    {
        return $this->doctrineManager->em->getRepository(Product::class)->findOneById($id);
    }

    public function getProductsInfo($productsId)
    {
        //TODO DEUDA TÉNICA
        $rawQuery = "SELECT p.id as productId ,p.name, (SELECT pta.value FROM product_type_attributes pta WHERE pta.id_product_attribute = 7 and pta.id_product = p.id) as price
                    FROM products p
                    WHERE p.id IN (".implode(',', $productsId).")";
        $statement = $this->doctrineManager->em->getConnection()->prepare($rawQuery);
        $statement->execute();
        return $statement->fetchAll(5);
    }

}