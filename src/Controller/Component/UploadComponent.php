<?php
namespace PluginUploadFileCakePHP\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\InternalErrorException;
use Cake\Core\Configure;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Upload component
 */
class UploadComponent extends Component
{
    /*
        * function main
        */
    public function main($data){
        Configure::load('UploadConfig');
        $param = Configure::read('Upload');
    	if ( !empty($data) ) {
            if (count( $data ) > $param['max_files']) {
    		$message = 'Error Processing Request. Max number files accepted is '.$param['max_files'];
                $this->recordError($message, $data);
                throw new InternalErrorException("Error Processing Request. Max number files accepted is {$param['max_files']}", 1);
            }
            $list=[];
            $array_files=[];
            foreach ($data as $file) {
                $error = $this->triggerErrors($file);
                if ($error === false) {
                    continue;
                }   
                elseif (is_string($error)) {
                    $this->recordError($error,$file);                      
                    throw new \ErrorException($error);   
                }
                $file_tmp_name = $file['tmp_name'];
                $this->inspection($file,$file_tmp_name);                     
                $filename = $file['name'];
                $this->resolutionFile($file_tmp_name, $file, $list, $param);                               
                move_uploaded_file($file_tmp_name, $param['dir'].DS.$filename);      
                $task = TableRegistry::get('task');
                $result_date = new \DateTime('now', new \DateTimeZone('Asia/Novosibirsk'));
                $result_task = $task->newEntity(
                    ['file_name' => $filename,
                     'task_name' => $this->request->data['task_name'],   
                     'data' =>$result_date                                            
                    ]);
                $task->save($result_task);     
                echo "<script>alert(\"Файл {$filename} успешно загружен на сервер.\");</script>";  
            }
    	}
    }
    
    /**
     * Trigger upload errors.
     *
     * @param  array $data The file to check.
     *
     * @return string|int|void
     */
    protected function triggerErrors($data){
        if (!empty($data['error'])) {
            switch ((int)$data['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    $message = __('The uploaded file exceeds the upload_max_filesize directive in php.ini : {0}', ini_get('upload_max_filesize'));
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $message = __('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.');
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $message = false;
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $message = __('The uploaded file was only partially uploaded.');
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $message = __('Missing a temporary folder.');
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $message = __('Failed to write file to disk.');
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $message = __('A PHP extension stopped the file upload.');
                    break;
                default:
                    $message = __('Unknown upload error.');
            }
            return $message;
        }
    }
    
    /**
        Record error,name_file and date errors system
        */
    public function recordError( $message, $file ){
        if(!empty($message)){
            $file_a = TableRegistry::get('file');
            $result_date = new \DateTime('now', new \DateTimeZone('Asia/Novosibirsk'));
            $result_error = $file_a->newEntity(
               ['name_file' => $file['name'],
                'error_name' =>$message,
                'data' =>$result_date ,                                            
               ]);
            $file_a->save($result_error);   
        }
        return TRUE;        
    }
    
    /*
        * function inspection type file
        */
    public function inspection($file,$file_tmp_name){
        if(!empty($file)){
            $filename = $file['name'];
            //black type file
            $blacklist = array(".php", ".phtml", ".php3", ".php4");
            foreach ($blacklist as $item){
                if (preg_match("/$item\$/i", $file['name'])) 
                {
                    $message = 'No upload scripts';
                    $this->recordError($message, $file);
                    throw new InternalErrorException("No upload scripts."); 
                }
            }
            $allowed = array('png', 'jpg', 'jpeg','gif');
            if ( !in_array( substr( strrchr( $filename , '.') , 1 ) , $allowed) ){
                $message = 'Error Processing Request';
                $this->recordError($message, $file);
                throw new InternalErrorException("Error Processing Request.", 1);		
            }
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_a = finfo_file($finfo, $file_tmp_name);
            finfo_close($finfo);
            if(strcmp(($file['type']),($file_a))!=0){
                $message = 'You can only upload files format jpg, jpeg, gif и png';
                $this->recordError($message, $file);
                throw new InternalErrorException("You can only upload files format jpg, jpeg, gif и png.", 1); 
            }
        }     
    }
    
    /*
     * function inspection resolution file
     */
    public function resolutionFile($file_tmp_name,$file,$list,$param)
    {
        $size = getimagesize($file_tmp_name);
        array_push($list,['name'=>$file['name'],'type'=>$file['type'],'width'=>$size[0] ,'height'=>$size[1],'size'=>$file['size']]);
        if ($size[0] < $param['pic_width'] && $size[1] < $param['pic_height']){
            return $list;
        }
        else{
            $message = 'Size of image pixels more than permissible width or height';
            $this->recordError($message, $file);
            throw new InternalErrorException ("Size of image pixels more than permissible width or height");
        }
    }
}

