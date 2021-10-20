<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use App\Models\Reservation;
use App\Models\Foodchef;





class AdminController extends Controller
{
    public function __construct(User $user, Food $food,Reservation $reservation,Foodchef $foodchef)
    {
    $this->user=$user;
    $this->food=$food;
    $this->reservation=$reservation;
    $this->foodchef=$foodchef;

    }

    public function userList()
    {
        $datas=$this->user->get();
        return view('admin.userlist',compact('datas'));   
    }

    public function deleteUser(Request $request)
    {
        $this->user->where('id',$request->id)->delete();
        return back();
    } 

    public function foodMenu()
    {
        $foodData=$this->food->get();
        return view('admin.foodmenu',compact('foodData')); 
    }
    public function foodUpload(Request $request)
    {
    
          $image = $request->image;
      
           if ($image) {
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

    public function updateFood(Request $request)
    { 
       
        $image = $request->image; 
        if ($image) {
            $image = $image->getClientOriginalName().'.'.$image->getClientOriginalExtension();
            $request->image->move(public_path().'/documents/', $image);
            $update=$this->food->where('id',$request->id)->update([
             'image'=>$image,
             'title'=>$request->title,
             'price'=>$request->price,
             'description'=>$request->description   
          ]);
        }else{
                 $update=$this->food->where('id',$request->id)->update([
                'title'=>$request->title,
                'price'=>$request->price,
                'description'=>$request->description   
             ]);
          }
          return back();   
    }

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
           $datas=$this->reservation->get();
           return view('admin.reservationlist',compact('datas'));   
       }


       public function chefs()
       {
        $chefsData=$this->foodchef->get();
           return view('admin.chefs',compact('chefsData'));
       }


       public function uploadChefs(Request $request)
       {
        $image = $request->image;
      
        if ($image) {
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


       public function updateChefs(Request $request )
    {
        $image = $request->image; 
        if ($image) {
            $image = $image->getClientOriginalName().'.'.$image->getClientOriginalExtension();
            $request->image->move(public_path().'/documents/', $image);
            $update=$this->foodchef->where('id',$request->id)->update([
             'image'=>$image,
             'name'=>$request->name,
             'speciality'=>$request->speciality 
          ]);
        }else{
                 $update=$this->foodchef->where('id',$request->id)->update([
                    'name'=>$request->name,
                    'speciality'=>$request->speciality  
             ]);
          }
          return back();   
    }


    public function deleteChefs(Request $request)
    {
        $this->foodchef->where('id',$request->id)->delete();
        return back();

    }
}
