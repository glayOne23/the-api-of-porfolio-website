<?php

namespace App\Http\Controllers;
use App\Work;
use \Illuminate\Http\Request;

class WorkController extends Controller
{    

    public function index()
    {
        $works = Work::all();                
        return response()->json($works);
    }

    public function store(Request $request) {        

        $validator = $this->validate($request, [
            'description' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png,svg | max:2048',
            'name' => 'required',            
            'url' => 'required'
        ]);

        //change name and save image in public/images/
        $image = $request->file('image');
        $ldate = date('Y-m-d_H_i_s');
        $imageName = $ldate.'_'.$image->getClientOriginalName();
        $destinationPath = base_path()."/public/images/";
        $image->move($destinationPath, $imageName);

        $work = Work::create([
            'name' => request('name'),            
            'description' => request('description'),
            'image' => "images/".$imageName,
            'url' => request('url'),
        ]);
        
        return response()->json($work);
    }


    public function show($id) {
        $work = Work::find($id);
        if(!$work){
            return response()->json(['message' => 'Unable to find data with ID '. $id], 400);
        }          

        return response()->json($work);
    }


    public function update(Request $request, $id) {        
        
        $work = Work::find($id);
        if(!$work){
            return response()->json(['message' => 'Unable to find data with ID '. $id], 400);
        }          
        
        $validator = $this->validate($request, [
            'name' => 'required',            
            'url' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,jpg,png,svg | max:2048',
        ]);
        
        // upload image if updated
        if ($request->file('image') != null) {        
            //change name and save image in public/images/
            $image = $request->file('image');
            $ldate = date('Y-m-d_H_i_s');
            $imageName = $ldate.'_'.$image->getClientOriginalName();
            $destinationPath = base_path()."/public/images/";
            $image->move($destinationPath, $imageName);

            //delete old image
            $image_path = $work->image; 
            if (file_exists($image_path)) {
                @unlink($image_path);
            }

            // update image
            $work->update([
                'image' => "images/".$imageName,
            ]);
        
        }

        $work->update([
            'name' => $request->name,            
            'description' => $request->description,            
            'url' => $request->url,
        ]);
        
        return response()->json($work);        
    }

    public function destroy($id) {
        $work = Work::find($id);
        if(!$work){
            return response()->json(['message' => 'Unable to find data with ID '. $id], 400);
        }        

        // delete cover image
        $image_path = $work->image; 
        if (file_exists($image_path)) {
            @unlink($image_path);
        }
        $work->delete();          
        return response()->json(['message' => 'Data with ID '. $id. " successfully deleted"], 200);

    }

    
}
