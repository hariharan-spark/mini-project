<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Food;
use App\Models\Reservation;
use App\Models\Foodchef;
use App\Models\Order;



class AdminController extends Controller
{
    public function __construct(User $user, Food $food,Reservation $reservation,Foodchef $foodchef,Order $order)
    {
    $this->user=$user;
    $this->food=$food;
    $this->reservation=$reservation;
    $this->foodchef=$foodchef;
    $this->order=$order;
    }
      
// User List

    public function userList()
    {
        $datas=$this->user->get();
        return view('admin.userlist',compact('datas'));   
    }
// User Delete

    public function deleteUser(Request $request)
    {
        $this->user->where('id',$request->id)->delete();
        return back();
    } 
//FoodMenu

    public function foodMenu()
    {
        $foodData=$this->food->get();
        return view('admin.foodmenu',compact('foodData')); 
    }
// Admin Food Upload

    public function foodUpload(Request $request)
    {
    
           $image = $request->image;
           if ($image)
            {
               $image = $image->getClientOriginalName().'.'.$image->getClientOriginalExtension();
               $request->image->move(public_path().'/documents/', $image);
               $create=$this->food->create([
                'image'=>$image,
                'title'=>$request->title,
                'price'=>$request->price,
                'description'=>$request->description   
             ]);
             return back();
           }
    }
//Admin Food Update

    public function updateFood(Request $request)
    { 
       
            $image = $request->image; 
            if ($image) 
            {
                $image = $image->getClientOriginalName().'.'.$image->getClientOriginalExtension();
                $request->image->move(public_path().'/documents/', $image);
                $update=$this->food->where('id',$request->id)->update([
                'image'=>$image,
                'title'=>$request->title,
                'price'=>$request->price,
                'description'=>$request->description   
                ]);
            }
            else
            {
                 $update=$this->food->where('id',$request->id)->update([
                'title'=>$request->title,
                'price'=>$request->price,
                'description'=>$request->description   
                 ]);
            }
            return back();   
    }
//Admin Food Delete

    public function deleteFoodMenu(Request $request)
    {
            $this->food->where('id',$request->id)->delete();
            return back();
    }


    public function reservation(Request $request)
    {

           $create=$this->reservation->create([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'phone'=>$request->phone,
                    'guest'=>$request->guest, 
                    'date'=>$request->date, 
                    'time'=>$request->time, 
                    'message'=>$request->message, 
                    ]);
            return back();
    }
    

    public function reservationList()
    {
                if(Auth::id())
                {
                $datas=$this->reservation->get();
                return view('admin.reservationlist',compact('datas'));   
                }
                else
                {
                    return redirect('login');
                }
    }

//Chefs

     public function chefs()
     {
             $chefsData=$this->foodchef->get();
             return view('admin.chefs',compact('chefsData'));
     }

//Admin Chefs Upload

     public function uploadChefs(Request $request)
     {
           $image = $request->image;
      
           if ($image) 
           {
                $image = $image->getClientOriginalName().'.'.$image->getClientOriginalExtension();
                $request->image->move(public_path().'/documents/', $image);
                $create=$this->foodchef->create([
                        'name'=>$request->name,
                        'speciality'=>$request->speciality,
                        'image'=>$image
                        ]);
                return back();
            }
     }

//Admin Update Chefs

    public function updateChefs(Request $request )
    {
             $image = $request->image; 
             if ($image) 
             {
                $image = $image->getClientOriginalName().'.'.$image->getClientOriginalExtension();
                $request->image->move(public_path().'/documents/', $image);
                $update=$this->foodchef->where('id',$request->id)->update([
                'image'=>$image,
                'name'=>$request->name,
                'speciality'=>$request->speciality 
                 ]);
             }
            else
             {
                 $update=$this->foodchef->where('id',$request->id)->update([
                    'name'=>$request->name,
                    'speciality'=>$request->speciality  
                     ]);
              }
            return back();   
    }

//Admin Delete Chefs

    public function deleteChefs(Request $request)
    {
        $this->foodchef->where('id',$request->id)->delete();
        return back();
    }

//Order List

    public function order()
    {  
        $order=$this->order->get();
        return view('admin.orderlist',compact('order'));   
    }
//Order Search

    public function search(Request $request)
    {
        $search=$request->search;
        $order=$this->order->where('name','like','%'.$search.'%')->orwhere('foodname','like','%'.$search.'%')->get();
        return view('admin.orderlist',compact('order'));   

    }
}
