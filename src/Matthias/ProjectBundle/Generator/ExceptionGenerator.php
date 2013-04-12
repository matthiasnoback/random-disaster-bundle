<?php

namespace Matthias\ProjectBundle\Generator;

class ExceptionGenerator implements GeneratorInterface
{
    public function generate()
    {
        $exceptionClass = $this->getExceptionClass();

        $exceptionMessage = $this->getExceptionMessage();

        $exception = new $exceptionClass($exceptionMessage);

        throw $exception;
    }

    private function getExceptionClass()
    {
        $exceptions = array(
            'InvalidArgumentException',
            'LogicException',
            'OutOfBoundsException'
        );

        return $exceptions[array_rand($exceptions)];
    }

    private function getExceptionMessage()
    {
        $messages = array(
            'Invalid entity persisted',
            'Unexpected form type',
            'Missing a required argument',
            'Exception thrown while handling an exception',
            'mt_rand() did not return a random value',
        );

        return $messages[array_rand($messages)];
    }
}
