<?php


namespace Juinsa\Services;


use Juinsa\db\entities\Category;

class CategoryService extends Service
{

    /**
     * @param Category $category
     * @return Category|null
     */
    public function createCategory(Category $category)
    {
        try {
            $this->doctrineManager->em->persist($category);
            $this->doctrineManager->em->flush();

            return $category;
        } catch (\Exception $exception) {
            $this->logManagaer->error($exception->getMessage());
        }

        return null;
    }

    public function getCategories(): ?array
    {
        return $this->doctrineManager->em->getRepository(Category::class)->findAll();
    }

    public function getCategory($id): ?object
    {
        return $this->doctrineManager->em->getRepository(Category::class)->findOneById($id);
    }

    /**
     * @param integer|null $id
     * @param string|null $name
     * @return mixed[]|null
     */
    public function getCategoryAdminList($id = null, $name = null)
    {
        try {
            $rawQuery = "SELECT c.id, c.name, c.updated_at, c.created_at
                    FROM categories c";

            return $this->modifyQueryForSearch("c", $id, $name, $rawQuery);

        } catch (\Exception $exception) {
            $this->logManagaer->error($exception->getMessage());
        }

        return null;
    }

}