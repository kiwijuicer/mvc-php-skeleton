<?php
declare (strict_types = 1);

namespace Core\Mvc;

/**
 * Request
 *
 * @package Core\Mvc
 * @author Norbert Hanauer <norbert.hanauer@check24.de>
 * @copyright CHECK24 Vergleichsportal GmbH
 */
class Request
{
    /**
     * Post parameters
     *
     * @var array
     */
    protected $postParams;

    /**
     * Get parameters
     *
     * @var array
     */
    protected $queryParams;

    /**
     * Files
     *
     * @var array
     */
    protected $files;

    /**
     * Server variables
     *
     * @var array
     */
    protected $server;

    /**
     * Request variables
     *
     * @var array
     */
    protected $request;

    /**
     * Request Constructor
     */
    public function __construct()
    {
        $this->postParams = (array)$_POST;
        $this->queryParams = (array)$_GET;
        $this->server = (array)$_SERVER;
        $this->files = (array)$_FILES;
        $this->request = (array)$_REQUEST;
    }

    /**
     * Returns post params
     *
     * @return array
     */
    public function getPostParams(): array
    {
        return $this->postParams;
    }

    /**
     * Returns query params
     *
     * @return array
     */
    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    /**
     * Returns files
     *
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * Returns server variables
     *
     * @return array
     */
    public function getServer(): array
    {
        return $this->server;
    }

    /**
     * Returns server request
     *
     * @return array
     */
    public function getRequest(): array
    {
        return $this->request;
    }

    /**
     * Returns if is post
     *
     * @return bool
     */
    public function isPost(): bool
    {
        return count($this->getPostParams()) > 0;
    }
}
