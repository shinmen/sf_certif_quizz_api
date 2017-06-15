<?php 
require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

try {
	$quizzs = Yaml::parse(file_get_contents(__DIR__."/quizz.yaml"));

	$response = new JsonResponse($quizzs['quizz']);
} catch (ParseException $e) {
	$response = new JsonResponse([]);	
}

$request = Request::createFromGlobals();


$response->send();
