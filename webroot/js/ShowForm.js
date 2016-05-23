/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function ShowForm() {

	var uploader=new FileUploader( {
		message_error: 'Ошибка при загрузке файла', 
		form: 'uploadform',
		formfiles: 'files',
		uploadid: '<?php print $hash;?>',
		uploadscript: './upload.php',
		redirect_success: './step2.php?hash=<?php print $hash;?>',
		redirect_abort: './abort.php?hash=<?php print $hash;?>',
		portion: 1024*1024*2
		});

	if (!uploader) document.location='/upload/iframe.php?hash=<?php print $hash;?>';
	else {
		if (!uploader.CheckBrowser()) document.location='/upload/iframe.php?hash=<?php print $hash;?>';
		else {
			var e=document.getElementById('uploadform');
			if (e) e.style.display='block';

			}
		}
	}

