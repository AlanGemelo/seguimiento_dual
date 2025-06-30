<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Carrera;
use App\Models\DireccionCarrera;
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

        DireccionCarrera::insert([
            //  ['name' => 'Ingeniería en Sistemas Computacionales', 'email' => 'tics@utvtol.edu.mx'],
            ['name' => 'Dirección de Carrera de Mecatrónica y Sistemas Productivos', 'email' => 'mecatronica@utvtol.edu.mx'],
            ['name' => 'Dirección de Carrera de Mantenimiento Industrial', 'email' => 'mantenimiento.industrial@utvtol.edu.mx'],
            ['name' => 'Dirección de Carrera de Tecnologías de la Información y Comunicación', 'email' => 'informatica@utvtol.edu.mx'],
            ['name' => 'Dirección de Carrera de Tecnología Ambiental', 'email' => 'tecnologia.ambiental@utvtol.edu.mx'],
            ['name' => 'Dirección de Carrera de Negocios y Gestión Empresarial', 'email' => 'negocios@utvtol.edu.mx'],
            ['name' => 'Dirección de Carrera de Paramédico y Protección Civil', 'email' => 'paramedico@utvtol.edu.mx'],
            ['name' => 'Dirección de Carrera de Salud Pública y Enfermería', 'email' => 'salud.publica@utvtol.edu.mx'],
            ['name' => 'Dirección de Procesos Alimentarios y Química Área Biotecnología', 'email' => 'procesos.alimentarios@utvtol.edu.mx'],

        ]);

        Roles::insert([
            ['name' => 'Administrador'],
            ['name' => 'Mentor'],
            ['name' => 'Estudiante'],
            ['name' => 'Director'],
        ]);


        /*   Carrera::create([
            'grado_academico' => 'Técnico Superior Universitario',
            'nombre' => 'Desarrollo de Software Multiplataforma',
            'direccion_id' => 1,
        ]); */

        User::create([
            'titulo' => 'Admin',
            'name' => 'Super Admin',
            'apellidoP' => '',
            'apellidoM' => '',
            'email' => 'admin@seguimiento.utvt.com',
            'password' => Hash::make('12345678'),
            'rol_id' => 1,
            'carrera_id' => null,
            'direccion_id' => null,
        ]);

          User::create([
            'titulo' => 'Ingeniero',
            'name' => 'Roberto',
            'apellidoP' => 'Vinicio',
            'apellidoM' => 'Camacho',
            'email' => 'asesor@gmail.com',
            'password' => Hash::make('12345678'),
            'rol_id' => 2,
            'carrera_id' => 1,
            'direccion_id' => 1,
        ]);
         /* 
        User::create([
            'titulo' => 'Ingeniero Director',
            'name' => 'Carlos',
            'apellidoP' => 'Millan',
            'ApellidoM' => 'Hinojosa',
            'email' => 'carlos.millan@utvtol.edu.mx',
            'password' => Hash::make('12345678'),
            'rol_id' => 4,
            'carrera_id' => 1,
            'direccion_id' => 1,
        ]); */
    }
}
