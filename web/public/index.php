<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include '../app/vendor/autoload.php';

/*
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = 'localhost';
$config['db']['user']   = 'root';
$config['db']['pass']   = 'root';
$config['db']['dbname'] = 'persons';

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
*/




// Settings
$settings = [
    'settings' => [

    	'displayErrorDetails' => true,
        'debug'               => true,
        'whoops.editor'       => 'sublime',

        'pdo' => [
            'engine' => 'mysql',
            'host' => '172.19.0.3',
            'port' => '3306', 
            'database' => 'persons',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',

            'options' => [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => true,
                ],
        ],

    ],
];
$app = new \Slim\App($settings);
// Get container
$container = $app->getContainer();

// Inject a new instance of PDO in the container
$container['dbh'] = function($container) {

        $config = $container->get('settings')['pdo'];
        $dsn = "{$config['engine']}:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";

       

        $username = $config['username'];
        $password = $config['password'];
        //echo $dsn;
         //mysql:host=127.0.0.1;port=8989;dbname=persons;charset=utf8

        $db = new PDO($dsn , $username, $password,$config['options']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return  $db;


};

//////


$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/persons', function (Request $request, Response $response, array $args) {

  
	$dbhandler = $this->dbh;
	
    $queryUsers = $dbhandler->prepare(" SELECT * FROM person LIMIT 100 ");

    try{
        $queryUsers->execute();
        $users = $queryUsers->fetchAll();

         //$response->getBody()->write(json_encode($users));
         return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($users));


        // or you can send it to a template
        // $this->view->render($res, 'template.twig', $users);

    }catch(\PDOExeption $e)
    {
        // handle exception
    }

     //$response->getBody()->write("XXXXX");

});

$app->run();