<?php
declare (strict_types = 1);

namespace App\Controller;

/**
 * Index Controller
 */
class IndexController extends AbstractController
{
    /**
     * Index action
     *
     * @return array
     */
    public function indexAction(): array
    {
        return [
            'title' => 'Index Page'
        ];
    }
}
