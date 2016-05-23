<?php echo $this->Form->create(null, ['type' => 'file']);
echo $this->Html->css(['ui']);
echo 'Select';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo $rad= $this->Form->radio(
    'file',
    [
        ['name'=> 'any', 'value' => 'a', 'text' => 'Any file'],
        ['name'=> 'big', 'value' => 'b', 'text' => 'Big file'],
        ['name'=> 'manager', 'value' => 'm', 'text' => 'File manager']
    ]
);
echo $this->Form->button('Next', ['type'=>'submit']);
