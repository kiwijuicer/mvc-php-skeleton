<?php
declare (strict_types = 1);

namespace Core\Entity;

/**
 * Abstract Entity
 *
 * @package Core\Entity
 * @author Norbert Hanauer <norbert.hanauer@check24.de>
 * @copyright CHECK24 Vergleichsportal GmbH
 */
abstract class AbstractEntity
{
    /**
     * Entity prefix
     *
     * @var string
     */
    public $prefix;

    /**
     * Entity primary key
     *
     * @var int
     */
    public $primaryKey;

    /**
     * All entity fields
     *
     * @var array
     */
    public $fields;

    /**
     * Abstract Entity Constructor
     */
    public function __construct()
    {
        $this->fields[$this->prefix . 'updated'] = null;
        $this->fields[$this->prefix . 'created'] = date('Y-m-d H:i:s');
    }

    /**
     * Sets id
     *
     * @param int $value
     */
    public function setId(int $value): void
    {
        $this->prefixSet('id', $value);
    }

    /**
     * Returns id
     *
     * @return int
     */
    public function getId(): int
    {
        return (int)$this->prefixGet('id');
    }

    /**
     * Returns if entity is persisted
     *
     * @return bool
     */
    public function isPersisted(): bool
    {
        return $this->prefixGet('id') > 0;
    }

    /**
     * Returns entity variable by name
     *
     * @param string $name
     * @return mixed
     */
    public function prefixGet(string $name)
    {
        return $this->fields[$this->prefix . $name];
    }

    /**
     * Returns entity variable by name
     *
     * @param string $name
     * @param $value
     * @return void
     */
    public function prefixSet(string $name, $value): void
    {
        $this->fields[$this->prefix . $name] = $value;
    }
}
