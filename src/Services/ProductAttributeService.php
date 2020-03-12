<?php


namespace Juinsa\Services;


use Juinsa\db\entities\ProductAttribute;

class ProductAttributeService extends Service
{
    /**
     * @param ProductAttribute $productAttribute
     * @return ProductAttribute|null
     */
    public function createProductAttribute(ProductAttribute $productAttribute): ?ProductAttribute
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
     * @param integer $id
     * @return bool
     */
    public function remove($id)
    {
        try {
            $productAttribute = $this->getProductAttributeById($id);

            $this->doctrineManager->em->remove($productAttribute);
            $this->doctrineManager->em->flush();

            return true;
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return false;
    }

    /**
     * @param integer|null $id
     * @param string|null $name
     * @return mixed[]|null
     */
    public function getProductAttributeAdminList($id = null, $name = null)
    {
        try {
            $rawQuery = "SELECT pa.id, pa.name, pa.updated_at, pa.created_at
                    FROM product_attributes pa";

            return $this->modifyQueryForSearch("pa", $id, $name, $rawQuery);

        } catch (\Exception $exception) {
            $this->logManagaer->error($exception->getMessage());
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

    public function getProductAttributeById($id)
    {
        return $this->doctrineManager->em->getRepository(ProductAttribute::class)->findOneById($id);
    }

    public function getProductAttributes()
    {
        return $this->doctrineManager->em->getRepository(ProductAttribute::class)->findAll();
    }

}