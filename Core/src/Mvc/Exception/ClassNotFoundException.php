<?php
declare (strict_types = 1);

namespace Core\Mvc\Exception;

/**
 * Class Not Found Exception
 *
 * @package Core\Mvc\Exception
 * @author Norbert Hanauer <norbert.hanauer@check24.de>
 * @copyright CHECK24 Vergleichsportal GmbH
 */
class ClassNotFoundException extends \Exception
{
    /**
     * Http Not Found Exception Constructor
     *
     * @param string $message
     * @param int|null $code
     */
    public function __construct(string $message = null, int $code = null)
    {
        parent::__construct($message ?? '404 - Class not found', $code ?? 404);
    }
}
