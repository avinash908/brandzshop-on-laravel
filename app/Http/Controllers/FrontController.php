<?php

namespace App\Http\Controllers;

use Auth;
use Cart;
use App\Post;
use App\Invoice;
use App\Product;
use App\Category;
use App\Services\FilterProductService;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
    	return view('pages.index');
    }
    public function products()
    {
        $major_category = Category::where('slug','=',request()->slug)->firstOrFail();

        // 2nd param paginate product
        $products = FilterProductService::filter_with_categories($major_category,12);
        return view('pages.products',compact('products','major_category'));
    }
    public function show_product($slug)
    {
    	$product = Product::where('slug',$slug)->firstOrFail();
        $related_products = Product::where('id','!=',$product->id)->limit(8)->latest()->get();
        session()->flash('after_login_url' , '/' . $product->slug);
        return view('pages.show',compact('product','related_products'));
    }
    public function blog()
    {
        return view('pages.blog',['posts'=>Post::orderBy('id', 'DESC')->paginate(10)]);
    }
    public function post($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        views($post)->cooldown(now()->addHours(1))->record();
        session()->flash('after_login_url' , '/post/' . $post->slug);
        return view('pages.post',compact('post'));
    }
    public function help()
    {
        return view('pages.help');
    }
    public function contact()
    {
        return view('pages.contact');
    }
    public function privacy_policy()
    {
        return view('pages.privacy_policy');
    }
    public function sitemap()
    {
        return view('pages.sitemap');
    }
    public function customer_dashboard()
    {
        return view('pages.account');
    }
    public function customer_orders()
    {
        return view('pages.orders');
    }
    public function customer_setting()
    {
        return view('pages.settings');
    }
    
    public function checkout()
    {
        if (!Cart::count() > 0) {
            return redirect('/cart');
        }
        foreach (Cart::content() as $row) {
            if(!$row->options->size){
                return redirect('/cart')->with('danger','Please select size of product');
            }
        }
        return view('pages.checkout');
    }

    public function customer_invoice($invoice_no)
    {
        $invoice = Invoice::where('invoice_no','=',$invoice_no)->firstOrFail();
        if($invoice->user->id == Auth::user()->id){
            return view('pages.invoice',compact('invoice'));
        }
        return abort(404);
    }
}