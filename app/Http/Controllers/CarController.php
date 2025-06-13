<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use App\Models\Location;
use App\Models\Image;


class CarController extends Controller
{
    public function index(Request $request){
       $cars = Car::all();
    $carsNew['cars'] = []; // Initialize as empty array

    foreach ($cars as $car) {
        $images=$car->images;
        $carsNew['cars'][] = ['car' => $car]; // Append each car
    }
    }


    public function store(Request $request){

        $validatedData=$request->validate([
            "longitude"=>"required|numeric",
            "latitude"=>"required|numeric",
            "available"=>"required|string",
            "brand"=>"required|string|max:255",
            "model_name"=>"required|string|max:255",
            "year"=>"required|numeric",
            "color"=>"required|string",
            "milage"=>"required|numeric",
            "images"=>"required",
            "images.*"=>"mimes:jpeg,png,jpg,gif|max:2048"
        ]);

        $user=Auth::user();
        $userId=$user->id;
        

        $location=Location::where('user_id',$userId)
                            ->where("longitude",$validatedData['longitude'])
                            ->where("latitude",$validatedData['latitude'])
                            ->first();
            $locationId=null;

            if(!$location){
                //then the location doesnt exist we need to add it 
               $newLocation= Location::create([
                    "longitude"=>$validatedData['longitude'],
                    "latitude"=>$validatedData['latitude'],
                    "user_id"=>$userId
                ]);
                $locationId=$newLocation->id;

            }
            else{
                // the location exist we need to get its id
                $locationId=$location->id;
            }

           $newCar = Car::create([
            "available"=>$validatedData['available'],
            "brand"=>$validatedData['brand'],
            "model_name"=>$validatedData['model_name'],
            "year"=>$validatedData['year'],
            "color"=>$validatedData['color'],
            "milage"=>$validatedData['milage'],
            "location_id"=>$locationId,
            "user_id"=>$userId
           ]);

           $carId=$newCar->id;




          if($request->hasFile('images')){
           foreach ($request->file('images') as $image) {
                $path = $image->store('images','public');
                Image::create([
                    "url_path"=>$path,
                    "car_id"=>$carId
                ]);
            }
               



    }

     return response()->json([
                    "message"=>"Car Created successfuly",
                    "car"=>$newCar,
                    "images"=>$newCar->images
                    
                ]);

            
    }






}
