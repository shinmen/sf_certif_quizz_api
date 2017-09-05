<?php 
require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

try {
    $finder = new Finder();
    $finder->files()->in('quizz')->name('*.yaml');
    $quizzs = [];
    foreach($finder as $file) {
        $quizz = Yaml::parse($file->getContents());
        $quizzs = array_merge($quizzs, $quizz['quizz']);
    }

	$response = new JsonResponse($quizzs);
    $response->setPublic();
    $response->setMaxAge(360);
} catch (ParseException $e) {
	$response = new JsonResponse([]);
}

$response->send();

