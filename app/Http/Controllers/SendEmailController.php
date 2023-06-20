<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail; 
class SendEmailController extends Controller
{
     
    /**
     * Write code on Method
     *
     * @return response()
     */
    static public function sendEmail($data, $files)
    {
 
        Mail::send('emails.template', $data, function($message)use($data, $files) {
            $message->to($data["email"])
                    ->subject($data["title"]);
            foreach ($files as $file){
                $message->attach($file);
            }            
        });

        echo "Mail send successfully !!";

        // Mail::to($email)->send(new NotifyMail($mailData));
        // if (Mail::failures()) {
        //     return response()->Fail('Sorry! Please try again latter');
        // }else{
        //     return response()->success('Great! Successfully send in your mail');
        // }
    } 
}