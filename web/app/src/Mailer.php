<?php

namespace App\Acme;

class Mailer
{
    public function mail($recipient, $content)
    {
         print "Enviando email:".$recipient ; 
    }
}