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
     * @param integer|null $id
     * @param string|null $name
     * @return mixed[]|null
     */
    public function getProductTypeAdminList($id = null, $name = null)
    {
        try {
            $rawQuery = "SELECT pt.id, pt.name, pt.updated_at, pt.created_at
                    FROM product_types pt";

            return $this->modifyQueryForSearchByIdOrColumn("pt", $id, $name, $rawQuery);

        } catch (\Exception $exception) {
            $this->logManagaer->error($exception->getMessage());
        }

        return null;
    }

    /**
     * @param integer $idProductType
     * @return bool
     */
    public function remove($idProductType)
    {
        try {
            $productType = $this->getProductTypeById($idProductType);

            $this->doctrineManager->em->remove($productType);
            $this->doctrineManager->em->flush();

            return true;
        } catch (\Exception $e) {
            $this->logManagaer->error($e->getMessage());
        }

        return false;
    }

    /**
     * @return array|object[]
     */
    public function getProductTypes()
    {
        return $this->doctrineManager->em->getRepository(ProductType::class)->findAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProductTypeById($id)
    {
        return $this->doctrineManager->em->getRepository(ProductType::class)->findOneById($id);
    }

}