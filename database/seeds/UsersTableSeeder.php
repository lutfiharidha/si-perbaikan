<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Kepala Unit Perbaikan';
        $user->email = 'ku@dayah.com';
        $user->password = bcrypt('lolipop00');
        $user->level = 'admin';
        $user->save();

        $user = new User;
        $user->name = 'Kepala Sekolah';
        $user->email = 'ks@dayah.com';
        $user->password = bcrypt('lolipop00');
        $user->level = 'sekolah';
        $user->save();

        $user = new User;
        $user->name = 'Kepala Asrama';
        $user->email = 'ka@dayah.com';
        $user->password = bcrypt('lolipop00');
        $user->level = 'asrama';
        $user->save();
    }
}
