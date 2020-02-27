<?php


use Phinx\Seed\AbstractSeed;

class ProductTypeAttributesSeeder extends AbstractSeed
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
            'id_product_type' => 1,
            'id_product_attribute' => 2,
            'created_at' => date('Y-m-d h:i:s')
        ];

        $this->insert('product_type_attributes', $data);
    }
}
