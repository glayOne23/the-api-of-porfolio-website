<?php

namespace App\Http\Controllers;
use \Illuminate\Http\Request;

use App\Connect;

class ConnectController extends Controller
{    

    public function index()
    {
        $connects = Connect::all();                
        return response()->json($connects);
    }

    public function store(Request $request) {        

        $validator = $this->validate($request, [
            'icon' => 'required',
            'url' => 'required'
        ]);     

        $connect = Connect::create([
            'icon' => request('icon'),
            'url' => request('url'),
        ]);

        return response()->json($connect);
    }

    public function show($id) {
        $connect = Connect::find($id);
        if(!$connect){
            return response()->json(['message' => 'Unable to find data with ID '. $id], 400);
        }          

        return response()->json($connect);
    }

    public function update(Request $request, $id) {        

        $validator = $this->validate($request, [            
            'icon' => 'required',
            'url' => 'required'
        ]);     

        $connect = Connect::find($id);
        if(!$connect){
            return response()->json(['message' => 'Unable to find data with ID '. $id], 400);
        }        

        $connect->update([
            'icon' => request('icon'),
            'url' => request('url'),
        ]);

        return response()->json($connect);        
    }

    public function destroy($id) {
        $connect = Connect::find($id);
        if(!$connect){
            return response()->json(['message' => 'Unable to find data with ID '. $id], 400);
        }        
        $connect->delete();          
        return response()->json(['message' => 'Data with ID '. $id. " successfully deleted"], 200);

    }

    
}
