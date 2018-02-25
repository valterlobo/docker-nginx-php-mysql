<?php

include '../app/vendor/autoload.php';

$foo = new App\Acme\Foo();
$contato = new App\Acme\Contato();
$contato->nome = "Teste Docker Composer dev ambiente";




?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Docker <?php echo $foo->getName(); ?></title>
    </head>
    <body>
        <h1>Docker <?php echo $foo->getName(); ?></h1>
           <h1>Contato: <?php echo $contato->nome;?></h1>
            <h1>REGISTER: <?php echo $userManager->register("valterlobo@mail.com" , "12333");?></h1>


           
    </body>
</html>
