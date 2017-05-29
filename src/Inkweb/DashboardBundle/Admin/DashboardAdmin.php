<?php
/**
 * Created by PhpStorm.
 * User: arden
 * Date: 29/05/2017
 * Time: 06:54
 */

namespace Inkweb\DashboardBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;

class DashboardAdmin extends Admin
{
    public function getTemplate($name)
    {
        switch ($name) {
            case 'list':
                return 'InkwebDashboardBundle:Default:index.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
}