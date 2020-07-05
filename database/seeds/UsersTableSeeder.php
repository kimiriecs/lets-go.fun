<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Автор неизвестен',
                'email' => 'unknown@mail.com',
                'password' => bcrypt(Str::random(16)),
            ],
            [
                'name' => 'Автор',
                'email' => 'autor@mail.com',
                'password' => bcrypt(123123),
            ],
        ];
        DB::table('users')->insert($data);
    }
}
