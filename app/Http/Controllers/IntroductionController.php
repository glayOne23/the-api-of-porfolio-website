<?php

namespace App\Http\Controllers;
use \Illuminate\Http\Request;

use App\Introduction;

class IntroductionController extends Controller
{    

    public function index()
    {
        $introduction = Introduction::first();        
        $introduction->greatings = json_decode($introduction['greatings']);
        return response()->json($introduction);
    }

    public function store(Request $request) {        

        $validator = $this->validate($request, [
            'name' => 'required|unique:introductions',            
            'description' => 'required',
            'connect' => 'required'
        ]);     

        $introduction = Introduction::create([
            'name' => request('name'),
            'greatings' => json_encode(request('greatings')),
            'description' => request('description'),
            'connect' => request('connect'),
        ]);

        $introduction->greatings = json_decode($introduction['greatings']);
        return response()->json($introduction);
    }

    public function update(Request $request, $id) {        

        $validator = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'connect' => 'required'
        ]);     

        $introduction = Introduction::find($id);
        if(!$introduction){
            return response()->json(['message' => 'Unable to find data with ID '. $id], 400);
        }        

        $introduction->update([
            'name' => request('name'),
            'greatings' => json_encode(request('greatings')),
            'description' => request('description'),
            'connect' => request('connect'),
        ]);

        $introduction->greatings = json_decode($introduction['greatings']);
        return response()->json($introduction);        
    }

    public function destroy($id) {
        $introduction = Introduction::find($id);
        if(!$introduction){
            return response()->json(['message' => 'Unable to find data with ID '. $id], 400);
        }        
        $introduction->delete();          
        return response()->json(['message' => 'Data with ID '. $id. " successfully deleted"], 200);

    }

    
}
