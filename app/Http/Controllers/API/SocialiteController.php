<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use Socialite;
use App\User;

class SocialiteController extends BaseController
{
    // Les tableaux des providers autorisés
    protected $providers = ['google', 'facebook'];
}
