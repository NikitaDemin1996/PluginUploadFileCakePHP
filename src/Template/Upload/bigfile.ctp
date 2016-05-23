<?php echo $this->Form->create(null, ['type' => 'file']);
      echo $this->Html->css(['ui']);
      echo $this->Html->script(['fileuploader','ShowForm']);?>
<?php
    #$hash=h(stripslashes($_GET["hash"]));
    #$hash=md5("test");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title>Big upload</title>
    <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
    <script type="text/javascript" src="./fileuploader.js?nc=<?php print time();?>"></script>
</head>
<body onload="ShowForm();">
    <div class="content">
        <p>Максимальный размер файла при загрузке через браузер - <b>4Гб</b>.</p>
        <form action="./" method="post" id="uploadform" onsubmit="return false;" style="display:none;">
            <table class="colortable" cellspacing=1>
                <tr><td><div id="message">Выберите файл:</div></td><td><input type="file" id="files" name="files[]" /></td></t>
            </table>
            <input type="submit" value="Загрузить &gt;&gt;" />
        </form>
        <div id="cnuploader_progressbar"></div>
        <div id="cnuploader_progresscomplete"></div>
    </div>
</body>
</html>
