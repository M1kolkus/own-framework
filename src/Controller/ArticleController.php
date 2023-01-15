<?php

namespace App\Controller;

use App\DB;

class ArticleController
{
    private DB $config;

    public function __construct()
    {
        $this->config = new DB();
    }

    /**
     * @throws \Exception
     */
    public function Show(): object
    {
        return $this->config->query("SELECT * FROM articles");
    }
}