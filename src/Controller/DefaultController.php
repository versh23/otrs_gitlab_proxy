<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    private const PROJECT_ID = 7;

    public function index(Request $request)
    {

        $title = $request->query->get('title');
        $description = $request->query->get('description');

        if($title && $description) {
            $client = \Gitlab\Client::create('https://gitlab.rusnarbank.ru')
                ->authenticate(getenv('API_TOKEN'), \Gitlab\Client::AUTH_URL_TOKEN)
            ;

            $project = new \Gitlab\Model\Project(self::PROJECT_ID, $client);
            $issue = $project->createIssue($title, array(
                'description' => $description,
            ));
            var_dump($issue);
            die;
        }


        return new Response('ok');

    }
}