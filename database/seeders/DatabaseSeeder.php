<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Carrera;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Roles::create([
                'name' => 'Administrador'
        ]);

        Roles::create([
            'name' => 'Mentor'
        ]);

        Carrera::create([
            'nombre' => 'admin'
        ]);

        User::create([
            'titulo' => 'Admin',
            'name'=> 'Admin Dual',
            'email' => 'admin@seguimiento.utvt.com',
            'password' => Hash::make('12345678'),
            'rol_id' => 1,
            'carrera_id' => 1
        ]);
        User::create([
            'titulo' => 'Admin',
            'name'=> 'Admin Dual',
            'email' => 'mago@gmail.com',
            'password' => Hash::make('12345678'),
            'rol_id' => 2,
            'carrera_id' => 1
        ]);
    }
}
