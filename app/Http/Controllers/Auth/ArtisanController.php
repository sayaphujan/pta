<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class ArtisanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
     \Artisan::call('migrate',
         array(
           '--path' => 'database/migrations',
           '--database' => 'dynamicdb',
           '--force' => true));   
    }

    public function migrations()
    {
        \Artisan::call('migrate',
         array(
           '--path' => 'database/migrations',
           '--database' => 'dynamicdb',
           '--force' => true));
    }
}
