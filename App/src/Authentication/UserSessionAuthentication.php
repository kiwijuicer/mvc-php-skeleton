<?php
declare (strict_types = 1);

namespace App\Authentication;

use Core\Manager\UserManager;
use KiwiJuicer\Mvc\Authentication\AbstractSessionAuthentication;
use KiwiJuicer\Mvc\Authentication\AuthenticationRepresentationInterface;

/**
 * Abstract Session Authentication
 *
 * @package KiwiJuicer\Mvc\Authentication
 * @author Norbert Hanauer <info@norbert-hanauer.de>
 */
class UserSessionAuthentication extends AbstractSessionAuthentication
{
    /**
     * User Manager
     *
     * @var \Core\Manager\UserManager
     */
    protected $userManager;

    /**
     * User Session Authentication Constructor
     *
     * @param \Core\Manager\UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * Authenticate by given email and password
     *
     * @param string $email
     * @param string $password
     * @return AuthenticationRepresentationInterface|null
     */
    public function authenticate(string $email, string $password): ?AuthenticationRepresentationInterface
    {
        $user = $this->userManager->fetchByEmail($email);

        if ($user instanceof AuthenticationRepresentationInterface && password_verify($password, $user->getPassword())) {
            $this->setAuthorisationRepresentation($user);
            return $user;
        }

        return null;
    }
}
