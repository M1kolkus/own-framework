<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Model\User;
use App\Session\Session;
use App\View\View;

class UserController
{
    private View $view;

    public function __construct()
    {
        $this->view = View::getInstance();
    }

    public function actionRegistration(): Response
    {
        return new Response($this->view->render('registration.html.twig'));
    }

    public function actionLogin(): Response
    {
        return new Response($this->view->render('login.html.twig'));
    }

    public function actionAdd(Request $request): Response
    {
        $user = new User();
        $user->setEmail($request->getPost()['email']);
        $user->setPassword(crypt($request->getPost()['password'], 'rl'));
        $user->setFirstName($request->getPost()['firstName']);
        $user->setLastName($request->getPost()['lastName']);
        $user->setRoles(['user']);
        $user->save();

        $response = new Response('', 302);
        $response->addHeader('Location', "/");
        Session::set('currentUserId', $user->getId());

        return $response;
    }

    public function actionAuthorization(Request $request): Response
    {
        $user = User::findOneBy(['email' => $request->getPost()['email']])[0];

        if ($user === null) {
            return new Response('Ошибка данных авторизации', 302);
        }

        if (password_verify($request->getPost()['password'], $user->getPassword())) {
            $response = new Response('', 302);
            $response->addHeader('Location', "/");
            Session::set('currentUserId', $user->getId());

            return $response;
        }

        return new Response('Ошибка данных авторизации', 302);
    }

    public function actionExit(): Response
    {
        Session::set('currentUserId', null);

        $response = new Response('', 302);
        $response->addHeader('Location', "/");

        return $response;
    }
}
