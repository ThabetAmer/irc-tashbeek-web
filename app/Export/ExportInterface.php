<?php
/**
 * Created by PhpStorm.
 * User: mohammedsehweil
 * Date: 1/14/19
 * Time: 6:04 PM
 */

namespace App\Export;


interface ExportInterface
{

    /**
     * @return mixed
     */
    public function getHeaders();

    /**
     * @return mixed
     */
    public function getData();


    /**
     * @return mixed
     */
    public function getTitle();



}