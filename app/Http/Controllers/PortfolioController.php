<?php

namespace App\Http\Controllers;

use App\Models\Multipicture;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function Portfolio(){
        $images = Multipicture::all();
        return view('pages.portfolio',compact('images'));
    }
}
