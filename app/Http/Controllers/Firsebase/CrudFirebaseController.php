<?php

namespace App\Http\Controllers\Firsebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use App\Models\User;
use Auth;

class CrudFirebaseController extends Controller
{

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'users';
    }

    public function index(){
        $data = $this->database->getReference($this->tablename)->getValue();
        
        return view('form',compact('data'));
    }
    public function store(Request $request){
        
        $postData = [
            'name'=>$request->name,
            'role'=>$request->role,
        ];
        $postRef = $this->database->getReference($this->tablename)->push($postData);
        if($postRef){
            return redirect('index')->with('success',"Data Submitted Into FireBase");
        }
        else{
            return back()->with('succes',"something went wrong");
        }



    }

    public function delete($id){

        $key = $id;
        $this->database->getReference($this->tablename.'/'.$key)->remove();
        
        
        return redirect('index')->with('success',"Data Deleted From FireBase");
    }
    public function edit($id){
        
        $key = $id;
        $data = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        
        return view('editform',compact('data','key'));
    }

    public function update(Request $request,$id){
        
        
        $key = $id;
        $updateData = [
            'name'=>$request->name,
            'role'=>$request->role,
        ];
        $this->database->getReference($this->tablename.'/'.$key)->update($updateData);
        return redirect('index')->with('success',"Data Updated Into FireBase");
    }

    public function home(){
        
        return view('home');
       
    
    }

    public function updateDeviceToken(Request $request)
    {
        Auth::user()->device_token =  $request->token;

        Auth::user()->save();

        return response()->json(['Token successfully stored.']);
    }

    public function sendNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();
            
        $serverKey = 'AAAAl6nGs9E:APA91bHOLCVhlNkwLA350SipimqQp97ESZT560NlvS8NCNWNijFjSNZjIay7S7KdVar0FJ7HRtp9eBc-99rvMspJx1oC4xW7Ugy9fq0imKUB9DQnXRJg38Q8Jn7zdD--1VxDuDbifXC1'; // ADD SERVER KEY HERE PROVIDED BY FCM
    
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,  
            ]
        ];
        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);
        // FCM response
        dd($result);
    }


}
