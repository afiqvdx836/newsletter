<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Image;
class NewsletterController extends Controller
{
    public function index(){
        $newsletters = Newsletter::all();

        return view('admin.newsletter.index', compact('newsletters'));
    }

    public function create(){
    
        return view('admin.newsletter.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
            
        ]);


        $image = $request->file('image');
        $name_gen = hexdec(uniqid()). '.' .$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/newsletter/'.$name_gen);
        $save_url = 'upload/newsletter/'.$name_gen;

        Newsletter::insert([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $save_url,
        ]);

      $notification = array(
        'message' => 'Newsletter Added Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);

    }

    public function edit($id){
        $newsletter = Newsletter::findOrFail($id);
        return view('admin.newsletter.edit', compact('newsletter'));
    }

    public function update(Request $request){
        $newsletter_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()). '.' .$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/newsletter/'.$name_gen);
            $save_url = 'upload/newsletter/'.$name_gen;
    
            Newsletter::findOrFail($newsletter_id)->update([
                'title' => $request->title,
                'content' => $request->content,

                'image' => $save_url,
            ]);
    
            $notification = array(
                'message' => 'Brand Added Successfully',
                'alert-type' => 'info'
            );
    
            return redirect()->route('newsletter.index')->with($notification);
        } else {
            Newsletter::findOrFail($newsletter_id)->update([
                'title' => $request->title,
                'content' => $request->content,

             
                 
        
                ]);
        
                $notification = array(
                    'message' => 'Brand Updated Successfully',
                    'alert-type' => 'info'
                );
        
                return redirect()->route('newsletter.index')->with($notification);
        
        }
        
    }

    public function delete($id){
        $newsletter = Newsletter::findOrFail($id);
        $img = $newsletter->image;
        unlink($img);

        Newsletter::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Newsletter Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
