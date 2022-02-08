<?php

if (!function_exists('pr')) {

    function pr($dataArr, $die = TRUE)
    {
        echo '<pre>';
        print_r($dataArr);
        if ($die == TRUE) {
            die;
        }
    }
}

if (!function_exists('sendResponse')) {

    function sendResponse($message, $data, $status)
    {
        if (!empty($data)) {
            $returnData = $data;
        } else {
            $returnData = (object) [];
        }
        return response()->json(['status' => $status, 'data' => $returnData ?? NULL, 'message' => $message ?? NULL], 200);
    }
}
