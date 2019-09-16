<?php

/**
 * 格式化输出json格式数据
 */
if(!function_exists('jsonPrint')) {
    /**
     * @param $code
     * @param $message
     * @param array $data
     * @param array $extra
     * @return false|string
     */
    function jsonPrint($code=200,$message='',$data = [],$extra = []) {
        $data = [
            'code'=>$code,
            'message'=>$message,
            'data'=>$data,
            'extra'=>$extra
        ];
        return json_encode($data);
    }
}
