<?php

namespace App\Controllers;

class TopicController extends Controller
{
    public function index($request, $response)
    {
        $topics = $this->c->db->query('SELECT * FROM topic')->fetchAll(\PDO::FETCH_CLASS, '\App\Models\Topic');

        return $this->c->view->render($response, 'topics/index.twig', compact('topics'));
    }

    public function middle($request, $response)
    {
        $response->getBody()->write('middle');

        return $response;
    }

    public function show($request, $response, $args)
    {
        $topic = $this->c->db->prepare('SELECT * FROM topic WHERE id = :id');

        $topic->execute([
            'id' => $args['id']
        ]);

        $topic = $topic->fetch(\PDO::FETCH_OBJ);

        return $this->c->view->render($response, 'topics/show.twig', compact('topic'));
    }

    public function create($request, $response)
    {
        return 'Create topic';
    }
}