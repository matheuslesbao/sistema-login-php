<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$this->e($title)?></title>
</head>

<body>
     <?=$this->insert('partials/header');?>
     
    <?= $this->section('content') ?>


    <?=$this->insert('partials/footer');?>
</body>

</html>