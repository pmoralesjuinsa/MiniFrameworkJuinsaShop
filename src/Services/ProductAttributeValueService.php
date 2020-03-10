<?php


namespace Juinsa\Services;


use Juinsa\db\entities\ProductAttributeValue;

class ProductAttributeValueService extends Service
{
    /**
     * @param ProductAttributeValue $productAttributeValue
     * @return ProductAttributeValue|null
     */
    public function createProductAttributeValue(ProductAttributeValue $productAttributeValue): ?ProductAttributeValue
    {
        try {
            $this->doctrineManager->em->persist($productAttributeValue);
            $this->doctrineManager->em->flush();

            return $productAttributeValue;
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return null;
    }

}