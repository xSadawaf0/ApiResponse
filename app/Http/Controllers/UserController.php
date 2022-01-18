<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Hash;
use Str;
use Auth;
class UserController extends Controller
{

    public function index()
    {
      $user = User::all();
      return response()->json(['data'=>$user],200);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {

      $rules = [
        'email' => 'required|email|unique:tbl_users',
        'password' => 'required',
      ];

      $validator = Validator::make($request->all(),$rules);

      if ($validator->fails()){
          return response()->json(['message'=>$validator->errors()],400);
      }

      $saveArr = array();
      $saveArr['name'] = $request->name;
      $saveArr['email'] = $request->email;
      $saveArr['password'] = Hash::make($request->password);

      User::create($saveArr);
      return response()->json(['message'=>"User successfully registered"],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     public function login(Request $request){

       $valid = User::where('email',$request->email)->first();

       if (isset($valid->email)) {
         if (Hash::check($request->password,$valid->password)) {

           // $user = User::find($valid->id
          $token = $valid->createToken('authToken')->accessToken;
          $valid->api_token = $token->token;
          $valid->save();

           return response()->json(['access_token'=>$token->token],201);
        }else {
          return response()->json(['message'=>"Invalid credentials"],401);
        }
       }







       // return response()->json(['message'=>"User successfully registered"],201);
     }
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
