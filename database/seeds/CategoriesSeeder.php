<?php


use Phinx\Seed\AbstractSeed;

class CategoriesSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [];

        $data[] = [
            'name' => "Muebles de Jardín",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'name' => "Comida precocinada",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'name' => "Ropa para animales",
            'created_at' => date('Y-m-d h:i:s')
        ];


        $this->insert('categories', $data);
    }
}
