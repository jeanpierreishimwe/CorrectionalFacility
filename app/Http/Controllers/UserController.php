<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
* @OA\Info(
 * title="Authentication",
 *      version="1.0.0",
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )*/

class UserController extends Controller
{
    /**
    * @OA\Get(
    *      path="/api/userList",
    *      operationId="TestId",
    *      tags={"User Route"},
    *      summary="registering a new user",
    *      description="Description",
    *      @OA\Response(
    *          response=200,
    *          description="Successfully retreived the data",
    *       ),
    *     )
    */
    function listUsers(){
        return User::all();
    }

    /**
    * @OA\Post(
    *      path="/api/registerUser",
    *      operationId="Title",
    *      tags={"User Route"},
    *      summary="User Registration",
    *      description="Description",
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\JsonContent()
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Response Message",
    *          @OA\JsonContent()
    *       ),
    *     )
    */
    function registerAUser(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>"required|email",
            'password'=>"min:6|confirmed"
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
        ]);


        return response([
         'message'=>'user Created',
        'user'=>$user,
        'token'=>$user->createToken('Api Token Of'. $user->name)->plainTextToken,
                                    
    ],200);
    }


    /**
    * @OA\Put(
    *      path="/api/updateUser/{id}",
    *      operationId="Titles",
    *      tags={"User Route"},
    *      summary="Summary",
    *      description="Description",
    *      
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\JsonContent()
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Response Message",
    *          @OA\JsonContent()
    *       ),
    *     )
    */
    function updateAUser(Request $request,$id){
        $this->validate($request,[
            'name'=>'required',
            'email'=>"required|email",
        ]);

        $user = User::update([
            'name'=>$request->name,
            'email'=>$request->email,
        ])->where('id',$id);


        return response(['message'=>'user Updated','user'=>$user],200);
    }
}
