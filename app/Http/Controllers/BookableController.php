<?php

namespace App\Http\Controllers;

use App\Models\Bookable;
use Illuminate\Http\Request;

class BookableController extends Controller
{
    public function index(){
        return Bookable::limit(10)->get();
    }
}
