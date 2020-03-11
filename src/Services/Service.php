<?php


namespace Juinsa\Services;


use Juinsa\DoctrineManager;
use Juinsa\LogManager;

abstract class Service
{
    protected $doctrineManager;
    protected $logManagaer;

    public function __construct(DoctrineManager $doctrineManager, LogManager $logManagaer)
    {
        $this->doctrineManager = $doctrineManager;
        $this->logManagaer = $logManagaer;

        $this->logManagaer->info("Service ->".get_class($this)." up");
    }

    /**
     * @param $id
     * @param $name
     * @param string $rawQuery
     * @return mixed[]|null
     */
    protected function modifyQueryForSearch($alias, $id, $name, string $rawQuery)
    {
        try {
            if (!is_null($id)) {
                $rawQuery .= " WHERE ".$alias.".id = :id";
            } elseif (!is_null($name)) {
                $rawQuery .= " WHERE ".$alias.".name LIKE :name";
            }

            $statement = $this->doctrineManager->em->getConnection()->prepare($rawQuery);

            if (!is_null($id)) {
                $statement->bindValue('id', $id);
            } elseif (!is_null($name)) {
                $statement->bindValue('name', "%" . $name . "%");
            }

            $statement->execute();

            return $statement->fetchAll(5);
        } catch (\Exception $exception) {
            $this->logManagaer->error($exception->getMessage());
        }

        return null;
    }
}