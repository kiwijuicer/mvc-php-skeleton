<?php
declare (strict_types = 1);

namespace Core\Entity;

use KiwiJuicer\Mvc\Authentication\AuthenticationRepresentationInterface;
use KiwiJuicer\Mvc\Entity\AbstractEntity;

/**
 * User
 *
 * @package Core\Entity
 * @author Norbert Hanauer <info@norbert-hanauer.de>
 */
class User extends AbstractEntity implements AuthenticationRepresentationInterface
{
    /**
     * Male
     *
     * @var string
     */
    const GENDER_MALE = 'male';

    /**
     * Female
     *
     * @var string
     */
    const GENDER_FEMALE = 'female';

    /**
     * Other
     *
     * @var string
     */
    const GENDER_OTHER = 'other';

    /**
     * Gender list
     *
     * @var array
     */
    const GENDER_MAP = [
        self::GENDER_MALE => 'Mr.',
        self::GENDER_FEMALE => 'Mrs.',
        self::GENDER_OTHER => 'Other'
    ];

    /**
     * User Constructor
     */
    public function __construct()
    {
        $this->prefix = 'user_';

        $this->primaryKey = 'user_id';

        $this->fields = [
            'user_id' => null,
            'user_email' => null,
            'user_password' => null,
            'user_first_name' => null,
            'user_last_name' => null,
            'user_gender' => null
        ];

        parent::__construct();
    }

    /**
     * Sets email
     *
     * @param string $value
     */
    public function setEmail(string $value): void
    {
        $this->prefixSet('email', $value);
    }

    /**
     * Returns email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->prefixGet('email');
    }

    /**
     * Sets password
     *
     * @param string $value
     */
    public function setPassword(string $value): void
    {
        $this->prefixSet('password', password_hash($value, PASSWORD_BCRYPT));
    }

    /**
     * Returns password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->prefixGet('password');
    }

    /**
     * Sets first name
     *
     * @param string $value
     */
    public function setFirstName(string $value): void
    {
        $this->prefixSet('first_name', $value);
    }

    /**
     * Returns first name
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->prefixGet('first_name');
    }

    /**
     * Sets last name
     *
     * @param string $value
     */
    public function setLastName(string $value): void
    {
        $this->prefixSet('last_name', $value);
    }

    /**
     * Returns email
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->prefixGet('last_name');
    }

    /**
     * Sets gender
     *
     * @param string $value
     * @throws \InvalidArgumentException
     */
    public function setGender(string $value): void
    {
        if (!array_key_exists($value, self::GENDER_MAP)) {
            throw new \InvalidArgumentException('Given gender is not valid: ' . $value);
        }

        $this->prefixSet('gender', $value);
    }

    /**
     * Returns gender
     *
     * @return string
     */
    public function getGender(): string
    {
        return $this->prefixGet('gender');
    }
}
