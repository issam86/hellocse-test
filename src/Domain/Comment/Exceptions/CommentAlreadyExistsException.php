<?php

namespace Domain\Comment\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class CommentAlreadyExistsException extends \LogicException
{
    public function __construct()
    {
        parent::__construct(message: 'un commentaire existe deja.', code: Response::HTTP_FORBIDDEN);

    }

}
