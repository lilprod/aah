<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Doctor;
use App\Payment;
use App\Appointment;
use App\Patient;

class PaymentController extends Controller
{
    public function show($id){

    	$payment = Payment::findOrFail($id);

    	return view('patients.appointments.invoice', compact('payment'));
    }


    public function verif($id){

    	$appointment = Appointment::find($id); 
        
        $payment = Payment::where('identifier', $appointment->identifier)->first(); 
        
            $send = [
                'auth_token' => '7a1cd656-d835-4303-8020-4ffbd0158fd6',
                'identifier' => $payment->identifier,
            ];
    
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://paygateglobal.com/api/v2/status"            ,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($send),
                CURLOPT_HTTPHEADER => array(
                    // Set here requred headers
                    "accept: */*",
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                ),
            ));
    
            $result = curl_exec($curl);
            $error = curl_error($curl);
    
            curl_close($curl);

            if ($error) {
                return $this->sendError('cURL Error #: '.$error);
                //echo "cURL Error #:" . $err;
            }else{
                $data = json_decode($result, true);
                
                if(!empty($data['error_code'])){
                
                    return back()->with('error',"Le Paiement de $payment->name $payment->firstname est introuvable!");
                    
                }else{
                    
                    $status = $data['status'];
                    
                    if($status == 0){
                       
                       $payment->status = 1;
                       $payment->save();
                       
                        return back()->with('success',"Le Paiement de $payment->name $payment->firstname  est bien valide");
                        
                    }elseif($status == 2){

                        return back()->with('error',"Le Paiement de $payment->name $payment->firstname est non valide");
        
                    
                    }elseif($status == 4){
                        
                       return back()->with('error',"Le Paiement de $payment->name $payment->firstname est expiré!");
                    
                    }elseif($status == 6){
                        
                        return back()->with('error',"Le Paiement de $payment->name $payment->lastname est annulé");
                    }
                    
                }
                
            }
    }
}
