# pipe



<pre>
function dispatchToRouter()
{
    return function ($request) {
        echo '>>>'.$request . PHP_EOL;
    };
}

$request = 10;

$middlewares = [
    function($a,$next){
        var_dump($a);
        return $next($a + 5);
    },
    function($b,$next){
        var_dump($b);
        return $next($b * 2);
    },
    function($c,$next){
        var_dump($c);
        $r = $next($c - 1);
        return $r;
    },
];

> 函数的返回值为第一个PIPE的返回值

(new pipe())->send(1)->through($middlewares)->then(dispatchToRouter());


$middlewares = [
    function($a,$next){
        $next($a + 5);
        var_dump($a);
    },
    function($b,$next){
        $next($b * 2);
        var_dump($b);
    },
    function($c,$next){
        $next($c - 1);
        var_dump($c);
    },
];

(new pipe())->send(1)->through($middlewares)->then(dispatchToRouter());

</pre>
