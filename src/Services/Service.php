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
     * @param integer|null $id
     * @param array|null $column
     * @param string $rawQuery
     * @return mixed[]|null
     */
    protected function modifyQueryForSearchByIdOrColumn($alias, $id, $column, string $rawQuery)
    {
        try {
            if (!is_null($id)) {
                $rawQuery .= " WHERE ".$alias.".id = :id";
            } elseif (!is_null($column)) {
                $rawQuery .= " WHERE ".$column->alias.".".$column->name." LIKE :name";
            }

            $statement = $this->doctrineManager->em->getConnection()->prepare($rawQuery);

            if (!is_null($id)) {
                $statement->bindValue('id', $id);
            } elseif (!is_null($column)) {
                $statement->bindValue('name', "%" . $column->value . "%");
            }

            $statement->execute();

            return $statement->fetchAll(5);
        } catch (\Exception $exception) {
            $this->logManagaer->error($exception->getMessage());
        }

        return null;
    }
}