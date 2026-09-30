<?php

namespace App\Controllers;

class BaseController
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);

        require __DIR__ . '/../Views/' . $view . '.php';
    }

    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }

    protected function setFlash(string $type, string $message): void
    {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message,
        ];
    }

    protected function getFlash(): ?array
    {
        $flash = $_SESSION['flash'] ?? null;

        unset($_SESSION['flash']);

        return $flash;
    }
}