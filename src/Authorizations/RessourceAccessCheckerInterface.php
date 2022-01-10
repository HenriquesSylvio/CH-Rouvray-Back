<?php

namespace App\Authorizations;

interface RessourceAccessCheckerInterface
{
    const MESSAGE_ERROR = "Vous n'êtes pas autorisé a faire cette action";
    public function canAccess(?int $id): void;
}