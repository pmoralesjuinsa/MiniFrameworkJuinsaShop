<?php


namespace Juinsa\Services;


use Juinsa\db\entities\Category;

class CategoryService extends Service
{

    public function getHomeCategories(): ?array
    {
        return $this->doctrineManager->em->getRepository(Category::class)->findAll();
    }

    public function getCategory($id): ?object
    {
        return $this->doctrineManager->em->getRepository(Category::class)->findOneById($id);
    }

}