<?php


namespace Juinsa\Services;


use Doctrine\ORM\Query\Expr\Join;
use Juinsa\db\entities\Product;
use Juinsa\db\entities\ProductAttribute;
use Juinsa\db\entities\ProductType;
use Juinsa\db\entities\ProductTypeAttribute;


class ProductService extends Service
{

    // creo que ahora lo saco con doctrine uno a uno desde el controlador de categorias
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

    /**
     * @param $id
     * @return object|null
     */
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
                        WHERE p.id IN (" . implode(',', $productsId) . ") AND pa.id = 7";
        $statement = $this->doctrineManager->em->getConnection()->prepare($rawQuery);
        $statement->execute();
        return $statement->fetchAll(5);
    }

    /**
     * @param integer $id
     * @param string $name
     * @return mixed[]
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getProductAdminList($id = null, $name = null)
    {
        $rawQuery = "SELECT p.id, p.name, c.name as category, (
                            SELECT pav.value as price
                            FROM product_attribute_values pav 
                            LEFT JOIN attributes_values av on pav.id = av.id_product_attribute_value
                            WHERE p.id = av.id_product  AND av.id_product_attribute = 7) as price
                    FROM products p
                    LEFT JOIN categories c on p.id_category = c.id
                    ";

        if(!is_null($id)) {
            $rawQuery .= " WHERE p.id = :id";
        } elseif(!is_null($name)) {
            $rawQuery .= " WHERE p.name LIKE :name";
        }

        $statement = $this->doctrineManager->em->getConnection()->prepare($rawQuery);

        if(!is_null($id)) {
            $statement->bindValue('id', $id);
        } elseif(!is_null($name)) {
            $statement->bindValue('name', "%".$name."%");
        }

        $statement->execute();

        return $statement->fetchAll(5);
    }



}