<?php

//echo 'Hello, world';

$requestURi = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestURi === '/registration') {
    if ($requestMethod === 'GET') {
        require_once './registration/get_registration.php';
    } elseif ($requestMethod === 'POST') {
        require_once './registration/handle_registration.php';
    }

} elseif ($requestURi === '/catalog') {
    if ($requestMethod === 'GET') {
        require_once './catalog/catalog.php';
    } elseif ($requestMethod === 'POST') {
        require_once './catalog/catalog_page.php';
    }
} elseif ($requestURi === '/login') {
    if ($requestMethod === 'GET') {
        require_once './login/get_login.php';
    } elseif ($requestMethod === 'POST') {
        require_once './login/handle_login.php';
    }
} elseif ($requestURi === '/profile') {
    if ($requestMethod === 'GET') {
        require_once './profile/handle_profile.php';
    } elseif ($requestMethod === 'POST') {
        require_once './editProfile/handle_edit_profile.php';
    }
} elseif ($requestURi === '/edit_profile') {
    if ($requestMethod === 'GET') {
        require_once './get_edit_profile.php';
    } elseif ($requestMethod === 'POST') {
        require_once './handle_edit_profile.php';
    }
} elseif ($requestURi === '/add-product') {
    if ($requestMethod === 'GET') {
        require_once './addProduct/add_product_form.php';
    } elseif ($requestMethod === 'POST') {
        require_once './addProduct/handle_add_product.php';
    }
} else {
    require_once './404.php';
}