<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Validator;


/**
 * 捷酷控制器类
 * Class JkController
 * @package App\Http\Controllers\Admin
 */
class JkController extends BaseController
{
    /**
     * 获取广告数据
     */
    public function getData()
    {
        $input = Input::get();
        //入参过滤
        $validate = Validator::make(Input::get(), [
            'app_package_name' => 'required|string',
            'media_type' => 'required|integer',
            'device_width' => 'required|integer',
            'device_height' => 'required|integer',
            'os_version' => 'required|string',
            'os_type' => 'required|string',
            'device_type' => 'required|integer',
            'brand' => 'string',
            'model' => 'string',
            'network_type' => 'required|integer',
            'client_type' => 'required|integer',
            'adslots_id' => 'required|string',
            'adslots_type' => 'required|integer',
            'adslots_width' => 'required|integer',
            'adslots_height' => 'required|integer',

        ]);
        //参数校验失败则返回
        if ($validate->fails()) {
            return $validate->errors()->all();
        }

        if (Input::has('os_version')) {
            $ver = Input::get('os_version');
            $ex_ver = explode(".", $ver);
            $os_version_major = isset($ex_ver[0]) ? $ex_ver[0] : 0;
            $os_version_minor = isset($ex_ver[1]) ? $ex_ver[1] : 0;
            $os_version_micro = isset($ex_ver[2]) ? $ex_ver[2] : 0;
            $os_version_build = isset($ex_ver[3]) ? $ex_ver[3] : 0;
        }


        $data = array(
            "device" => array(
                "screen_size" => array(
                    "width" => (int)$input['device_width'],
                    "height" => (int)$input['device_height'],
                ),
                "brand" => isset($input['brand']) ? $input['brand'] : '',
                "model" => isset($input['model']) ? $input['model'] : '',
                "type" => (int)$input['device_type'],
                "ids" => array(
                    array(
                        "id" => $input['ids_id'],
                        "type" => (int)$input['ids_type']
                    ),),

                "os_version" => array(
                    "build" => (int)$os_version_build,
                    "micro" => (int)$os_version_micro,
                    "minor" => (int)$os_version_minor,
                    "major" => (int)$os_version_major,
                ),
                "os_type" => (int)$input['os_type'],
            ),
            "debug" => false,
            "adslots" => array(
                array(
                    "type" => (int)$input['adslots_type'],
                    "id" => $input['adslots_id'],
                    "size" => array(
                        "width" => (int)$input['adslots_width'],
                        "height" => (int)$input['adslots_height'],
                    ),
                ),),
            "client" => array(
                "type" => (int)$input['client_type'],
                "version" => array(
                    "build" => 0,
                    "micro" => 0,
                    "minor" => 2,
                    "major" => 1,
                ),
            ),
            "media" => array(
                "type" => (int)$input['media_type'],
                "app" => array(
                    "package_name" => $input['app_package_name'],
                ),
            ),
            "network" => array(
                "type" => (int)$input['network_type'],
            ),
        );
        $result = json_encode($data);
        //  var_dump( $result);die();

        $url = "http://api.jesgoo.com/v1/json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $result);
        curl_setopt($ch, CURLOPT_TIMEOUT, 50);
        $output = curl_exec($ch);
        curl_close($ch);
        echo $output;

    }

}
