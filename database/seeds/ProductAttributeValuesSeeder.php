<?php


use Phinx\Seed\AbstractSeed;

class ProductAttributeValuesSeeder extends AbstractSeed
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
//        1	Sofa Exterior
//2	Silla Exterior
//3	Tortilla
//4	Ensalada
//5	Chubasquero Perro
//6	Correa Hurón
//7	Sofa Exterior
//8	Silla Exterior
//9	Tortilla
//10	Ensalada
//11	Chubasquero Perro
//12	Correa Hurón
//13	Sofa Exterior
//14	Silla Exterior
//15	Tortilla
//16	Ensalada
//17	Chubasquero Perro
//18	Correa Hurón


        $data[] = [
            'id_product' => 1,
            'id_attribute' => 2,
            'value' => "rojo",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 1,
            'id_attribute' => 3,
            'value' => "150",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 1,
            'id_attribute' => 4,
            'value' => "200",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 1,
            'id_attribute' => 5,
            'value' => "500",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 1,
            'id_attribute' => 6,
            'value' => "900",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 1,
            'id_attribute' => 7,
            'value' => "90.50",
            'created_at' => date('Y-m-d h:i:s')
        ];

        $data[] = [
            'id_product' => 2,
            'id_attribute' => 2,
            'value' => "rojo",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 2,
            'id_attribute' => 3,
            'value' => "50",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 2,
            'id_attribute' => 4,
            'value' => "100",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 2,
            'id_attribute' => 5,
            'value' => "200",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 2,
            'id_attribute' => 6,
            'value' => "450",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 2,
            'id_attribute' => 7,
            'value' => "20.35",
            'created_at' => date('Y-m-d h:i:s')
        ];

        $data[] = [
            'id_product' => 3,
            'id_attribute' => 6,
            'value' => "10",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 3,
            'id_attribute' => 8,
            'value' => (string)date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 3,
            'id_attribute' => 7,
            'value' => "4.2",
            'created_at' => date('Y-m-d h:i:s')
        ];

        $data[] = [
            'id_product' => 4,
            'id_attribute' => 6,
            'value' => "3",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 3,
            'id_attribute' => 8,
            'value' => (string)date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 3,
            'id_attribute' => 7,
            'value' => "2.82",
            'created_at' => date('Y-m-d h:i:s')
        ];

        $data[] = [
            'id_product' => 5,
            'id_attribute' => 9,
            'value' => "L",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 5,
            'id_attribute' => 2,
            'value' => "azul",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 5,
            'id_attribute' => 10,
            'value' => "Macho",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 5,
            'id_attribute' => 7,
            'value' => "5.6",
            'created_at' => date('Y-m-d h:i:s')
        ];

        $data[] = [
            'id_product' => 6,
            'id_attribute' => 9,
            'value' => "S",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 6,
            'id_attribute' => 2,
            'value' => "morado",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 6,
            'id_attribute' => 10,
            'value' => "Hembra",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'id_product' => 6,
            'id_attribute' => 7,
            'value' => "2.78",
            'created_at' => date('Y-m-d h:i:s')
        ];


        $this->insert('product_attribute_values', $data);
    }
}
