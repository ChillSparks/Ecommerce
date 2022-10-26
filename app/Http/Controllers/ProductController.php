<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Brands;
use App\Models\Comment;
use App\Models\ProductOrders;

use Session;
use Stripe;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    function Products()
    {
        $category=Categories::all();
        $products=Products::all();
        $brands=Brands::all();

        return view('category',['categories'=>$category,'products'=>$products,'brands'=>$brands]);
    }
    
    function singleproduct($id)
    {
        $user_id= Session::get('LoggedUser');
        if(!$user_id)
        {
            return view('login');
        }
        else{
            $products=Products::join('categories','categories.id','=','products.cat_id')
            ->where('products.id','=',$id)
            ->select(array('products.id as pid','products.price','products.name','products.cat_id','products.brand_id','products.image','products.desc','categories.cat_name'))->get();
            return view('single-product',compact('products'));
        }
    }

    function addtoCart(Request $request)
    {
        $created_at=date('Y-m-d H:i:s');
        $pro_id=DB::table('cart')->where('pro_id', $request->pro_id)->first();

        if(!$pro_id)
        {
            DB::table('cart')->insert([
            'pro_id'=>$request->pro_id,
            'user_id'=>Session::get('LoggedUser'),
            'order_id'=>0,
            'qty'  =>$request->qty,
            'price'=>$request->price,
            'created_at'=>$created_at]);

            return back()->with('success', 'Product added to cart successfully!');
        }
        else{

            DB::table('cart')->where('pro_id',$request->pro_id)
            ->update(['qty'=> DB::raw('qty +'.$request->qty),
                      'updated_at'=> $created_at]);
            return back()->with('success', 'Product added to cart successfully!');
        }
    }

    function cartDisplay()
    {
        $cart=DB::table('cart')->join('products','products.id','=','cart.pro_id')->select(array('products.id','products.image','products.name','cart.qty as cartqty','cart.price as price'))->get();
        return view('cart',compact('cart'));
    }
    
    function addComment(Request $request)
    {
        $comment=new Comment();
        $comment->name=$request->name;
        $comment->email=$request->email;
        $comment->phone=$request->number;
        $comment->msg=$request->message;
        $save=$comment->save();

        if($save)
        {
            return back()->with('comment','Your comment is added to this product');
        }
        else
        {
            return back()->with('commentfail','Something went wrong. Try again in few minutes.');
        }
    }
    function addReview(Request $request)
    {
        $m=new Review();
        $m->name=$request->name;
        $m->email=$request->email;
        $m->phone=$request->number;
        $m->msg=$request->message;
        $save=$m->save();

        if($save)
        {
            return back()->with('review','Your comment is added to this product');
        }
        else
        {
            return back()->with('reviewfail','Something went wrong. Try again in few minutes.');
        }
    }

    function updatecart(Request $request)
    {
        $updated_at=date('Y-m-d H:i:s');
        for($i=0;$i<count($request->proid);$i++)
        {
            $data=[
                'qty'  => $request->qty[$i]
   
            ];
            DB::table('cart')->where('pro_id', $request->proid[$i])
                  ->update($data);
           
        }
        return back()->with('success','Shopping Cart Updated');
    }

    //order create
    function product_order(Request $request)
    {
     
        $m=new ProductOrders();
        $m->customer_email=Session::get('LoggedUser');
        $m->order_status='Processing';
        $m->shipping_type=$request->for_radio;
        $m->delivery_note=$request->delivery_note;
        $save=$m->save();

        if($save)
        {
            return redirect('/checkout')->with('success','Items added to order.');
        }
        else
        {
            return back()->with('fail','Something went wrong. Please try again.');
        }
      

    }

    function checkoutitems()
    {
        $data=DB::table('cart')->join('products','products.id','=','cart.pro_id')->select(array('products.name','cart.qty as cartqty','cart.price as price'))->get();
        return view('checkout',compact('data'));
    }

    //stripe
    function stripe()
    {
        return view('stripe');
    }

    function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::customers->create([
                'amount'=>100*100,
                'currency'=>'usd',
                'source'=>$request->stripeToken,
                'description'=>'Stripe Test',
                'customer'=>'LEE PAL ဟေ့',

        ]);
       
        Session::flash('success',"Payment successful");
        return back();
    }
    
}
