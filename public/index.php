<?php
use app\core\Router;
use Dotenv\Dotenv;

require_once('../vendor/autoload.php');
require_once('config.php');
// Carregue as variáveis de ambiente do arquivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();


Router::exec();