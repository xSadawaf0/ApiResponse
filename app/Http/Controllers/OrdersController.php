<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
      $rules = [
        'product_id' => 'required|integer',
        'quantity' => 'required|integer',
      ];

      $validator = Validator::make($request->all(),$rules);
      if ($validator->fails()){
        return response()->json(['message'=>$validator->errors()],400);
      }

      $validate = Products::where('id',$request->product_id)->first();



      if ($validate->available_stock < $request->quantity) {
        return response()->json(['message'=>"Failed to order this product due to unavailability of the stock"],400);
      }

      // ($validate->quantity < $request->quantity ? return response()->json(['message'=>"Failed to order this product due to unavailability of the stock"],400) : );


      $saveArr = array();
      $saveArr['product_id'] = $request->product_id;
      $saveArr['quantity'] = $request->quantity;
      Orders::create($saveArr);


      $validate = $validate->decrement('available_stock', $request->quantity);


      return response()->json(['message'=>'You have successfully ordered this product'],201);
    }

    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
