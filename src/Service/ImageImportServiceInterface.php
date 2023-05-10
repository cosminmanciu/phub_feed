<?php

namespace App\Service;


interface ImageImportServiceInterface
{
    /**
     * @param string $source
     * @return void
     */
    public function import(string $source): void;

}
