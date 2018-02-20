<?php

	return [

		'notFoundHandler'=> function($c) {
			return function($rq, $rs) {
				return \lbs\common\errors\BadUri::error($rq, $rs);
			};
		},

		'notAllowedHandler' => function($c) {
			return function ($rq, $rs, $methods) {
				return \lbs\common\errors\NotAllowed::error($rq,$rs,$methods);
			};
		},

		'phpErrorHandler' => function($c) {
			return function ($rq, $rs, $error) {
				return \lbs\common\errors\Internal::error($rq,$rs,$error);
			};
		}
	];