<?php
namespace PluginUploadFileCakePHP\Controller;

use App\Controller\AppController;
use PluginUploadFileCakePHP\Main\Manager\FileManager;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;


class UploadController extends AppController
{
    public function initialize() 
    {
        parent::initialize();
        $this->loadComponent('PluginUploadFileCakePHP.Upload');
        $this->loadComponent('Flash'); 
    }

    public function index()
    {
        $this->redirect(['action' => 'upload']);
    }
    
    public function delete($file){
        $this->request->allowMethod(['post', 'delete']);
        $dir = new Folder(WWW_ROOT . 'img'.DS. 'uploads');
        $filename = $dir->find($file.'.*\.(png|gif|jpeg|jpg)');
        foreach($filename as $f)
        {
            $files = new File($dir->pwd() . DS . $f);  
        }
        if ($files != NULL){
            $files->delete();
            $this->Flash->success(__('The file with name: {0} has been deleted.', $filename));
            return $this->redirect(['action' => 'filemanager']);
        }
    }

    public function upload()
    {
        if ( !empty( $this->request->data ) ) {
            $result=$this->Upload->main($this->request->data['uploadfile']); 
            $this->set('list', $result);
        }
    }
   
    public function filemanager()
    {
        $this->FileManager = new FileManager();
        $array = $this->FileManager->ReadFile();
        if(is_null($array)){
            $this->Flash->error(__("File not found. Upload file this server "));
        }
        $this->set('array', $array);
    }
}