<?php

	namespace lbs\common\errors;

	class BadUri {

		public static function error($req, $resp) {

			// ajoute ou remplace
			$rs= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

			$rs= $rs->withStatus(400);

			$temp = array("type" => "error", "error" => '400', "message" => "url inconnu : ");
			
			$rs->getBody()->write(json_encode($temp));

			return $rs;

		}


}
