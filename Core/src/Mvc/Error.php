<?php
declare(strict_types = 1);

namespace Core\Mvc;

use Psr\Log\LoggerInterface;

/**
 * Error/exception handling
 *
 * @package Core
 * @author Norbert Hanauer <norbert.hanauer@check24.de>
 * @copyright CHECK24 Vergleichsportal GmbH
 */
class Error
{
    /**
     * Error handler. Convert all errors to Exceptions by throwing an ErrorException.
     *
     * @param \Psr\Log\LoggerInterface $logger
     * @return void
     */
    public static function setErrorHandler(LoggerInterface $logger): void
    {
        set_error_handler(function ($level, $message, $file, $line) use ($logger) {
            if (error_reporting() !== 0) {
                Error::handler(new \ErrorException($message, 0, $level, $file, $line), $logger);
            }
        });
    }

    /**
     * Exception handler.
     *
     * @param \Psr\Log\LoggerInterface $logger
     * @return void
     *
     */
    public static function setExceptionHandler(LoggerInterface $logger): void
    {
        set_exception_handler(function(\Throwable $exception) use ($logger) {
            Error::handler($exception, $logger);
        });
    }

    /**
     * The generic error/exception handler
     *
     * @param \Throwable $exception
     * @param \Psr\Log\LoggerInterface $logger
     * @return void
     */
    protected static function handler(\Throwable $exception, LoggerInterface $logger): void
    {

        $code = $exception->getCode();

        if ($code !== 404) {
            $code = 500;
        }

        http_response_code($code);

        $environment = Application::getConfig()['env'];

        $logger->emergency($exception);

        View::render('error/' . $code . '.phtml', [
            'exception' => $environment === 'development' ? $exception : null
        ]);

        exit();
    }
}
