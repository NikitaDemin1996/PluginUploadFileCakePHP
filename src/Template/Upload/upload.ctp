<?php echo $this->Form->create(null, ['type' => 'file']);
    echo $this->Html->css(['PluginUploadFileCakePHP.ui']);
    echo $this->Html->script(['draganddrop','progressbar','jquery.min']);
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
        echo $this->Form->input('uploadfile.', ['type'=>'file','multiple','submit']);
        echo $this->Form->button('Upload', ['type' => 'submit']);
        echo $this->Html->link('FileManager', ['action'=>'filemanager']);
        echo $this->Form->end();  
    ?>
</div>
<center>
<div class ="file-alert">
    <?php
        echo 'Cписок выбранных файлов';
        if(!empty( $this->request->data)):?>
        <table>
            <tr>
                <th>Name</th>
                <th>Type</th>   
                <th>Solution</th>
                <th>Size</th>
            </tr>
        <?php foreach ($files as $file): ?>
            <tr>
                <td><?= $file['name']?></td>
                <td><?= $file['type'] ?></td>
                <td><?= $file['width']?>x<?= $file['height']?></td>
                <td><?= $file['size']?></td>
            </tr>
        <?php endforeach; ?>
        </table>
<?php endif;?>
</div>
</center>