<?php

namespace App\Http\Services\Message\SMS;

use App\Http\Interfaces\MessageInterface;
use Trez\RayganSms\Facades\RayganSms;


class SmsService implements MessageInterface{
    public $text;
    public $mobile;


    public function fire()
    {
        $params = [
            'UserName'=>'',
            'Password'=>'',
            'Mobile'=>$this->mobile,
            'Message'=>$this->text
        ];
        $request = \Illuminate\Support\Facades\Http::get('https://smspanel.Trez.ir/SendMessageWithCode.ashx',$params);

        if ($request->body() >= 2000){
            return true;
        }

        return false;
    }


    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }


    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    public function getMobile()
    {
        return $this->mobile;
    }
}
