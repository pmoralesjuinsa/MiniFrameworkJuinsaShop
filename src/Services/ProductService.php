<?php


namespace Juinsa\Services;


use Doctrine\ORM\Query\Expr\Join;
use Juinsa\db\entities\Product;
use Juinsa\db\entities\ProductAttribute;
use Juinsa\db\entities\ProductType;
use Juinsa\db\entities\ProductTypeAttribute;


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

    public function getProductAttributes($id)
    {
//        TODO DEUDA TÉNICA

//        $sql = $this->doctrineManager->em->createQueryBuilder()
//            ->select("pt")
//            ->from(Product::class, 'p')
//            ->leftJoin(ProductType::class, 'pt', Join::WITH, 'p.product_type = pt.id')
//            ->leftJoin(ProductTypeAttribute::class, 'pta', Join::WITH, 'pt.id = pta.id_product_type')
//            ->where('p.id = ?1')
//            ->setParameter(1, $id);
//
//        $result = $sql->getQuery()->getSQL();
//        return $result;

        $rawQuery = "SELECT p0_.id AS id, p0_.value AS name, p3_.value
                    FROM products p1_
                    LEFT JOIN product_types p2_ ON p1_.id_product_type = p2_.id
                    LEFT JOIN product_type_attributes p3_ ON (p2_.id = p3_.id_product_type)
                    LEFT JOIN product_attributes p0_ ON (p3_.id_product_attribute = p0_.id)
                    WHERE p1_.id = :id_product";
        $statement = $this->doctrineManager->em->getConnection()->prepare($rawQuery);
        $statement->bindValue('id_product', 3);
        $statement->execute();
        return $statement->fetchAll();

//        $rsm = new ResultSetMapping();
//
//        $query = $this->doctrineManager->em->createNativeQuery('
//                    SELECT p0_.id AS id, p0_.value AS name, p3_.value
//                    FROM products p1_
//                    LEFT JOIN product_types p2_ ON p1_.id_product_type = p2_.id
//                    LEFT JOIN product_type_attributes p3_ ON (p2_.id = p3_.id_product_type)
//                    LEFT JOIN product_attributes p0_ ON (p3_.id_product_attribute = p0_.id)
//                    WHERE p1_.id = ?', $rsm);
//
//        $query->setParameter(1, 3);
//
//        return $query->getResult();

    }

}