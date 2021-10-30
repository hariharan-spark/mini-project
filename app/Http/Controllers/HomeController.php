<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Food;
use App\Models\Foodchef;
use App\Models\Card;




class HomeController extends Controller
{
    public function __construct(User $user, Food $food,Foodchef $foodchef,Card $card)
    {
    $this->user=$user;
    $this->food=$food;
    $this->foodchef=$foodchef;
    $this->card=$card;



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
        $user_id=Auth::id();
        $count=$this->card->where('user_id', $user_id)->count();
        return view('home',compact('foodData','chefsData','count'));
    }
}
      
    public function addCard(Request $request , $id)
    {

      
        if(Auth::id())
        {
            $user_id=Auth::id();
            $foodId=$id;
            $quantity=$request->quantity;

            $card=new card;
            $card->user_id=$user_id;
            $card->food_id=$foodId;
            $card->quantity=$quantity;
            $card->save();
            
           return back();
        }
        else
        {
            return  redirect('/login');
        }
    }

    public function showCard(Request $request , $id)
    {
        return view('showcard');
    }

}
