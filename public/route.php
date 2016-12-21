<?php

	class Route {

		private $uri = array();
		private $method = array();

		// Creates a list of searchable URls
		public function add($uri, $method=NULL) {

			$this->uri[] = "/" . trim($uri, "/");

			if ($method != NULL) {
				$this->method[] = $method;
			}

		}

		// Loads the classes of the matched regexps or use 404 class
		public function submit() {

			$getURIParameters = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';
			foreach ($this->uri as $key => $value) {
				if (preg_match("#^$value$#", $getURIParameters)) {
					$useMethod = $this->method[$key];
					new $useMethod();
					break;
				}
				else {
					new NotFound();
					break;
				}
			}

		}

	}

?>