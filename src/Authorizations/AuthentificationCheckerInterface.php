<?php

namespace App\Authorizations;

interface AuthentificationCheckerInterface
{
    const ERROR_MESSAGE = "Vous n'êtes pas authentifié";
    public function isAuthenticated(): void;
}