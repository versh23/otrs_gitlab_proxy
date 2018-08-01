<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    private const PROJECT_ID = 7;

    public function index(Request $request)
    {
        $client = \Gitlab\Client::create('https://gitlab.rusnarbank.ru')
            ->authenticate(getenv('API_TOKEN'), \Gitlab\Client::AUTH_URL_TOKEN)
        ;

        $project = new \Gitlab\Model\Project(self::PROJECT_ID, $client);
        $issue = $project->createIssue('Test title.', array(
            'description' => 'test desc',
        ));
        var_dump($issue);
        die;

    }
}