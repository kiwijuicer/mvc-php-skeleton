<?php
declare (strict_types = 1);

namespace App\Controller;

use Core\Entity\User;
use Core\Manager\UserManager;
use Core\Mvc\Request;

/**
 * Abstract Controller
 */
abstract class AbstractController
{
    /**
     * Request
     *
     * @var \Core\Mvc\Request
     */
    protected $request;

    /**
     * User Manager
     *
     * @var \Core\Manager\UserManager
     */
    protected $userManager;

    /**
     * AbstractController Constructor
     *
     * @param \Core\Manager\UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * Sets the request
     *
     * @param \Core\Mvc\Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * Returns the request
     *
     * @return \Core\Mvc\Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Authenticate by given email and password
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    protected function authenticate(string $email, string $password): bool
    {
        $user = $this->userManager->fetchByEmail($email);

        if ($user instanceof User && password_verify($password, $user->getPassword())) {
            $_SESSION['user'] = $user;
            return true;
        }

        return false;
    }

    /**
     * Destroys the session
     *
     * @return void
     */
    public function destroySession(): void
    {
        unset($_SESSION['user']);
    }
}
