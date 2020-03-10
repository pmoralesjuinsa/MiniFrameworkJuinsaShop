<?php


namespace Juinsa\Services;


use Juinsa\db\entities\ProductType;

class ProductTypeService extends Service
{
    /**
     * @param ProductType $productType
     * @return ProductType|null
     */
    public function createProductType(ProductType $productType): ?ProductType
    {
        try {
            $this->doctrineManager->em->persist($productType);
            $this->doctrineManager->em->flush();

            return $productType;
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return null;
    }

    /**
     * @return array|object[]
     */
    public function getProductTypes()
    {
        return $this->doctrineManager->em->getRepository(ProductType::class)->findAll();
    }

}