<?php

namespace App\Http\Controllers;

use Stripe;
use Session;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index()
    {
        //show total user, product, order and deliver on admin dashboard start
        $user = User::where('usertype','=','user')->get()->count();
        $product = Product::all()->count();
        $order = Order::all()->count();
        $deliver = Order::where('status','=','Delivered')->get()->count();
        //show total user, product, order and deliver on admin dashboard end
        return view('admin.dashboard',compact('user','product','order','deliver'));
    }

    public function home()
    {
        $product = Product::all();

        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }else{
            $count = '';
        }

        return view('home.index',compact('product','count'));
    }

    public function login_home()
    {
        $product = Product::all();

        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }else{
            $count = '';
        }


        return view('home.index',compact('product','count'));   
    }

    public function product_details($id)
    {
        $details = Product::findOrFail($id);

        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }else{
            $count = '';
        }


        return view('home.product_details',compact('details','count'));
    }

    public function add_cart($id)
    {
        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;

        $cart = new Cart; 
        $cart->user_id = $user_id;
        $cart->product_id = $product_id;
        $cart->save();
        toastr()->timeOut(5000)->closeButton()->success('Product Add To Successfully');
        return redirect()->back();

    }

    public function mycart()
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
            $cart = Cart::where('user_id',$userid)->get();
        }
        return view('home.mycart',compact('count','cart'));
    }

    public function remove_cart($id)
    {
        $remove = Cart::findOrFail($id);
        $remove->delete();
        toastr()->timeOut(5000)->closeButton()->success('Product Remove From Cart Successfully');
        return redirect()->back();

    }

    public function confirm_order(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $userid = Auth::user()->id;
        $cart = Cart::where('user_id',$userid)->get();

        foreach($cart as $carts){
            $order = new Order;
            $order->name = $name;
            $order->rec_add = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $carts->product_id;
            $order->save();

        }

        //remove cart data after confirm order start:
        $cart_remove = Cart::where('user_id',$userid)->get();
        foreach( $cart_remove as $remove){
            $data = Cart::find($remove->id);
            $data->delete();
        }
         //remove cart data after confirm order end:

        toastr()->timeOut(5000)->closeButton()->success('Order Confirm');
        return redirect()->back();
    }

    public function my_order()
    {
        $user = Auth::user()->id;  
        $count = Cart::where('user_id',$user)->get()->count();
        $order = Order::where('user_id',$user)->get();
        return view('home.my_order',compact('count','order'));
    }

    //payment start
    public function stripe($value)
    {
        return view('home.stripe',compact('value'));
    }

    public function stripePost(Request $request,$value)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $value * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from Gift Shop" 
        ]);
      
        $name = Auth::user()->name;
        $phone = Auth::user()->phone;
        $address = Auth::user()->address;
        $userid = Auth::user()->id;
        $cart = Cart::where('user_id',$userid)->get();

        foreach($cart as $carts){
            $order = new Order;
            $order->name = $name;
            $order->rec_add = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $carts->product_id;
            $order->payment_status = "Paid";
            $order->save();

        }

        //remove cart data after confirm order start:
        $cart_remove = Cart::where('user_id',$userid)->get();
        foreach( $cart_remove as $remove){
            $data = Cart::find($remove->id);
            $data->delete();
        }
         //remove cart data after confirm order end:

        toastr()->timeOut(5000)->closeButton()->success('Successfully Payment');
        return redirect()->route('myorder');
    
    }
    //payment end


    public function shop()
    {
        $product = Product::all();

        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }else{
            $count = '';
        }

        return view('home.allProducts',compact('product','count'));
    }

    public function why()
    {
        

        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }else{
            $count = '';
        }

        return view('home.why',compact('count'));
    }

    public function testimonial()
    {
        

        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }else{
            $count = '';
        }

        return view('home.testimonial',compact('count'));
    }

    public function contact()
    {
        

        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }else{
            $count = '';
        }

        return view('home.contactUs',compact('count'));
    }


    public function product_search(Request $request)
    {
        $search = $request->search;
        $product = Product::where('title','LIKE','%'.$search.'%')->get();
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }else{
            $count = '';
        }

        return view('home.allProducts',compact('product','count'));
    }

    public function view_all_products()
    {
        $product = Product::all();
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }else{
            $count = '';
        }
        return view('home.allProducts',compact('product','count'));
    }


    //user message
    public function user_message(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|max:255|unique:contacts,email',
        //     'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
        //     'message' => 'required',
           
        // ], [
            // Custom error messages
        //     'name.required' => 'name is required.',
        //     'email.required' => 'email is required.',
        //     'email.unique' => 'email must be unique.',
        //     'phone.required' => 'Phone number is required.',
        //     'phone.regex' => 'Phone number format is invalid.',
        //     'phone.min' => 'Phone number must be at least 11 digits.',
        //     'phone.max' => 'Phone number must not exceed 11 digits.',
        //     'message.required'=> 'message  is required.',
        
        // ]);

        $rules=[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required||regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
            'message' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->route('contact')->withInput()->withErrors($validator);
        }

        $message = new Contact();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->phone = $request->phone;
        $message->message = $request->message;
        $message->save();
        toastr()->timeOut(5000)->closeButton()->success('Message Sent');
        return redirect()->back();
    }
    
}
