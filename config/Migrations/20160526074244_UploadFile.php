<?php
use Migrations\AbstractMigration;

class UploadFile extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $tableFile = $this->table('file',['id' => false, 'primary_key' => ['id']]);
        $tableFile->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'limit' => 11
        ]);       
        $tableFile->addColumn('name_file', 'string', [
            'limit' => 1000
        ]);
        $tableFile->addColumn('error_name', 'string', [
            'default' => null,
            'limit' => 1000
        ]);   
        $tableFile->addColumn('data', 'datetime');
        $tableFile->create();
        
        $tableFileS = $this->table('task',['id' => false, 'primary_key' => ['id']]);
        $tableFileS->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'limit' => 11
        ]);
        $tableFileS->addColumn('file_name', 'string', [
            'default' => null,
            'limit' => 1000
        ]);
        $tableFileS->addColumn('task_name', 'string', [
            'default' => null,
            'limit' => 1000
        ]);
        $tableFileS->addColumn('data', 'datetime');
        $tableFileS->create();
    }
}
