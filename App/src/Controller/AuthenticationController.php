<?php
declare (strict_types = 1);

namespace App\Controller;

use Core\Mvc\Router;

/**
 * Authentication Controller
 */
class AuthenticationController extends AbstractController
{
    /**
     * Login action
     *
     * @return array
     */
    public function loginAction(): array
    {
        $errors = [];
        $username = null;

        $oldUri = $this->getRequest()->getQueryParams()['old-uri'] ?? null;

        if ($this->getRequest()->isPost()) {

            $params = $this->getRequest()->getPostParams();

            if (!isset($params['username'])) {
                $errors[] = 'Please enter your email address';
            }

            $username = $params['username'];

            if (!isset($params['password'])) {
                $errors[] = 'Please enter your password';
            }

            if (count($errors) === 0) {

                if (filter_var($params['username'], FILTER_VALIDATE_EMAIL) === false) {
                    $errors[] = 'Please enter a valid email address';
                }
            }

            if (count($errors) === 0) {

                if ($this->authenticate($params['username'], $params['password'])) {
                    Router::redirect($params['old_uri'] ?? '/');
                }

                $errors[] = 'Username and/or password are not correct';
            }
        }

        return [
            'title' => 'Login to MVC',
            'errors' => $errors,
            'username' => $username,
            'old-uri' => $oldUri
        ];
    }

    /**
     * Logout action
     *
     * @return void
     */
    public function logoutAction(): void
    {
        $this->destroySession();

        Router::redirect('/login');
    }
}
