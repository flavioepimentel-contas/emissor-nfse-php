<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 09/02/2020
 * Time: 18:08
 */

namespace Nfsews\Providers\Webiss\V2_02\Request;


interface IRequest
{

    public function getAction();

    public function getAllAttributes();

    public function toXml();

}