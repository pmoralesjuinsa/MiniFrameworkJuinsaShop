<?php


namespace Juinsa\Services;


use Doctrine\ORM\Query\Expr\Join;
use Juinsa\db\entities\Product;
use Juinsa\db\entities\ProductAttribute;
use Juinsa\db\entities\ProductType;

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

    public function getProductAttributes($id): ?array
    {
        $sql = $this->doctrineManager->em->createQueryBuilder()
            ->select("pa")
            ->from(Product::class, 'p')
            ->leftJoin(ProductType::class, 'pt', Join::WITH, 'p = pt')
            ->leftJoin(ProductAttribute::class, 'pa', Join::WITH, 'pt = pa')
            ->where('p.id = ?1')
            ->setParameter(1, $id);

        return $sql->getQuery()->getResult();
    }

}