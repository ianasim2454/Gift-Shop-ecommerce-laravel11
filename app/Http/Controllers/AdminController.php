<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function category(){
        $data = Category::all();
        return view('admin.category',compact('data'));
    }

    public function add_category(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->category;
        $category->save();
        toastr()->timeOut(5000)->closeButton()->success('Category Added Successfully');
        return redirect()->back();
    }

    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
        toastr()->timeOut(5000)->closeButton()->info('Category Delete Successfully');
        return redirect()->back();
    }

    public function edit_category($id)
    {
        $data = Category::find($id);
        return view('admin.edit_category',compact('data'));
    }

    public function update_category(Request $request, $id)
    {
        $data = Category::find($id);
        $data->category_name = $request->category;
        $data->save();
        toastr()->timeOut(5000)->closeButton()->success('Category Updated Successfully');
        return redirect()->route('category');
    }

    //Add Product
    public function add_product(){
        $category = Category::all();
        return view('admin.add_product',compact('category'));
    }

    public function upload_product(Request $request)
    {
    
        $data = new Product;
        $data->title = $request->title;
        $data->code = $request->code;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;
        $image = $request->image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products',$imagename);
            $data->image = $imagename;
        }
        $data->save();
        toastr()->timeOut(5000)->closeButton()->success('Product Uploaded Successfully');
        return redirect()->back();

    }

    //View Product List
    public function view_product(){
        $product = Product::paginate(5);
        return view('admin.view_product',compact('product'));
    }

    public function delete_product($id)
    {
        $product = Product::findOrFail($id);
        //Delete image from public folder start:
        $image_path = public_path('products/'.$product->image);
        if(file_exists( $image_path)){
            unlink($image_path);
        }
        //Delete image from public folder end:
        
        $product->delete();
        toastr()->timeOut(5000)->closeButton()->warning('Product Deleted Successfully');
        return redirect()->back();
    }

    //Edit Products
    public function edit_product($slug)
    {
        $data = Product::where('slug',$slug)->get()->first();
        $category = Category::all();
        return view('admin.edit_product',compact('data','category'));
    }
    //Update Product
    public function update_product(Request $request, $id)
    {
        $update = Product::findOrFail($id);
        $update->title = $request->title; 
        $update->code = $request->code; 
        $update->description = $request->description; 
        $update->price = $request->price; 
        $update->quantity = $request->quantity; 
        $update->category = $request->category;
        $image = $request->image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products',$imagename);
            $update->image = $imagename;
        }
        $update->save();
        toastr()->timeOut(5000)->closeButton()->info('Product Uploaded Successfully');
        return redirect()->route('view.product');

    }

    public function search_product(Request $request)
    {
        $search = $request->search;
        $product = Product::where('title','LIKE','%'.$search.'%')->orWhere('category','LIKE','%'.$search.'%')->paginate(3);
        return view('admin.view_product',compact('product'));
    }

    public function view_order()
    {
        $order = Order::paginate(5);
        return view('admin.order',compact('order'));
    }

    //change order start:
    public function on_the_way($id)
    {
        $change = Order::find($id);
        $change->status = 'On The Way';
        $change->save();
        toastr()->timeOut(5000)->closeButton()->info('On The Way');
        return redirect()->back();
    }

    public function delivered($id)
    {
        $change = Order::find($id);
        $change->status = 'Delivered';
        $change->save();
        toastr()->timeOut(5000)->closeButton()->success('Product Delivered Successfully');
        return redirect()->back();
    }
    //change order end:


    //Print PDF file generate start: 
    public function print_pdf($id)
    {
        $data = Order::find($id);
        $pdf = Pdf::loadView('admin.invoice',compact('data'));
        return $pdf->download('invoice.pdf');
    }
    //Print PDF file generate end: 

    //Client message start
    public function client_message ()
    {
        $message = Contact::all();
        return view('admin.client_message',compact('message'));
    }
    //Client message end

    //message delete
    public function delete_message ($id)
    {
        $message = Contact::findOrFail($id);
        $message->delete();
        toastr()->timeOut(5000)->closeButton()->info('Message Deleted');
        return redirect()->back();
    }

}
