<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 3/13/18
 * Time: 12:09 AM
 */

namespace CraftedSystems\Tilil;

use Unirest\Request;
use Unirest\Request\Body;

class TililSMS
{
    /**
     * Base URL.
     *
     * @var string
     */
    const BASE_URL = 'http://api.tililtechnologies.co.ke/1112/sendsms/';

    /**
     * Get Balance endpoint.
     *
     * @var string
     */
    const GET_BALANCE_ENDPOINT = 'sms/balance';

    /**
     * settings .
     *
     * @var array.
     */
    protected $settings;

    /**
     * MicroMobileSMS constructor.
     * @param $settings
     * @throws \Exception
     */
    public function __construct($settings)
    {
        $this->settings = (object)$settings;

        if (
            empty($this->settings->username) ||
            empty($this->settings->password) ||
            empty($this->settings->short_code)
        ) {
            throw new \Exception('Please ensure that all Tilil configuration variables have been set.');
        }
    }

    /**
     * @param $recipient
     * @param $message
     * @return mixed
     * @throws \Exception
     */
    public function send($recipient, $message)
    {
        if (!is_string($message)) {

            throw new \Exception('The Message Should be a string');
        }

        if (!is_string($recipient)) {
            throw new \Exception('The Phone number should be a string');
        }


        $headers = [
            'Content-Type' => 'application/json',
        ];

        $body = array(
            'username' => $this->settings->username,
            'password' => base64_encode(md5($this->settings->password)),
            "pass_type" => "bm5",
            'shortcode' => $this->settings->short_code,
            'message' => $message,
            'mobile' => $recipient
        );

        $response = Request::post(self::BASE_URL, $headers, Body::json($body));

        return $response->body;

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function getDeliveryReports(\Illuminate\Http\Request $request)
    {
        return json_decode($request->getContent());
    }

    /**
     * @return float
     */
    public function getBalance()
    {
        //$endpoint = 'http://isms.infosky.co.ke/sms2/api/v1/account/balance?acc_no=' . $this->settings->acc_no . '&api_key=' . $this->settings->api_key;

        //return (float)Request::get($endpoint)->body->balance->amount;

        return 100;
    }

}