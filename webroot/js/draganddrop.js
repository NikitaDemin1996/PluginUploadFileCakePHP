/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Проверяем поддерживает ли браузер drag and drop
if('ondrop' in document.createElement('div')) {
    onload = function () {
        var dropZone = document.getElementById('dropZone');
        /*
         * Обработчик, срабатывающий, когда курсор с
         * перетаскиваем объектом оказывается над dropZone
        */
        dropZone.addEventListener('dragover', function (e) {
            // Останавливаем всплытие события
            e.stopPropagation();
            // останавливаем действие по умолчанию, связанное с эти событием.
            e.preventDefault();
            e.dataTransfer.dropEffect = 'copy';    
        }, false);

          /*
           * Обработчик, срабатывающий, когда мы
           * бросаем перетаскиваемые файлы в dropZone
           */
        dropZone.addEventListener('drop', function (e) {

            e.stopPropagation();
            e.preventDefault();

            var files = e.dataTransfer.files, info = '', file;

            for(var i = 0; file = files[i]; i++) {
              info += ['Файл',file.name, '(', file.type, ')', '-', file.size, 'байт'].join(' ') + '\nЗагружен на сервер';
            }

            alert(info);

        }, false);
    }
  // очень печально если браузер не поддерживает drag and drop
} 
else {
    alert("К великой печали ваш браузер не поддерживает Drag&Drop(");
}

