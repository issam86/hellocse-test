<?php

namespace Domain\Admin\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class InvalidCredentialsException extends \LogicException
{
    public function __construct(
    ) {
        parent::__construct('Les identifiants fournis sont incorrects.', Response::HTTP_FORBIDDEN);
    }
}
