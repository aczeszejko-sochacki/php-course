<?php

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';
use Product\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$app['debug'] = true;
$app['path'] = "/tmp/data";

$app->get('/products', function () use ($app) {

	$products = array();
// $app['path'];
	$id = file_get_contents(
    	__DIR__ . '/../src/Counter/counter.txt');

	for($i = 1; $i < $id; $i++){
		array_push($products, json_decode(
			file_get_contents(
				__DIR__ . '/../src/ProductsData/' . 
				$i . '.txt')));
	}

    return json_encode($products);
    
});

$app->get('/products/{id}', function($id) use($app){

	$file = $app->escape($id);
	return file_get_contents(
			__DIR__ . '/../src/ProductsData/' . $file . '.txt');

});

$app->post('/products', function(Request $request) use($app){

    $id = file_get_contents(
    	__DIR__ . '/../src/Counter/counter.txt');

    $product = new Product(
    	$id,
        $request->request->get('name'),
        $request->request->get('value'), 
        $request->request->get('currency')
    );

    file_put_contents(
    	__DIR__ . '/../src/ProductsData/' . $id . '.txt',
    	json_encode($product));
    
    $id += 1;

    file_put_contents(
    	__DIR__ . '/../src/Counter/counter.txt', $id);
    
    return 0;
});

$app->put('/products/{id}', function(Request $request, $id) use($app){
    
    $id_to_edit = $app->escape($id);

    $product = new Product(
    	$id_to_edit,
        $request->request->get('name'),
        $request->request->get('value'), 
        $request->request->get('currency')
    );

    file_put_contents(
    	__DIR__ . '/../src/ProductsData/' . $id_to_edit
        . '.txt', json_encode($product));
    
    return 0;
});

$app->delete('/products/{id}', function($id) use($app){

    $id_to_delete = $app->escape($id);

	unlink(__DIR__ . '/../src/ProductsData/' . 
    $id_to_delete . '.txt');

    return 0;
});



$app->run();