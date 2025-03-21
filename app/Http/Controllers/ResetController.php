<?php

namespace App\Http\Controllers;

class ResetController extends Controller{
    public function __construct()
    {
        $this->middleware('user.is.admin', ['only' => ['index', 'create', 'destroy', 'show', 'update']]);
        $this->middleware('is.demo', ['except' => ['index', 'create', 'show', 'indexData']]);
    }

}

