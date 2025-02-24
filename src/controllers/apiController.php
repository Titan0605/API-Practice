<?php
class APIResponse {
    private static function sendResponse($statusCode, $success, $message = '', $data = null) { //base function to make a response to the user
        http_response_code($statusCode);
        
        $response = [
            'status' => $statusCode,
            'success' => $success
        ];

        if (!empty($message)) {
            $response['message'] = $message;
        }

        if ($data !== null) {
            $response['data'] = $data;
        }

        echo json_encode($response);
        exit;
    }

    //Adding all the status the API it will use, usign the base function sendRequest
    public static function success($data = null, $message = 'Success') {
        self::sendResponse(200, true, $message, $data);
    }

    public static function created($data = null, $message = 'Resource created successfully') {
        self::sendResponse(201, true, $message, $data);
    }

    public static function badRequest($message = 'Bad request') {
        self::sendResponse(400, false, $message);
    }

    public static function notFound($message = 'Resource not found') {
        self::sendResponse(404, false, $message);
    }

    public static function serverError($message = 'Internal server error') {
        self::sendResponse(500, false, $message);
    }

    public static function noContent($data = null, $message = 'No data available'){
        self::sendResponse(200, true, $message, $data);
    }
}