<?php 
echo $this->Html->css(['filemanager','style']);
echo $this->Html->script(['script','jquery.min']);
$files = $this->get('array');
?>
<?php if(!is_null($files)):?>
    <table>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Solution</th>
            <th>Size</th>
            <th>Actions</th>
        </tr>
    
        <?php foreach ($files as $file): ?>
            <tr> 
                <td><?= $file['name']?></td>
                <td><?= $file['type'] ?></td>
                <td><?= $file['width']?>x<?= $file['height']?></td>
                <td><?= $file['size']?></td>
                <td><?= $this->Form->postLink(
                        'Delete',
                        ['action' => 'delete', $file['name']],
                        ['confirm' => 'Are you sure?'])

                    ?>
            </tr>    
        <?php endforeach; ?>
    </table>
<?php endif;?>
