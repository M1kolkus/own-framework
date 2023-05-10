<?php

declare(strict_types=1);

namespace App\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    private static ?View $instance = null;
    private Environment $twig;

    private function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Templates');
        $this->twig = new Environment($loader, [
            'cache' => __DIR__ . '/../../cache',
            'auto_reload' => true,
        ]);
    }

    public static function getInstance(): View
    {
        if (self::$instance === null) {
            self::$instance = new View();
        }

        return self::$instance;
    }

    public function render(string $path, array $params = []): string
    {
        return $this->twig->render($path, $params);
    }
}
