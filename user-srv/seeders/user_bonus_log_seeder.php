<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;
use Hyperf\DbConnection\Db;

class UserBonusLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            Db::table('user_bonus_log')->insert([
                'user_id' => 1,
                'type' => 1,
                'bonus' => mt_rand(1, 10),
                'source' => 1,
                'remark' => 'order',
                'create_time' => time(),
                'update_time' => time(),
            ]);
        }

    }
}
