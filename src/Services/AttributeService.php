<?php


namespace Juinsa\Services;


use Juinsa\db\entities\ProductAttribute;

class AttributeService extends Service
{
    /**
     * @param ProductAttribute $productAttribute
     * @return ProductAttribute|null
     */
    public function createProductType(ProductAttribute $productAttribute): ?ProductAttribute
    {
        try {
            $this->doctrineManager->em->persist($productAttribute);
            $this->doctrineManager->em->flush();

            return $productAttribute;
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return null;
    }


    public function getAttributesByProductTypeId($idProductType)
    {
        return $this->doctrineManager->em->getRepository(ProductType::class)->findAll();
    }

}