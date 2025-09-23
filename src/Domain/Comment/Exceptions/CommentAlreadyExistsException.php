<?php

namespace Domain\Comment\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class CommentAlreadyExistsException extends \LogicException
{
    public function __construct()
    {
        parent::__construct(message: 'Un commentaire existe déjà pour cet administrateur sur ce profil.', code: Response::HTTP_FORBIDDEN);

    }
}
