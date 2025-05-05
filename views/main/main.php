<main>
    <?php

    use Core\Database;

    const BASE_PATH = __DIR__ . '/../../';
    require_once BASE_PATH . 'Core/Router.php';
    require_once BASE_PATH . 'Core/function.php';
    require_once BASE_PATH . 'Core/Database.php';
    require_once BASE_PATH . 'vendor/autoload.php';

    $config = require BASE_PATH . "config/config.php";

    $db = new Core\Database($config);

    $router = new \Core\Router();

    require BASE_PATH . 'router.php';

    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

    $router->dispatch($uri);

    ?>
</main>