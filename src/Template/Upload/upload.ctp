<?php echo $this->Form->create(null, ['type' => 'file']);
    echo $this->Html->css(['PluginUploadFileCakePHP.ui']);
    echo $this->Html->script(['PluginUploadFileCakePHP.draganddrop','PluginUploadFileCakePHP.jquery.min','PluginUploadFileCakePHP.ajaxQuery']);
    $files = $this->get('list');
?>
<label>UploadImage</label>
<div id="dropZone">
    <center>
    Перетащите файл сюда<br>
 <?php echo $this->Html->image('PluginUploadFileCakePHP.ark_9313.png');?>
    </center>
</div>
<div class="ui">
    <?php 
        echo $this->Form->input('task_name',['type'=>'text','required']);
        echo $this->Form->input('uploadfile.', ['type'=>'file','multiple','submit','onClick'=>'createInput()']);
        echo $this->Form->button('Upload', ['type' => 'submit']);
        echo $this->Html->link('FileManager', ['action'=>'filemanager']);
        echo $this->Form->end();  
    ?>
</div>
