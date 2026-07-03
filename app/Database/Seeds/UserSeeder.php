<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $mahasiswaRaw = [
            [
                'npm'   => '242210009',
                'nama'  => 'Bintang Mustika',
                'email' => '242210009@student.ibik.ac.id',
            ],
            [
                'npm'   => '242210044',
                'nama'  => 'Aulia Fasha Bila',
                'email' => '242210044@student.ibik.ac.id',
            ],
            [
                'npm'   => '242210042',
                'nama'  => 'Hari Pratama',
                'email' => '242210042@student.ibik.ac.id',
            ],
            [
                'npm'   => '242210001',
                'nama'  => 'Diandra Emeraldo',
                'email' => '242210001@student.ibik.ac.id',
            ]
        ];

        $data = [
            [
                'npm'        => null,
                'nama'       => 'Administrator',
                'email'      => 'admin@ibik.ac.id',
                'password'   => password_hash('admin123', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ]
        ];

        foreach ($mahasiswaRaw as $mhs) {
            $data[] = [
                'npm'        => $mhs['npm'],
                'nama'       => $mhs['nama'],
                'email'      => $mhs['email'],
                'password'   => password_hash($mhs['npm'], PASSWORD_DEFAULT),
                'role'       => 'mahasiswa',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ];
        }

        $this->db->table('users')->insertBatch($data);
    }
}