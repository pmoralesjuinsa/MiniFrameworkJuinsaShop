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



    public function getAllProductInfo($id_product)
    {
        $rawQuery = "SELECT p.id, p.name, pa.name as attributeName, pa.id as attributeId, pav.value as attributeValue
                        FROM products p
                        LEFT JOIN attributes_values av on p.id = av.id_product
                        LEFT JOIN product_attribute_values pav on av.id_product_attribute_value = pav.id
                        LEFT JOIN product_attributes pa on av.id_product_attribute = pa.id
                        WHERE p.id = :id_product";
        $statement = $this->doctrineManager->em->getConnection()->prepare($rawQuery);
        $statement->bindValue('id_product', $id_product);
        $statement->execute();

        return $statement->fetchAll(5);
    }

    public function getProduct($id): ?object
    {
        return $this->doctrineManager->em->getRepository(Product::class)->findOneById($id);
    }

    public function getProductsPrice($productsId)
    {
        $rawQuery = "SELECT p.id as productId, p.name, pav.value as price
                        FROM products p
                        LEFT JOIN attributes_values av on p.id = av.id_product
                        LEFT JOIN product_attribute_values pav on av.id_product_attribute_value = pav.id
                        LEFT JOIN product_attributes pa on av.id_product_attribute = pa.id
                        WHERE p.id IN (".implode(',',$productsId).") AND pa.id = 7";
        $statement = $this->doctrineManager->em->getConnection()->prepare($rawQuery);
        $statement->execute();
        return $statement->fetchAll(5);
    }

}