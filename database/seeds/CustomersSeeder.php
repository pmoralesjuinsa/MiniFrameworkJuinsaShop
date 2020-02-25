<?php


use Phinx\Seed\AbstractSeed;

class CustomersSeeder extends AbstractSeed
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
        $faker = \Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\es_ES\PhoneNumber($faker));

        $data = [];
        for ($i = 0; $i < 3; $i++) {
            $data[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->e164PhoneNumber(),
                'address' => $faker->address,
                'password' => $faker->sha1($faker->password),
                'created_at' => date('Y-m-d h:i:s')
            ];
        }

        $this->insert('customers', $data);
    }
}
