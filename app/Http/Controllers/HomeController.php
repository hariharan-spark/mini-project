<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Food;
use App\Models\Foodchef;
use App\Models\Card;
use App\Models\Order;
use App\Console\Commands\generateUserData;






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
        \Artisan::call('create:generate-users',['count' => 1]);
        if(Auth::id())
        {
            return redirect('redirects');
        }
        else
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
        
        $count=$this->card->where('user_id',$id)->count();

        if(Auth::id()==$id)
        {
            $datas=$this->card->where('user_id',$id)->join('foods','cards.food_id','=','foods.id')->get();
            $datas2=$this->card->select('*')->where('user_id','=', $id)->get();
            return view('showcard',compact('count','datas','datas2'));
        }
       else
       {
           return back();
       }
    }

    public function remove($id)
    {
        $this->card->find($id)->delete();
        return back();

    }


    public function orderConfirm(Request $request)
    {

        foreach($request->foodname as $key=>$foodname)
        {
           $data=new order;
           $data->foodname=$foodname;
           $data->price=$request->price[$key];
           $data->quantity=$request->quantity[$key];
           $data->name=$request->name;
           $data->phone=$request->phone;
           $data->address=$request->address;
           $data->save();
           
        }

        return back();
    }

}
