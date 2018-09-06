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

/**
 * Create csrf-token
 * @return string
 */
function token() {
    $_SESSION['token'] = bin2hex(random_bytes(32));
    return $_SESSION['token'];
}

/**
 * csrf-token validate
 * @return true|false
 */
function tokenValid() {
    return hash_equals($_POST['token'], $_SESSION['token']);
}

// Define event levels, when changed modify eventController's construct() 
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

// Define constans for time_ago() function
define( 'TIMEBEFORE_NOW',         'now' );
define( 'TIMEBEFORE_MINUTE',      '{num} minute ago' );
define( 'TIMEBEFORE_MINUTES',     '{num} minutes ago' );
define( 'TIMEBEFORE_HOUR',        '{num} hour ago' );
define( 'TIMEBEFORE_HOURS',       '{num} hours ago' );
define( 'TIMEBEFORE_YESTERDAY',   'yesterday' );
define( 'TIMEBEFORE_FORMAT',      '%e %b' );
define( 'TIMEBEFORE_FORMAT_YEAR', '%e %b, %Y' );

// Convert datetime (unix timestamp) to 'time ago' format 
function time_ago( $time ) {
    $out    = ''; // what we will print out
    $now    = time(); // current time
    $diff   = $now - $time; // difference between the current and the provided dates

    if( $diff < 60 ) // it happened now
        return TIMEBEFORE_NOW;

    elseif( $diff < 3600 ) // it happened X minutes ago
        return str_replace( '{num}', ( $out = round( $diff / 60 ) ), $out == 1 ? TIMEBEFORE_MINUTE : TIMEBEFORE_MINUTES );

    elseif( $diff < 3600 * 24 ) // it happened X hours ago
        return str_replace( '{num}', ( $out = round( $diff / 3600 ) ), $out == 1 ? TIMEBEFORE_HOUR : TIMEBEFORE_HOURS );

    elseif( $diff < 3600 * 24 * 2 ) // it happened yesterday
        return TIMEBEFORE_YESTERDAY;

    else // falling back on a usual date format as it happened later than yesterday
        return strftime( date( 'Y', $time ) == date( 'Y' ) ? TIMEBEFORE_FORMAT : TIMEBEFORE_FORMAT_YEAR, $time );
}
