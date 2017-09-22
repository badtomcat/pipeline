<?php
class BaseTest extends PHPUnit_Framework_TestCase {
	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function testArr() {
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

        $result = (new \Tian\Pipeline())->send(1)->through($middlewares)->then(function ($request) {
                echo '>>>'.$request . PHP_EOL;
                return "taw";
        });
        $this->assertEquals("taw",$result);
	}

}

