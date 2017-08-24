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

$a = (new pipe())->send(1)->through($middlewares)->then(dispatchToRouter());
</pre>
