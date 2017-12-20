<?php
class BreakTest extends PHPUnit_Framework_TestCase {
	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function testArr() {
        $middlewares = [
            function($a,$next){
                return $next($a + 5);
            },
            function($b,$next){
                return $next($b * 2);
            },
            function($c,$next){
                return 1;
            },
        ];

        $result = (new \Badtomcat\Pipeline())->send(1)->through($middlewares)->then(function ($request) {
                return "taw";
        });
        $this->assertEquals(1,$result);
	}

    public function testB2() {
        $middlewares = [
            function($a,$next){
                return 152;
            },
            function($b,$next){
                return $next($b * 2);
            },
            function($c,$next){
                return 1;
            },
        ];

        $result = (new \Badtomcat\Pipeline())->send(1)->through($middlewares)->then(function ($request) {
            return "taw";
        });
        $this->assertEquals(152,$result);
    }

    public function testB3() {
        $middlewares = [
            function($a,$next){
                $next($a);
                return 152;
            },
            function($b,$next){
                $next($b);
                return 127+$b;
            },
            function($c,$next){
                $next($c);
                return 1;
            },
        ];

        $result = (new \Badtomcat\Pipeline())->send(1)->through($middlewares)->then(function ($request) {
            return "taw";
        });
        $this->assertEquals(152,$result);
    }


    public function testB4() {
        $middlewares = [
            function($a,$next){
                $next($a);
                return $next($a);
            },
            function($b,$next){
                $next($b);
                return 127+$b;
            },
            function($c,$next){
                $next($c);
                return 1;
            },
        ];

        $result = (new \Badtomcat\Pipeline())->send(1)->through($middlewares)->then(function ($request) {
            return "taw";
        });
        $this->assertEquals(128,$result);
    }

    public function testB5() {
        $middlewares = [
            function($a,$next){
                $next($a);
                return $next($a + 128);
            },
            function($b,$next){
                $next($b);
                return 127+$b;
            },
            function($c,$next){
                $next($c);
                return 1;
            },
        ];

        $result = (new \Badtomcat\Pipeline())->send(1)->through($middlewares)->then(function ($request) {
            return "taw";
        });
        $this->assertEquals(256,$result);
    }


    public function testB6() {
        $middlewares = [
            function($a,$next){
                $next($a);
                return $next($a + 128);
            },
            function($b,$next){
                $next($b);
                return $next($b);
            },
            function($c,$next){
                $next($c);
                return 1;
            },
        ];

        $result = (new \Badtomcat\Pipeline())->send(1)->through($middlewares)->then(function ($request) {
            return "taw";
        });
        $this->assertEquals(1,$result);
    }


    public function testB7() {
        $middlewares = [
            function($a,$next){
                $next($a);
                return $next($a + 128);
            },
            function($b,$next){
                $next($b);
                return $next($b);
            },
            function($c,$next){

                return 1+$c;
            },
        ];

        $result = (new \Badtomcat\Pipeline())->send(1)->through($middlewares)->then(function ($request) {
            return "taw";
        });
        $this->assertEquals(130,$result);
    }
}

