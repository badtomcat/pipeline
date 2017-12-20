<?php
class ClassHandleTest extends PHPUnit_Framework_TestCase {
	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function testArr() {
        $middlewares = [
            a::class,
            b::class,
            c::class
        ];

        $result = (new \Badtomcat\Pipeline())->send(1)->through($middlewares)->then(function ($request) {
                echo '>>>'.$request . PHP_EOL;
                return "taw";
        });
        $this->assertEquals("taw",$result);
	}

}
class a
{
    public function handle($a,$next)
    {
        var_dump($a);
        return $next($a + 5);
    }
}
class b
{
    public function handle($b,$next)
    {
        var_dump($b);
        return $next($b * 2);
    }
}
class c
{
    public function handle($c,$next)
    {
        var_dump($c);
        $r = $next($c - 1);
        return $r;
    }
}
