<?php


use Phinx\Seed\AbstractSeed;

class ProductTypesSeeder extends AbstractSeed
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
        $data[] = [
            'name' => "Mobiliario de exterior",
            'created_at' => date('Y-m-d h:i:s')
        ];

        $this->insert('product_types', $data);
    }
}
