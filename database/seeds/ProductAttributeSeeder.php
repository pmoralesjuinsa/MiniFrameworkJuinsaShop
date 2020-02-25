<?php


use Phinx\Seed\AbstractSeed;

class ProductAttributeSeeder extends AbstractSeed
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
            'value' => "Nombre",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'value' => "Color",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'value' => "Ancho",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'value' => "Alto",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'value' => "Largo",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'value' => "Peso",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'value' => "Precio",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'value' => "Caducidad",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'value' => "Talla",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'value' => "Sexo",
            'created_at' => date('Y-m-d h:i:s')
        ];


        $this->insert('product_attributes', $data);
    }
}
