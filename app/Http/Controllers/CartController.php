<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Membership;
use App\Models\Orders;
use App\Models\ProductMessage;
use App\Models\Products;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use URL;
use Session;

class CartController extends Controller
{
    public function index()
    {
        $data = getCart();
        return view('frontend.cart', compact('data'));
    }

    public function addToCart(Request $request)
    {
        $in_array = false; 
        $k = 0; 
        $qty = (int)$request->qty;
        $discount = 0;
        $original_price = 0;
        $offer_id = NULL;

        $pro = Products::find($request->product_id);

        
        $title = $pro['title'];

        if($request->discount*1 === 1){
            $discount = 1;
            $original_price = $pro['sell_price'];
            $price = $request->discount_price;
            $total = $price * $qty;
            $offer_id = $request->offer_id;
        }else{
            $price = $pro['sell_price'];
            $total = $price * $qty;
        }

        $arr = [
            [
                'product'=>$request->product_id,
                'qty'=>$qty,
                'price'=>$price,
                'total'=>$total,
                'title'=>$title,
                'currency_symbol'=>'$',
                'discount'=>$discount,
                'original_price'=>$original_price,
                'offer_id'=>$offer_id,
            ]
        ]; 

        $products = serialize($arr);

        $count = 1;

        if(!empty(Cookie::get('products'))) {
            $products = Cookie::get('products');
            $p_array = unserialize($products);
            if($request->product_id!=0){
                $arr_column = array_column($p_array, 'product');
                $in_array = in_array($request->product_id, $arr_column);
                $k = array_search($request->product_id, $arr_column);
                if($discount === 1){
                    if(!$in_array) {
                        $total = $price * $qty;
                        array_push($p_array, ['product'=>$request->product_id,'qty'=>$qty,'price'=>$price,'total'=>$total,'title'=>$title, 'discount'=>$discount,'original_price'=>$original_price,'offer_id'=>$offer_id]);
                    }else{
                        if($p_array[$k]['discount'] === 0){
                            unset($p_array[$k]);
                            $total = $price * $qty;
                            array_push($p_array, ['product'=>$request->product_id,'qty'=>$qty,'price'=>$price,'total'=>$total,'title'=>$title, 'discount'=>$discount,'original_price'=>$original_price,'offer_id'=>$offer_id]);
                        }
                    }
                }else{
                    if($in_array) {
                        if($p_array[$k]['discount'] === 0){
                            if(($p_array[$k]['qty']+$qty) > $pro->quantity){
                               return response()->json([
                                    'status'  => 'quantity_error',
                                    'quantity_error' => 'No more quantity available'
                                ], 200);
                            }
                            $p_array[$k]['qty'] = $p_array[$k]['qty']+$qty;
                            $total = $p_array[$k]['price']*$p_array[$k]['qty'];
                            $p_array[$k]['total'] = $total;
                        }
                    } else {
                        // $gst = getpreferences()['gst'];
                        $total = $price * $qty;
                        array_push($p_array, ['product'=>$request->product_id,'qty'=>$qty,'price'=>$price,'total'=>$total,'title'=>$title, 'discount'=>$discount,'original_price'=>$original_price,'offer_id'=>$offer_id]);
                    }
                }
            }
            $products = serialize($p_array);
            $count = count($p_array);
        }

        $resp['status'] = 'added';
        $resp['count'] = $count;
        return response($resp)->cookie(
            'products', $products, 2628000
        );
    }

    public function deleteCartItem(Request $request) 
    {
        if(!empty(Cookie::get('products'))) {
            $p_array = unserialize(Cookie::get('products'));
            foreach($p_array as $key => $value) {
                if($value['product']==$request->product_id) {
                    unset($p_array[$key]);
                    $products = serialize($p_array);
                    $resp['status'] = 'deleted';
                    $resp['count'] = count($p_array);
                    return response($resp)->cookie(
                        'products', $products, 2628000
                    );
                }
            }
        }
    }

    public function checkout_page()
    {
        $data = getCart();
        $temp = [];
        foreach($data as $key => $value) {
            $temp[] = [
                'product'=>$value['product'],
                'qty'=>$value['qty'],
                'price'=>$value['price'],
                'total'=>($value['price']*$value['qty']),
                'title'=>$value['title'],
                'discount'=>$value['discount'],
                'original_price'=>$value['original_price'],
                'offer_id'=>$value['offer_id'],
            ];
        }
        $data = $temp;
        $products = serialize($temp);
        Cookie::queue('products', $products, 2628000);
        return view('frontend.checkout',['data'=>$data]);
    }

