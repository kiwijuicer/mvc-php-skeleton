<?php
declare (strict_types = 1);

namespace App\Controller;

use Core\Entity\User;
use Core\Manager\UserManager;
use KiwiJuicer\Mvc\Controller\AbstractController;
use KiwiJuicer\Mvc\Routing\Router;

/**
 * User Controller
 */
class UserController extends AbstractController
{
    /**
     * User Manager
     *
     * @var \Core\Manager\UserManager
     */
    private $userManager;

    /**
     * Authentication Controller Constructor
     *
     * @param \Core\Manager\UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * Index action
     *
     * @return array
     */
    public function indexAction(): array
    {
        return [
            'title' => 'User Management',
            'users' => $this->userManager->fetchAll()
        ];
    }

    /**
     * The new/edit action
     *
     * @return array
     */
    public function editAction(): array
    {
        $errors = [];
        $queryParams = $this->getRequest()->getQueryParams();

        $id = $queryParams['id'] ?? null;
        $user = null;

        if ($id !== null) {
            $user = $this->userManager->get((int)$id);
        }

        $mode = $user instanceof User ? 'edit' : 'new';

        if ($this->getRequest()->isPost()) {

            $postData = $this->getRequest()->getPostParams();

            if ($mode === 'new') {
                $user = $this->userManager->create();
            }

            if ($mode === 'new' || !empty($postData['password'])) {

                if (mb_strlen($postData['user_password']) < 5) {
                    $errors['user_password'] = 'Password has to be at least 5 characters long';
                }

                $user->setPassword($postData['user_password']);
            }

            if (filter_var($postData['user_email'], FILTER_VALIDATE_EMAIL) === false) {
                $errors['user_email'] = 'Please enter a valid email address';
            }

            $user->setEmail($postData['user_email']);

            if ($postData['user_first_name'] === '') {
                $errors['user_first_name'] = 'Please enter your first name';
            }

            $user->setFirstName($postData['user_first_name']);

            if ($postData['user_last_name'] === '') {
                $errors['user_last_name'] = 'Please enter your last name';
            }

            $user->setLastName($postData['user_last_name']);

            if ($postData['user_gender'] === '') {
                $errors['user_gender'] = 'Please select a gender';
            }

            $user->setGender($postData['user_gender']);

            if (count($errors) === 0) {
                $this->userManager->save($user);
                Router::redirect('/users');
            }
        }

        return [
            'title' => $user instanceof User ? 'Edit User' : 'New User',
            'user' => $user,
            'errors' => $errors
        ];
    }
}
