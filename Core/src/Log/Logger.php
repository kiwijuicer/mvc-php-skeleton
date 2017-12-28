<?php
declare (strict_types = 1);

namespace Core\Log;

use Psr\Log\AbstractLogger;

/**
 * Psr File Logger
 *
 * @package Core\Log
 * @author Norbert Hanauer <norbert.hanauer@check24.de>
 * @copyright CHECK24 Vergleichsportal GmbH
 */
class Logger extends AbstractLogger
{
    /**
     * Php logger name
     *
     * @var string
     */
    const LOGGER_PHP = 'Log\Php';

    /**
     * Exception logger name
     *
     * @var string
     */
    const LOGGER_EXCEPTION = 'Log\Exception';

    /**
     * App logger name
     *
     * @var string
     */
    const LOGGER_APP = 'Log\App';

    /**
     * Logger name list
     *
     * @var array
     */
    const LOGGER_LIST = [
        self::LOGGER_PHP,
        self::LOGGER_EXCEPTION,
        self::LOGGER_APP
    ];

    /**
     * Writers
     *
     * @var \Core\Log\LogWriterInterface[]
     */
    protected $writers = [];

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = []): void
    {
        if ($message instanceof \Throwable) {
            $exception = $message;

            $message = $exception->getMessage();
            $context['exception'] = $exception;
            $context['trace'] = $exception->getTraceAsString();
            $context['file'] = $exception->getFile();
            $context['line'] = $exception->getLine();
            $context['code'] = $exception->getCode();
        }

        foreach ($this->writers as $writer) {
            $writer->write($level, $message, $context);
        }
    }

    /**
     * Adds given writer
     *
     * @param \Core\Log\LogWriterInterface $writer
     */
    public function addWriter(LogWriterInterface $writer): void
    {
        $this->writers[] = $writer;
    }
}
