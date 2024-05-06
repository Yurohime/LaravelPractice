<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Str;

class ContactController extends Controller
{
    private function data()
    {
        if (!Cookie::has('contact'))
        {
            return [];
        }

        $data = Cookie::get('contact');
        $data = \json_decode($data);
        return $data;
    }

    public function View()
    {
        return \view('contact');
    }

    
   

public function ActionContact(Request $request)
{
    $data = $this->data();
    $nextId = count($data);
    $nextId += 1;

    $incoming = [
        "id" => $nextId, 
        "name" => $request->input('name'),
        "email" => $request->input('email'),
        "phone" => $request->input('phone'),
        "message" => $request->input('message'),
    ];

    $data[] = $incoming;

    $jsonData = json_encode($data);

    // Update the cookie with the modified JSON data
    $cookie = Cookie::make("contact", $jsonData, 60*24*30);
    Cookie::queue($cookie);

    // Return the view
    return view('contact');
}


    public function ContactList(Request $request)
    {
        dd($request->cookie('contact'));
    }
    

    public function ContactData(Request $request)
    {
        // Retrieve JSON data from the cookie
        $jsonData = $request->cookie('contact');

        // Decode the JSON data into an array
        $data = json_decode($jsonData, false);

        // Pass the decoded data to the view
        return view("data",[
            "contacts" => $data
        ]);
    }
    public function deleteContact(Request $request)
    {
        $contactIdToDelete = $request->input('contactIdToDelete');
    
        $jsonData = $request->cookie('contact');
        $data = json_decode($jsonData, true);
    
        $indexToDelete = null;
        foreach ($data as $index => $contact) {
            if ($contact['id'] == $contactIdToDelete) {
                $indexToDelete = $index;
                break;
            }
        }
    
        if ($indexToDelete !== null) {
            unset($data[$indexToDelete]);
            $data = array_values($data); 
        }
    
        $updatedJsonData = json_encode($data);
    
        $cookie = Cookie::make("contact", $updatedJsonData, 60*24*30);
        Cookie::queue($cookie);
        return redirect()->back();
    }
    
}
