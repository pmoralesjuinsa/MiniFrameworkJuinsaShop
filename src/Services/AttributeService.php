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


    /**
     * @param $idProductType
     * @return mixed[]|null
     */
    public function getAttributesByProductTypeId($idProductType)
    {
        try {
            $rawQuery = "SELECT pa.name, pa.id
                        FROM product_attributes pa
                        LEFT JOIN product_type_attributes pta ON pa.id = pta.id_product_attribute
                        WHERE pta.id_product_type = :idProductType";
            $statement = $this->doctrineManager->em->getConnection()->prepare($rawQuery);
            $statement->bindValue('idProductType', $idProductType);
            $statement->execute();

            return $statement->fetchAll(5);

        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return null;

    }

}