<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dev</title>
    <?= $this->Html->css('users.css') ?>
</head>
<body>
    <div id='modal_bg'></div>                
    <div id='modal_window'>                        
        <span class='close'>&times;</span>
    </div>
    <div class="container">
        <div class="header_content">
            <a href="/users/viewContent" class="header_title auchor">User Content</a>
        </div>
    </div>
    <?= $this->fetch('content') ?>
</body>
</html>