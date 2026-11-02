<?php

namespace Database\Seeders;

use App\Models\Employe;
use Illuminate\Database\Seeder;

class EmployeTestSeeder extends Seeder
{
    public function run(): void
    {
        Employe::updateOrCreate(
            ['email' => 'admin.test@volta.local'],
            [
                'nom' => 'Admin Test',
                'telephone' => null,
                'password' => 'AdminTest123!',
                'role' => 'ADMIN_TRAITEMENT',
                'actif' => true,
            ]
        );

        Employe::updateOrCreate(
            ['email' => 'mesure.test@volta.local'],
            [
                'nom' => 'Maître Mesure Test',
                'telephone' => null,
                'password' => 'MesureTest123!',
                'role' => 'MAITRE_MESURE',
                'actif' => true,
            ]
        );
    }
}
