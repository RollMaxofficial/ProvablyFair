<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Provable\Provable;
use  App\Provable\CoinFupProvable;
use  App\Provable\KPSProvable;
use  App\Provable\DiceRollingProvable;
use  App\Provable\DiceRollProvable;
use  App\Provable\RouletteProvable;
use  App\Provable\LimboProvable;
use  App\Provable\NormalProvable;
use  App\Provable\NumberSlotProvable;

use  App\Provable\MinesProvable;
use  App\Provable\KenoProvable;
use  App\Provable\HouseracingProvable;
use  App\Provable\DarganTowerProvable;


class HomeController extends Controller
{

    
    public function getSeed(Request $request){
        $seedLength  =$request->seedLength??10;
        $provable = new Provable( $seedLength);

        $clientSeed= $provable->getClientSeed().":1:0";
        $hmac = hash_hmac('sha256',  $clientSeed ,  $provable->getServerSeed() );
        return  array("clientSeed"=>$provable->getClientSeed(),"serverSeed"=> $provable->getServerSeed() ,"hashServerSeed"=> $provable->getHashedServerSeed(),"hmac"=> $hmac);
    }


    
    public function provable(Request $request)
    {
     
        $min  =$request->min;
        $max  =$request->max;
        $shuffleType  =$request->shuffleType;
        $clientSeed  =$request->clientSeed;
        $nonce  =$request->nonce;
      
        
        $clientSeed= $clientSeed.":".$nonce.":0";
        $serverSeed  =$request->serverSeed;

        // $clientSeed= "GuoRjr3oEE:16:0";
        // $serverSeed  ="bc761f94aa221f0b7d36fdc4cfb6aa11df9aba9ecbce9cbe3568faa0d4183c8f";
        // $shuffleType=2;

        $hmac = hash_hmac('sha256',  $clientSeed , $serverSeed);
        $map=array("hmac"=> $hmac);
     

         $type =$request->type;
        if ($type==0) {
            $provable =  CoinFupProvable::init( $clientSeed, $serverSeed);
           
        }else if ($type==1) {
            $provable =  KPSProvable::init( $clientSeed, $serverSeed);
          
        }  else if ($type==2) {
            $provable =  DiceRollingProvable::init( $clientSeed, $serverSeed);
         
        } else if ($type==3) {

            $provable =  DiceRollProvable::init( $clientSeed, $serverSeed);
           
        }
        else if ($type==4) {
            $provable =  RouletteProvable::init( $clientSeed, $serverSeed);
          
       
        } else if ($type==5) {
            $provable =  LimboProvable::init( $clientSeed, $serverSeed);
          
       
        }else if ($type==6) {
            $provable =  NormalProvable::init(  $clientSeed, $serverSeed,$min, $max);
          
        
        }else if ($type==7) {
            $provable =  NumberSlotProvable::init( $clientSeed, $serverSeed);
          
        }else if ($type==8) {
            $provable =  MinesProvable::init( $clientSeed, $serverSeed);
          
        }else if ($type==9) {
            $provable =  KenoProvable::init( $clientSeed, $serverSeed);
          
        }else if ($type==10) {
            $provable =  HouseracingProvable::init( $clientSeed, $serverSeed);
          
        }else if ($type==11) {
            $provable =  DarganTowerProvable::init( $clientSeed, $serverSeed,$shuffleType);
        } 
      
        if($type<7){
            $map["data"] =  $provable->number();
        }else{
            $map["data"] =  $provable->results(); 
        }
        $map["serverSeed"] =  $provable->getServerSeed();
        $map["clientSeed"] =  $provable->getClientSeed();
        $map["hashServerSeed"] =  $provable->getHashedServerSeed(); 
        return $map;
        
    }

}
