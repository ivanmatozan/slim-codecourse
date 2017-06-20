<?php

namespace App\Controllers;

class UserController extends Controller
{
    public function index($request, $response)
    {
        $users = $this->c->db->query('SELECT * FROM user')->fetchAll(\PDO::FETCH_CLASS, '\App\Models\User');

        return $this->c->view->render($response, 'users/index.twig', compact('users'));
    }

    public function login()
    {
        return 'login';
    }
}