<?php


namespace Libs\Https;


class Status
{
    public static function text($status_code)
    {
        return empty(self::TEXT[$status_code]) ? "" : self::TEXT[$status_code];
    }

    # Success
    public const HTTP_200_OK = 200;
    public const HTTP_201_CREATED = 201;
    public const HTTP_202_ACCEPTED = 202;
    public const HTTP_203_NON_AUTHORITATIVE_INFORMATION = 203;
    public const HTTP_204_NO_CONTENT = 204;
    public const HTTP_205_RESET_CONTENT = 205;
    public const HTTP_206_PARTIAL_CONTENT = 206;
    public const HTTP_207_MULTI_STATUS = 207;
    public const HTTP_208_ALREADY_REPORTED = 208;
    public const HTTP_226_IM_USED = 226;

    # Redirect
    public const HTTP_300_MULTIPLE_CHOICES = 300;
    public const HTTP_301_MOVED_PERMANENTLY = 301;
    public const HTTP_302_FOUND = 302;
    public const HTTP_303_SEE_OTHER = 303;
    public const HTTP_304_NOT_MODIFIED = 304;
    public const HTTP_305_USE_PROXY = 305;
    public const HTTP_306_RESERVED = 306;
    public const HTTP_307_TEMPORARY_REDIRECT = 307;
    public const HTTP_308_PERMANENT_REDIRECT = 308;

    # Client Error
    public const HTTP_400_BAD_REQUEST = 400;
    public const HTTP_401_UNAUTHORIZED = 401;
    public const HTTP_402_PAYMENT_REQUIRED = 402;
    public const HTTP_403_FORBIDDEN = 403;
    public const HTTP_404_NOT_FOUND = 404;
    public const HTTP_405_METHOD_NOT_ALLOWED = 405;
    public const HTTP_406_NOT_ACCEPTABLE = 406;
    public const HTTP_407_PROXY_AUTHENTICATION_REQUIRED = 407;
    public const HTTP_408_REQUEST_TIMEOUT = 408;
    public const HTTP_409_CONFLICT = 409;
    public const HTTP_410_GONE = 410;
    public const HTTP_411_LENGTH_REQUIRED = 411;
    public const HTTP_412_PRECONDITION_FAILED = 412;
    public const HTTP_413_REQUEST_ENTITY_TOO_LARGE = 413;
    public const HTTP_414_REQUEST_URI_TOO_LONG = 414;
    public const HTTP_415_UNSUPPORTED_MEDIA_TYPE = 415;
    public const HTTP_416_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    public const HTTP_417_EXPECTATION_FAILED = 417;
    public const HTTP_422_UNPROCESSABLE_ENTITY = 422;
    public const HTTP_423_LOCKED = 423;
    public const HTTP_424_FAILED_DEPENDENCY = 424;
    public const HTTP_426_UPGRADE_REQUIRED = 426;
    public const HTTP_428_PRECONDITION_REQUIRED = 428;
    public const HTTP_429_TOO_MANY_REQUESTS = 429;
    public const HTTP_431_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    public const HTTP_451_UNAVAILABLE_FOR_LEGAL_REASONS = 451;

    # Server Error
    public const HTTP_500_INTERNAL_SERVER_ERROR = 500;
    public const HTTP_501_NOT_IMPLEMENTED = 501;
    public const HTTP_502_BAD_GATEWAY = 502;
    public const HTTP_503_SERVICE_UNAVAILABLE = 503;
    public const HTTP_504_GATEWAY_TIMEOUT = 504;
    public const HTTP_505_HTTP_VERSION_NOT_SUPPORTED = 505;
    public const HTTP_506_VARIANT_ALSO_NEGOTIATES = 506;
    public const HTTP_507_INSUFFICIENT_STORAGE = 507;
    public const HTTP_508_LOOP_DETECTED = 508;
    public const HTTP_509_BANDWIDTH_LIMIT_EXCEEDED = 509;
    public const HTTP_510_NOT_EXTENDED = 510;
    public const HTTP_511_NETWORK_AUTHENTICATION_REQUIRED = 511;

    public const TEXT = [
        200 => 'Ok',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi Status',
        208 => 'Already Reported',
        226 => 'Im Used',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Reserved',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request Uri Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        451 => 'Unavailable For Legal Reasons',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'Http Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        509 => 'Bandwidth Limit Exceeded',
        510 => 'Not Extended',
        511 => 'Network Authentication Required',
    ];

    public static function isSuccess($status)
    {
        return (string)$status[0] === '2';
    }

    public static function isRedirect($status)
    {
        return (string)$status[0] === '3';
    }

    public static function isClientError($status)
    {
        return (string)$status[0] === '4';
    }

    public static function isServerError($status)
    {
        return (string)$status[0] === '5';
    }
}
