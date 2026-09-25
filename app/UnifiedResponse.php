<?php

namespace App;

use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

trait UnifiedResponse
{
   public function SuccessResponse($data='null',$message='success',int $statuscode)
   {
     if($statuscode>200 && $statuscode<400)
     {
        return response()->json([
            'data'=>$data,
            'message'=>$message,
            'status_code'=>$statuscode
        ],$statuscode);
     }
     else{
        return response()->json([
            'data'=>null,
            'message'=>'Invalid status code for success response',
            'status_code'=>400
        ],400);
     }
   }
   public function ErrordResponse($data='null',$message=' A error happened',int $statuscode=400,Exception $th): JsonResponse
   {
     return response()->json([
        'data'=>$data,
        'message'=>$message,
        'status_code'=>$statuscode,
        'Exception'=>$th->getMessage()
     ],$statuscode);
   }

   public function CustomResponse($data='null',$message='Custom response',int $Customstatuscode=200)
   {
     return response()->json([
        'data'=>$data,
        'message'=>$message,
        'status_code'=>$Customstatuscode
     ],$Customstatuscode);
   }
}
