<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;
use Hyperf\DbConnection\Db;

class UserStoredLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            Db::table('user_stored_log')->insert([
                'user_id' => 1,
                'type' => 1,
                'amount' => mt_rand(1, 10),
                'source' => 1,
                'remark' => 'pay',
                'create_time' => time(),
                'update_time' => time(),
            ]);
        }
    }
}
