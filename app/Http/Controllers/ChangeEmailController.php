<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\EmailReset;
use App\User;

class ChangeEmailController extends Controller
{
    public function sendChangeEmailLink(Request $request)
    {
        $new_email = $request->new_email;
        // メールアドレスがすでに登録されている場合は中断する。
        if(User::where('email', $new_email)->exists()){
            return redirect('/email_reset')->with('flash_message', '入力されたメールアドレスは既に使用されています。');
        }

        // トークン生成
        $token = hash_hmac(
            'sha256',
            Str::random(40) . $new_email,
            config('app.key')
        );

        // トークンをDBに保存
        DB::beginTransaction();
        try {
            $param = [];
            $param['user_id'] = Auth::id();
            $param['new_email'] = $new_email;
            $param['token'] = $token;
            $email_reset = EmailReset::create($param);

            DB::commit();

            $email_reset->sendEmailResetNotification($token);

            return redirect('/email_changed')->with('flash_message', '確認メールを送信しました。');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/email_changed')->with('flash_message', 'メール更新に失敗しました。');
        }
    }
/**
     * メールアドレスの再設定処理
     *
     * @param Request $request
     * @param [type] $token
     */
    public function reset(Request $request, $token)
    {
        $email_resets = DB::table('email_resets')
            ->where('token', $token)
            ->first();

        // トークンが存在している、かつ、有効期限が切れていないかチェック
        if ($email_resets && !$this->tokenExpired($email_resets->created_at)) {

            // ユーザーのメールアドレスを更新
            $user = User::find($email_resets->user_id);
            $user->email = $email_resets->new_email;
            $user->save();

            // レコードを削除
            DB::table('email_resets')
                ->where('token', $token)
                ->delete();
            return view('email_changed_verify')->with('flash_message', 'メールアドレスを更新しました！');
        } else {
            // レコードが存在していた場合削除
            if ($email_resets) {
                DB::table('email_resets')
                    ->where('token', $token)
                    ->delete();
            }
            return view('email_changed_verify')->with('flash_message', 'メールアドレスの更新に失敗しました。');
        }
    }


    /**
     * トークンが有効期限切れかどうかチェック
     *
     * @param  string  $createdAt
     * @return bool
     */
    protected function tokenExpired($createdAt)
    {
        // トークンの有効期限は60分に設定
        $expires = 60 * 60;
        return Carbon::parse($createdAt)->addSeconds($expires)->isPast();
    }
}
