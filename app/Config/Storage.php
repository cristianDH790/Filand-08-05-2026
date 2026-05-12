<?php

namespace Config;

class Storage
{
    public string $archivosRoot;
    public string $archivosUrl;
    public string $visibility = 'public';

    public function __construct()
    {
        
        $this->archivosRoot = FCPATH . getenv('URL_IMAGE'); 
        $this->archivosUrl  = getenv('FRONT_SITE') . 'archivos/'; 
    }
}
