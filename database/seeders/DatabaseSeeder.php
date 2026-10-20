<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@labrpl.test'], [
            'name' => 'Admin Lab', 'password' => Hash::make('password'), 'role' => 'admin',
        ]);
        $student = User::updateOrCreate(['email' => 'siswa@labrpl.test'], [
            'name' => 'Siswa Demo', 'password' => Hash::make('password'), 'role' => 'siswa',
        ]);

        $samples = [
            ['ALT-001', 'Arduino Uno R3', 'Mikrokontroler', 12, 'baik'],
            ['ALT-002', 'Router TP-Link', 'Jaringan', 8, 'baik'],
            ['ALT-003', 'Tang Crimping', 'Jaringan', 4, 'baik'],
            ['ALT-004', 'Raspberry Pi 4', 'Komputer', 6, 'baik'],
            ['ALT-005', 'Kabel LAN Cat6', 'Jaringan', 32, 'baik'],
            ['ALT-006', 'Multimeter Digital', 'Elektronika', 3, 'perlu_perbaikan'],
        ];
        foreach ($samples as [$code, $name, $category, $stock, $condition]) {
            Equipment::updateOrCreate(['code' => $code], compact('name', 'category', 'stock', 'condition'));
        }
    }
}
