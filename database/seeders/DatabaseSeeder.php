<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Models\Message;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        self::seedGenders();
        self::seedUsers();
        self::seedMessages();
        self::seedRoles();
    }

    private static function seedGenders() {
        DB::table('genders')->delete();
        $genders = ['Hombre', 'Mujer', 'Otro'];
        foreach ($genders as $gender) {
            $g = new Gender();
            $g->description = $gender;
            $g->save();
        }
    }

    private static function seedUsers() {
        DB::table('users')->delete();
        User::factory(10)->create();
    }

    private static function seedMessages() {
        DB::table('messages')->delete();
        Message::factory(200)->create();
    }

    private static function seedRoles() {
        DB::table('roles')->delete();
        $roles = ['admin' => 'Administrator', 'user' => 'User'];
        foreach ($roles as $name => $description) {
            $role = new Role();
            $role->name = $name;
            $role->description = $description;
            $role->save();
        }
    }

}
