<?php

function str_cut($str, $sublen, $etc = '...') {
    if (strlen($str) <= $sublen) {
        $rStr = $str;
    } else {
        $I = 0;
        while ($I < $sublen) {
            $StringTMP = substr($str, $I, 1);

            if (ord($StringTMP) >= 224) {
                $StringTMP = substr($str, $I, 3);
                $I = $I + 3;
            } elseif (ord($StringTMP) >= 192) {
                $StringTMP = substr($str, $I, 2);
                $I = $I + 2;
            } else {
                $I = $I + 1;
            }
            $StringLast[] = $StringTMP;
        }

        $rStr = implode('', $StringLast) . $etc;
    }

    return $rStr;
}

function object2array($object) {
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            $array[$key] = $value;
        }
    } else {
        $array = $object;
    }
    return $array;
}

function array2object($array) {
    if (is_array($array)) {
        $obj = new StdClass();
        foreach ($array as $key => $val) {
            $obj->$key = $val;
        }
    } else {
        $obj = $array;
    }
    return $obj;
}

/**
 * json返回格式
 * code 状态码
 * msg 提示信息
 * data 返回数据
 */
function output($code=0, $msg='', $data=[]) {
    $res = array(
        'code' => $code,
        'msg' => $msg,
        'data' => $data,
    );
    return $res;
}

?>