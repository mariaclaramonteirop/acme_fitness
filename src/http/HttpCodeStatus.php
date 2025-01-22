<?php

namespace http;

abstract class HttpCodeStatus {
    const OK = 200;
    const CREATED = 201;
    const BAD_REQUEST = 400;
    const NOT_FOUND = 404;
    const INTERNAL_SERVER_ERROR = 500;
}