<?php


use Phinx\Seed\AbstractSeed;

class OrderStatusSeeder extends AbstractSeed
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
            'value' => "Pending",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'value' => "Sended",
            'created_at' => date('Y-m-d h:i:s')
        ];
        $data[] = [
            'value' => "Completed",
            'created_at' => date('Y-m-d h:i:s')
        ];


        $this->insert('order_status', $data);
    }
}
