<?php

namespace App\Controllers;

class AuthController
{
    public function loginForm()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        require __DIR__ . '/../Views/auth/login.php';
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Username dan password sementara menggunakan hardcode
        if ($username === 'admin' && $password === 'admin123') {

            $_SESSION['user_id'] = 1;
            $_SESSION['user_name'] = 'Admin';
            $_SESSION['logged_in'] = true;

            // Flash message untuk Tugas Mandiri
            $_SESSION['flash'] = 'Selamat datang, Admin';

            header('Location: ' . BASE_PATH . '/dashboard');
            exit;
        }

        $_SESSION['error'] = 'Username atau password salah.';

        header('Location: ' . BASE_PATH . '/login');
        exit;
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Flash message disimpan sebelum session dihancurkan
        $_SESSION['flash'] = 'Anda telah logout';

        // Simpan flash sementara
        $flash = $_SESSION['flash'];

        session_unset();
        session_destroy();

        // Mulai session baru untuk membawa flash message
        session_start();
        $_SESSION['flash'] = $flash;

        header('Location: ' . BASE_PATH . '/login');
        exit;
    }
}