<?php


namespace Juinsa\config;


class Config
{
    public static function getDB()
    {
        return parse_ini_file(__DIR__ . '/../database.ini');
    }
}