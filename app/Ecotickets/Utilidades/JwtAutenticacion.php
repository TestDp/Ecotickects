<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 10/03/2020
 * Time: 10:42 AM
 */

namespace Eco\Utilidades;


use Ecotickets\User;
use Illuminate\Support\Facades\Hash;
use \Firebase\JWT\JWT;

class JwtAutenticacion
{
    private $key;
    public function __construct()
    {
        $this->key = 'stekcitoce1036929871';
    }

    public  function SingUp($email,$password,$getToken=null){
        $usuario =  User::where(
                'email','=', $email
            )->first();
        $signUp = false;
        if (Hash::check($password, $usuario->password)) {
            $signUp = true;
        }

        if($signUp){
            $token = array(
                'id'=> $usuario->id,
                'email'=> $usuario->email,
                'name' => $usuario->name,
                'last_name' => $usuario->last_name,
                'iat' => time(),
                'exp' => time() + (7*24*60*60)
            );
            $jwt =  JWT::encode($token,$this->key,'HS256');
            $decode = JWT::decode($jwt,$this->key,array('HS256'));


            if(is_null($getToken)){
                return $jwt;
            }else{
                return $decode;
            }

        }else{
            return array('status' =>'error','mesanje'=>'login ha fallado');
        }

    }

    public  function CheckToken($jwt,$getIdentity = false){
        $auth = false;
        $decode = null;
        try{
            $decode = JWT::decode($jwt,$this->key,array('HS256'));
        }catch (\UnexpectedValueException $e){
            $auth = false;
        }catch (\DomainException $e){
            $auth = false;
        }
        if(is_object($decode) && isset($decode->id) ){
            $auth = true;
        }
        if($getIdentity){
            return  $decode;
        }
        return $auth;
    }



}