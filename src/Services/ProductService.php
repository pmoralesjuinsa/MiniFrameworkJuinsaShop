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

    public function getProductAttributes($id): ?object
    {
        $sql = $this->doctrineManager->em->createQueryBuilder()
            ->select("pt")
            ->from('products', 'p')
            ->leftJoin('p.product_types', 'pt')
            ->where('p.id = ?1')
            ->setParameter(1, $id);

        return $sql->getQuery()->getResult();
    }

}