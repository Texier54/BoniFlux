<?php

	namespace lbs\common\errors;

	class NotAllowed {

		public static function error($req, $resp, $method) {

			// ajoute ou remplace
			$rs= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

			$rs= $rs->withStatus(405);

			$temp = array("type" => "error", "error" => '405', "message" => "Not allowed");
			
			$rs->getBody()->write(json_encode($temp));

			return $rs;

		}


}
