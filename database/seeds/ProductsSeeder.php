<?php


use Phinx\Seed\AbstractSeed;

class ProductsSeeder extends AbstractSeed
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
            'name' => "Sofa Exterior",
            'id_category' => 3,
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'name' => "Silla Exterior",
            'id_category' => 3,
            'created_at' => date('Y-m-d h:i:s')
        ];

        $data[] = [
            'name' => "Tortilla",
            'id_category' => 4,
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'name' => "Ensalada",
            'id_category' => 4,
            'created_at' => date('Y-m-d h:i:s')
        ];

        $data[] = [
            'name' => "Chubasquero Perro",
            'id_category' => 5,
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'name' => "Correa Hurón",
            'id_category' => 5,
            'created_at' => date('Y-m-d h:i:s')
        ];

        $this->insert('products', $data);
    }
}
