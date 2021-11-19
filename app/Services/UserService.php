<?php
namespace App\Services;

class UserService
{
    protected $request;

    public function __construct()
    {
        $this->request = app('request');
    }

    public function getPublicIP()
    {

        if ( function_exists( 'apache_request_headers' ) ) {
            $headers = apache_request_headers();
        } else {
            $headers = $_SERVER;
        }

        if( array_key_exists('X-Forwarded-For', $headers)) {
            $getiparray = $headers['X-Forwarded-For'];
            $explodeValue = explode(',',$getiparray);

            $the_ip  = $explodeValue[0];
            return $the_ip;
        }
        elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers)) {
            $getiparray = $headers['X-Forwarded-For'];
            $explodeValue = explode(',',$getiparray);

            $the_ip  = $explodeValue[0];
            return $the_ip;
        }
        else {
            $the_ip = $_SERVER['REMOTE_ADDR'];
        }

        return $the_ip;
    }

    public function image()
    {
        if ($this->request->hasFile('image'))
        {
            $photoPath = $this->request->file('image')->store('public');
            $photoName = (explode('/', $photoPath))[1];
            $host = $_SERVER['HTTP_HOST'];
            $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
            $path = $protocol . $host . "/public/storage/" . $photoName;
            $image = ['image' => $path];
            return $image;
        }
        else
        {
            return [];
        }
    }
}
