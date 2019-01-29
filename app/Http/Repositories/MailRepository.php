<?php
/**
 * Created by PhpStorm.
 * User: Nathan
 * Date: 28/01/2019
 * Time: 15:39
 */

namespace App\Http\Repositories;
use Illuminate\Support\Facades\Mail;

class MailRepository
{
    protected static $mail = "ProjetWEB562@gmail.com";

    public static function sendMail($dest, $title, $content)
    {
        if (isset($dest))
        {
            $data = [
                "title" => (isset($title)) ? $title : "NO-REPLY : BDE Cesi Nancy",
                "content" => (isset($content)) ? $content : "Ce mail a été envoyé automatiquement",
                "email" => $dest,
            ];

            try
            {
                Mail::send('components.mail', $data, function ($message) use ($data) {
                    $subject = $data["title"];
                    $message->from(MailRepository::$mail);
                    $message->to($data["email"], 'vandeiheim.ovh')->subject($subject);
                });
            }catch (\Exception $e)
            {
                dd($e->getMessage());
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}
