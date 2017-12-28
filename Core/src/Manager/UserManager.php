<?php
declare (strict_types = 1);

namespace Core\Manager;

use Core\Entity\AbstractEntity;

/**
 * User Manager
 *
 * @package Core\Manager
 * @author Norbert Hanauer <norbert.hanauer@check24.de>
 * @copyright CHECK24 Vergleichsportal GmbH
 */
class UserManager extends AbstractManager
{
    /**
     * Table name
     *
     * @var string
     */
    const TABLE_NAME = 'user';

    /**
     * Returns entity by email
     *
     * @param string $email
     * @return \Core\Entity\AbstractEntity|null
     */
    public function fetchByEmail(string $email): ?AbstractEntity
    {
        $sql = 'SELECT
                    *
                FROM
                    user
                WHERE
                    user_email = ' . $this->tableGateway->quote($email) . '
                LIMIT 1';

        $result = $this->tableGateway->query($sql)->fetch(\PDO::FETCH_ASSOC);

        if ($result && count($result) > 0) {
            return $this->create($result);
        }

        return null;
    }
}
