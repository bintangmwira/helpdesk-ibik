<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTanggapanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tanggapan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_laporan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_admin' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'isi_tanggapan' => [
                'type' => 'TEXT',
            ],
            'tanggal_tanggapan' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_tanggapan');
        $this->forge->addForeignKey('id_laporan', 'laporan', 'id_laporan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_admin', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tanggapan');
    }

    public function down()
    {
        $this->forge->dropForeignKey('tanggapan', 'tanggapan_id_laporan_foreign');
        $this->forge->dropForeignKey('tanggapan', 'tanggapan_id_admin_foreign');
        $this->forge->dropTable('tanggapan');
    }
}