<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Food;
use App\Models\Foodchef;



class HomeController extends Controller
{
    public function __construct(User $user, Food $food,Foodchef $foodchef)
    {
    $this->user=$user;
    $this->food=$food;
    $this->foodchef=$foodchef;


    }

    public function index()
    {
        $foodData=$this->food->get();
        $chefsData=$this->foodchef->get();

        return view('home',compact('foodData','chefsData'));
    }


    public function redirects()
    {
        $foodData=$this->food->get();
        $chefsData=$this->foodchef->get();
        $usertype=Auth::user()->usertype;
    
    if($usertype=='1')
    {
        return view('admin.admin');
    }
    else
    {
        return view('home',compact('foodData','chefsData'));
    }
}
}
