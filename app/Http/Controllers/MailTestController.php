<?php
namespace App\Http\Controllers;

use App\Mails\MailSender;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailTestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $toUser = 'user@example.com';
        $mailable = new MailSender;

        // 送信される想定のメール本文をブラウザで確認したい場合
        return ($mailable)->render();

        // メール送信する
        Mail::to($toUser)->send($mailable);
        return response()->json(['result' => 'OK']);
    }
}