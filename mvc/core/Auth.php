<?php

namespace Core;
class Auth {
    public static function checkAdmin() {
        if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] !== true) {
            header("Location: " . $_ENV['BASE_URL'] . "/product-categories/base-oil");
            exit;
        }
    }
}
    