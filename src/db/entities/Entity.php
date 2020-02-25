<?php


namespace Juinsa\db\entities;


abstract class Entity
{
    public function __get(String $nameRow)
    {
        if (property_exists($this, $nameRow)) {
            return $this->{$nameRow};
        }
    }

    public function __set($nameRow, $value)
    {
        if (property_exists($this, $nameRow)) {
            $this->{$nameRow} = $value;
        }
    }
}