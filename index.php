<?php
//Load Main
require_once("config.php");

require_once("core/startup.php");
$registry = new Registry();

$loader = new Loader($registry);
$registry->set('load', $loader);

$config = new Config();
$registry->set('config', $config);

$config->load('init');

$request = new Request();
$registry->set('request', $request);

$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$registry->set('response', $response);

$controller = new Front($registry);

// Router
if (isset($request->get['route']) && $request->get['route']!="") {
  $action = new Action($request->get['route']);
} else {
  $action = new Action('home');
}
$registry->set('parent_location',$action->route);
//Start Cache
//$PageCache= new PageCache(str_replace("/","_",$action->route));
//$PageCache->start(10);

// Dispatch
$controller->dispatch($action, new Action('error/not_found'));

// Output
$response->output();

$error = $registry->get("error")?false:true;

//Stop Cache
//$PageCache->stop($error);
?>