    public function proceed_checkout(Request $request)
    {
        $user = User::where('email',$request->user['email'])->first();
        if($user!==null) {
            $request['user_id'] = $user['id'];
            $updateData = [];
            if(!isset($user->address)){
                $updateData['address'] = $request['shipping']['address'];
            }
            if(!isset($user->country)){
                $updateData['country'] = $request['shipping']['country'];
            }
            if(!isset($user->city)){
                $updateData['city'] = $request['shipping']['city'];
            }
            $user->update($updateData);
        } else {
            $key = Crypt::encryptString($request->user['email']);
            $userdata = $request->user;  $userdata['user_type'] = "customer";
            $userdata['country'] = "Pakistan"; $userdata['city'] = $request->shipping['city'];
            $userdata['address'] = $request->shipping['address']; $userdata['postal'] = $request->shipping['postal']; $userdata['state'] = ($request->shipping['state'])??''; $userdata['additional_address'] = $request->shipping['additional_address']??''; $userdata['company'] = $request->shipping['company']??'';
            $userdata['is_active'] = 0; $userdata['is_verified'] = 0; $userdata['password'] = bcrypt(str_random(10));
            $newuser = User::create($userdata);
            $maildata = ['key'=>$key];
            $to = $request->user['email']; $name = $request->user['first_name'].' '.$request->user['last_name'];
            $request['user_id'] = $newuser['id'];
        }

        $request['order_no'] = ($request->has('order_no'))?$request['order_no']:rand(1000, 999999);
        $request['payment_type'] = $request->payment;
        $request['shipping_meta'] = json_encode($request->shipping);
        $request['billing_meta'] = json_encode($request->billing);
        $request['payment'] = $request->payment;
        $request['order_status'] = 'pending';
        $products = $request->items;
        if($request->payment=='stripe') {      
            require_once(public_path('stripe-php/init.php'));        
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $neworder = Orders::create($request->all());
            $p_items =[]; $items = [];
            if(!empty($products)) {
                $p_items = [];
                
                foreach($products['product_id'] as $key => $value) {
                    $p_items[] = [
                        'price_data' => [
                            'currency' => 'USD',
                            'unit_amount' => $products['price'][$key]*100,
                            'product_data' => [
                                'name' => (isset($products['title'][$key]))?$products['title'][$key]:'',
                            ]
                        ],
                        'quantity' => $products['qty'][$key]
                    ];
                    OrderDetail::create([
                        'order_id'=>$neworder['id'],
                        'title'=>(isset($products['title'][$key]))?$products['title'][$key]:'',
                        'type'=>(isset($products['type'][$key]))?$products['type'][$key]:'',
                        'price'=>(isset($products['price'][$key]))?$products['price'][$key]:'',
                        'amount'=>(int)$products['price'][$key] * (int)$products['qty'][$key],
                        'qty'=>(isset($products['qty'][$key]))?$products['qty'][$key]:'',
                        'discount'=>(isset($products['discount'][$key]))?$products['discount'][$key]:NULL,
                        'original_price'=>(isset($products['original_price'][$key]))?$products['original_price'][$key]:NULL,
                        'offer_id'=>(isset($products['offer_id'][$key]))?$products['offer_id'][$key]:NULL,
                        'product_id'=>(isset($products['product_id'][$key]))?$products['product_id'][$key]:NULL,
                        'currency_symbol'=>(isset($products['currency_symbol'][$key]))?$products['currency_symbol'][$key]:NULL,
                    ]);
                    // $items[] = ['title'=>(isset($products['title'][$key]))?$products['title'][$key]:'','qty'=>$products['qty'][$key],'price'=>getProduct($value)['price'],'total'=>$products['price'][$key]];
                } 
            }        

            $customer_id = (!empty($neworder->user->stripe))?$neworder->user->stripe:null;
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $p_items,
                'customer'=>$customer_id,
                'success_url' => URL::route('stripeSuccess'),
                'cancel_url' => URL::route('stripeFail'),
                'mode' => 'payment',
            ]);
            Session::put('stripe_payment_id', $session['id']);
            $neworder->update(['session'=>$session['id']]);
            $session_id = $session['id'];
            Cookie::queue(Cookie::forget('products'));
            return view('frontend.stripe',compact('session_id'));
        }
    }

    public function stripe_success()
    {
        require_once(public_path('stripe-php/init.php'));        
        $payment_id = Session::get('stripe_payment_id');
        if(!isset($payment_id)){
            return redirect()->route('home');
        }
        $order = Orders::with('orderdetail')->where('session',$payment_id)->first();

        if($order->order_type === 'membership'){
            $userdata = [];
            $user = User::find($order->user_id);
            $membership = null;
            if (isset($order->membership_details['code'])) {
                $membership = Membership::where('code', $order->membership_details['code'])
                    ->where('is_active', 1)
                    ->first();
            }

            $membershipCode = $membership->code ?? ($order->membership_details['code'] ?? 4);
            $durationValue = $membership ? max((int) $membership->duration_value, 1) : 1;
            $durationType = $membership->duration_type ?? 'month';

            $expiry = Carbon::now();
            if ($durationType === 'day') {
                $expiry->addDays($durationValue);
            } elseif ($durationType === 'year') {
                $expiry->addYears($durationValue);
            } else {
                $expiry->addMonths($durationValue);
            }

            $userdata['membership_id'] = $membershipCode;
            $userdata['start_date'] = Carbon::now()->format('Y-m-d');
            $userdata['expiry_date'] = $expiry->format('Y-m-d');
            $userdata['membership_title'] = $membership->title ?? ($order->membership_details['title'] ?? 'Free (Seller)');

            $user->update($userdata);
        }else{
            foreach ($order->orderdetail as $key => $value) {
                if($value->type == 'product'){
                    $product = Products::find($value->product_id);
                    $qty = $product->quantity - $value['qty'];
                    $product->quantity = $qty;
                    $product->save();
                }

                if(isset($value->offer_id)){
                    $offer = ProductMessage::find($value->offer_id)->update(['status' => 3]);
                }
            }
        }
        
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = \Stripe\Checkout\Session::retrieve($payment_id);
        Session::forget('stripe_payment_id');
        $order->update(['order_status'=>'paid']);
        Cookie::queue(Cookie::forget('products'));
        return view('frontend.order_created',['order_no'=>$order['order_no']]);
    }

    public function stripe_fail()
    {
        $payment_id = Session::get('stripe_payment_id');
        if(!isset($payment_id)){
            return redirect()->route('home');
        }
        $order = Orders::where('session',$payment_id)->first();
        Session::forget('stripe_payment_id');
        $order->update(['order_status'=>'cancelled']);
        return view('frontend.stripe_failed')->with('errormsg','Payment Failed. Please Contact To Your Bank For Futher Details.');
    }

    public function purchase_membership(Request $request){
        $qty = 1;
        $request->validate([
            'membership_code' => 'required|integer',
        ]);

        $membership = Membership::where('code', (int) $request->membership_code)
            ->where('is_active', 1)
            ->firstOrFail();

        $data = [];
        $data['membership_details'] = [
            'id' => $membership->id,
            'code' => $membership->code,
            'title' => $membership->title,
            'price' => (float) $membership->price,
            'type' => $membership->duration_type,
            'duration' => $membership->duration_value,
        ];

        $data['order_no'] = rand(1000, 999999);
        $data['payment_type'] = 'stripe';
        $data['payment'] = 'stripe';
        $data['order_status'] = 'pending';
        $data['order_type'] = 'membership';
        $data['user_id'] = Auth::user()->id;
        $data['order_total_amount'] = $data['membership_details']['price'] * $qty;

        require_once(public_path('stripe-php/init.php'));        
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $neworder = Orders::create($data);

        $p_items[] = [
            'price_data' => [
                'currency' => 'USD',
                'unit_amount' => $data['membership_details']['price']*100,
                'product_data' => [
                    'name' => (isset($data['membership_details']['title']))?$data['membership_details']['title']:'',
                ]
            ],
            'quantity' => $qty
        ];

        $customer_id = (!empty($neworder->user->stripe))?$neworder->user->stripe:null;
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $p_items,
            'customer'=>$customer_id,
            'success_url' => URL::route('stripeSuccess'),
            'cancel_url' => URL::route('stripeFail'),
            'mode' => 'payment',
        ]);
        Session::put('stripe_payment_id', $session['id']);
        $neworder->update(['session'=>$session['id']]);
        $session_id = $session['id'];
        return view('frontend.stripe',compact('session_id'));
    }
}
