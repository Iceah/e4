<?php

namespace Inkweb\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class InkwebUserBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }
}
