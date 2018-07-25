<?php
use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Url;
use Pecee\Http\Response;
use Pecee\Http\Request;
/**
 * Get url for a route by using either name/alias, class or method name.
 *
 * The name parameter supports the following values:
 * - Route name
 * - Controller/resource name (with or without method)
 * - Controller class name
 *
 * When searching for controller/resource by name, you can use this syntax "route.name@method".
 * You can also use the same syntax when searching for a specific controller-class "MyController@home".
 * If no arguments is specified, it will return the url for the current loaded route.
 *
 * @param string|null $name
 * @param string|array|null $parameters
 * @param array|null $getParams
 * @return \Pecee\Http\Url
 * @throws \InvalidArgumentException
 */
function url(?string $name = null, $parameters = null, ?array $getParams = null): Url
{
    return Router::getUrl($name, $parameters, $getParams);
}
/**
 * @return \Pecee\Http\Response
 */
function response(): Response
{
    return Router::response();
}
/**
 * @return \Pecee\Http\Request
 */
function request(): Request
{
    return Router::request();
}
/**
 * Get input class
 * @param string|null $index Parameter index name
 * @param string|null $defaultValue Default return value
 * @param array ...$methods Default methods
 * @return \Pecee\Http\Input\InputHandler|\Pecee\Http\Input\IInputItem|string
 */
function input($index = null, $defaultValue = null, ...$methods)
{
    if ($index !== null) {
        return request()->getInputHandler()->getValue($index, $defaultValue, ...$methods);
    }
    return request()->getInputHandler();
}
/**
 * @param string $url
 * @param int|null $code
 */
function redirect(string $url, ?int $code = null): void
{
    if ($code !== null) {
        response()->httpCode($code);
    }
    response()->redirect($url);
}
/**
 * Get current csrf-token
 * @return string|null
 */
function csrf_token(): ?string
{
    $baseVerifier = Router::router()->getCsrfVerifier();
    if ($baseVerifier !== null) {
        return $baseVerifier->getTokenProvider()->getToken();
    }
    return null;
}

function token() {
    $_SESSION['token'] = bin2hex(random_bytes(32));
    return $_SESSION['token'];
}

function tokenValid() {
    return hash_equals($_POST['token'], $_SESSION['token']);
}

// Define event levels, when changed show eventController's construct() 
function eventLevel($id) {
    switch ($id) {
        case '2':
            return 'Beginner';
            break;
        case '3':
            return 'Elementary';
            break;
        case '4':
            return 'Intermediate';
            break;
        case '5':
            return 'Advanced';
            break;
        case '6':
            return 'Professional';
            break;
        default:
            return 'Not defined';
            break;
    }
}