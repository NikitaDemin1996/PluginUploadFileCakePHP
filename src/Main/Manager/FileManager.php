<?php
namespace PluginUploadFileCakePHP\Main\Manager;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class FileManager {
    
    public function ReadFile(){
        $dir = new Folder(WWW_ROOT . 'img'.DS. 'uploads');
        $files = $dir->find('.*\.(png|gif|jpeg|jpg)');
        $arrayFile = [];
        foreach($files as $file){    
            $file = new File($dir->pwd().DS.$file);
            $size = getimagesize($dir->pwd().DS.$file->name);
            array_push($arrayFile, ['name'=>$file->name(),'type'=>$file->mime(),'width'=>$size[0] ,'height'=>$size[1],'size'=>$file->size()]);
        }
        if(!empty($file)){
            return $arrayFile;
        }
        else{
            return null;
        }
    }    
}