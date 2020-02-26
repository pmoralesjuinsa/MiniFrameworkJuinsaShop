<?php


use Phinx\Seed\AbstractSeed;

class CustomerForLogin extends AbstractSeed
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

        $data[] = [
            'name' => $faker->name,
            'email' => "pedromorales@grupojuinsa.es",
            'phone' => $faker->e164PhoneNumber(),
            'address' => $faker->address,
            'password' => sha1("123456"),
            'created_at' => date('Y-m-d h:i:s')
        ];


        $this->insert('customers', $data);
    }
}
