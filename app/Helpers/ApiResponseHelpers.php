<?php

function successFetchResponseJSON($data = [], $message = 'Operation successfully processed.', $status = 'Success',$code = 200) {
    return response()->json([
        'code' => $code,
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ], $code);
}

function successResponseJSON($data = [], $message = 'Operation successfully processed.', $status = 'Success',$code = 201) {
    return response()->json([
        'code' => $code,
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ], $code);
}

function successUpdateResponseJSON($data = [], $message = 'Operation successfully processed.', $status = 'Success',$code = 200) {
    return response()->json([
        'code' => $code,
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ], $code);
}

function validationErrorResponseJSON($data = [], $message = 'The given data was invalid.', $status = 'Unprocessed Entity',$code = 422) {
    return response()->json([
        'code' => $code,
        'status' => $status,
        'message' => $message,
        'validation_params_error' => $data,
    ], $code);
}

function internalServerErrorResponseJSON($data = [], $message = 'Something went wrong.', $status = 'Internal Server Error',$code = 500) {
    return response()->json([
        'code' => $code,
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ], $code);
}

function unauthorizedResponseJSON($data = [], $message = 'Unauthorized access', $status = 'Unauthorized',$code = 401) {
    return response()->json([
        'code' => $code,
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ], $code);
}

function notFoundResponseJSON($data = [], $message = 'Not found', $status = 'Not found',$code = 404) {
    return response()->json([
        'code' => $code,
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ], $code);
}