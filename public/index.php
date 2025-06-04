<?php
// Autoloader untuk memuat class secara otomatis
spl_autoload_register(function ($class_name) {
    $paths = [
        __DIR__ . '/app/models/',
        __DIR__ . '/app/controllers/',
        __DIR__ . '/config/'
    ];
    foreach ($paths as $path) {
        $file = $path . $class_name . '.php';
        if (file_exists($file)) {
            include_once $file;
            return;
        }
    }
});

// Ambil parameter dari URL
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'penjualan'; // Default ke penjualan

switch($controllerName) {
    case 'pelanggan':
        include "../app/controllers/PelangganController.php";
        $controller = new PelangganControllers(); // Perbaiki penamaan class
        break;
    
    case 'produk':
        include "../app/controllers/ProdukController.php";
        $controller = new ProdukControllers(); // Perbaiki penamaan class
        break;

    case 'penjualan':
        include "../app/controllers/PenjualanController.php";
        $controller = new PenjualanControllers(); // Perbaiki penamaan class
        break;

    default:
        die("Controller tidak dikenali.");
}

// Periksa apakah parameter 'page' ada di URL
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'detail':
            if (isset($_GET['id'])) {
                $controller->detail($_GET['id']);
            }
            break;

        case 'delete':
            if (isset($_GET['id'])) {
                $controller->delete($_GET['id']);
            }
            break;

        case 'tambah':
            $controller->tambah();
            break;

        case 'simpan':
            if (isset($_POST['btnsimpan'])) {
                $controller->simpan();
            }
            break;

        case 'edit':
            if (isset($_GET['id'])) {
                $controller->edit($_GET['id']);
            }
            break;

        case 'update':
            if (isset($_POST['btnupdate'])) {
                $controller->update();
            }
            break;

        default:
            $controller->index();
            break;
    }
} else {
    // Jika parameter 'page' tidak ada, panggil metode 'index' dari controller
    $controller->index();
}
?>