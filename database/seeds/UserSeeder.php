<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
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
        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $faker->sha1($faker->password),
                'created_at' => date('Y-m-d h:i:s')
            ];
        }

        $this->insert('users', $data);
    }
}
