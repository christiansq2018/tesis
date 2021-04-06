<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    App\Rol::create([
      'nombre' => 'Administrador'
    ]);

    App\Rol::create([
      'nombre' => 'Coordinador'
    ]);

    App\User::create([
      'nombre'   => 'John Doe',
      'usuario'  => 'admin',
      'email'    => 'admin@mail.com',
      'password' => bcrypt(123456),
      'role_id'  => 1
    ]);

    App\User::create([
      'nombre'   => 'Jim Doe',
      'usuario'  => 'coordinador',
      'email'    => 'coordinador@mail.com',
      'password' => bcrypt(123456),
      'role_id'  => 2
    ]);

    $proveedores = [
      "N/A",
      "INTERNO",
      "LABTEST",
      "CARESENS",
      "BIOTECH",
      "KAESER",
      "EXTERNO",
      "ANNAR",
      "ORTHO CLINICAL",
      "KAIKA",
      "BIOREG",
      "JOHNSON",
      "BIOIN",
      "FIRST MEDICAL",
      "AIRE FRIO",
      "ORTHOSYSTEM",
      "FRESENIUS",
      "GBARCO",
      "SERVITRONICS",
      "GENERAL ELECTRIC",
      "INTERNMO",
    ];

    foreach ($proveedores as $pro) {
      \App\Proveedor::create([
        'nombre' => $pro,
        'tipo' => 'mantenimiento'
      ]);
    }

    \App\Clasificacion::create([
      'nombre' => 'Prueba',
      'descripcion' => 'Clasificación de prueba'
    ]);

    DB::unprepared(file_get_contents(storage_path('app/ddbb.sql')));
  }
}
