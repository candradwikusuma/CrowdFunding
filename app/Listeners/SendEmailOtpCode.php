<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\SendOtpCodeMail;
use Mail;

class SendEmailOtpCode implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        if($event->condition=="register"){
            $pesan="Terima kasih telah menggunakan aplikasi ini.Pertama anda harus konfirmasi akun terlebih dahulu, dan ini adalah kode Otp anda: ";
        }
        elseif($event->condition=="regenerate"){
            $pesan="Anda telah berhasil menggenerate kode OTP, Ini kode Otp baru anda: ";
        }

        Mail::to($event->user)->send(new SendOtpCodeMail($event->user,$pesan));
    }
}
