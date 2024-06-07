<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // try {
            // DB::beginTransaction();

            // Role::create(['name' => 'superadmin']);
            // Role::create(['name' => 'mahasiswa']);
            // Role::create(['name' => 'pengelola']);
            // Role::create(['name' => 'pembimbing']);
            // Role::create(['name' => 'penguji']);
            // Role::create(['name' => 'kaprodi']);

            $user = \App\Models\User::create([
                'nama' => 'Ginanjar Setyo Permadi, S.Kom., M.Kom',
                'no_induk' => 'UHA.01.0783',
                'email' => 'Uha.01.0783@unbhasy.ac.id',
                'password' => bcrypt('adminakademik')
            ]);

            // $user = \App\Models\User::where('id', '9bd25c1c-4447-4485-b371-fce6603ae94b')->first();

            $user->assignRole('superadmin');
            
       

    }
}
