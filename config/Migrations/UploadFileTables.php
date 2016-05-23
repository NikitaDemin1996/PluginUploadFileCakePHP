<?php
use Migrations\AbstractMigration;
class UploadFilesTables extends AbstractMigration
{
    public function change()
    {
        $tableFile = $this->table('file',['id' => false, 'primary_key' => ['id']]);
        $tableFile->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'limit' => 11
            ]);
       
        $tableFile->addColumn('name_file', 'string', [
             'default' => null,
            'limit' => 1000
        ]);
        $tableFile->addColumn('error_name', 'string', [
             'default' => null,
            'limit' => 1000
        ]);
        $tableFile->addColumn('data', 'datetime');
        $tableFile->create();
        
        $tableFile = $this->table('task',['id' => false, 'primary_key' => ['id']]);
        $tableFile->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'limit' => 11
            ]);
       
        $tableFile->addColumn('file_name', 'string', [
             'default' => null,
            'limit' => 1000
        ]);
        $tableFile->addColumn('task_name', 'string', [
             'default' => null,
            'limit' => 1000
        ]);
        $tableFile->addColumn('data', 'datetime');
        $tableFile->create();
    }
}