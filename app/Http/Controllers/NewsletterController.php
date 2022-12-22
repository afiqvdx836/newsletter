<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Image;
class NewsletterController extends Controller
{
    public function index(Request $request){
        // $newsletters = Newsletter::all();

        // return view('admin.newsletter.index', compact('newsletters'));
        $newsletters = Newsletter::select("*");
  
        if ($request->has('view_deleted')) {
            $newsletters = $newsletters->onlyTrashed();
        }
  
        $newsletters = $newsletters->paginate(8);
          
        return view('admin.newsletter.index', compact('newsletters'));
    }

    public function create(){
    
        return view('admin.newsletter.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            
        ]);

        if ($request->file('image')) {
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
                'message' => 'Brand Added Successfully',
                'alert-type' => 'info'
            );
    
            return redirect()->route('newsletters.index')->with($notification);
        } else {
            Newsletter::insert([
                'title' => $request->title,
                'content' => $request->content,

             
                 
        
                ]);
        
                $notification = array(
                    'message' => 'Brand Updated Successfully',
                    'alert-type' => 'info'
                );
        
                return redirect()->route('newsletters.index')->with($notification);
    }
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
    public function trashed(Request $request)
    {
        $newsletters = Newsletter::select("*");
  
        if ($request->has('view_deleted')) {
            $newsletters = $newsletters->onlyTrashed();
        }
  
        $newsletters = $newsletters->paginate(8);
          
        return view('admin.newsletter.trashed', compact('newsletters'));
    }



    public function delete($id){
        $newsletter = Newsletter::findOrFail($id);
        $img = $newsletter->image;
        

        Newsletter::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Newsletter Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function restore($id)
    {
        Newsletter::withTrashed()->find($id)->restore();
  
        return back();
    }  

    public function restoreAll()
    {
        Newsletter::onlyTrashed()->restore();
  
        return back();
    }

    public function deletePermanently($id)
    {
        $newsletter = Newsletter::where('id', $id)->withTrashed()->first();

        $newsletter->forceDelete();

        return redirect()->route('newsletters.index')
            ->with('success', 'You successfully deleted the project fromt the Recycle Bin');
    }
}
