<?php

require "Utility.php";
require "ElizaConfigs.php";

class ElizaBot
{
	public $_dataParsed = false;

	protected $noRandom;
	protected $capitalizeFirstLetter = true;
	protected $debug = false;
	protected $memSize = 20;
	protected $version = "1.1 (original)";
	protected $quit;
	protected $mem = [];
	protected $lastChoice = [];

	function ElizaBot($noRandomFlag=false) {
		echoln("construct ElizaBot");

		$this->noRandom = ($noRandomFlag) ? true : false;
		$this->capitalizeFirstLetter = true;
		$this->debug = false;
		$this->memSize = 20;
		if(!$this->_dataParsed)
			$this->_init();
		$this->reset();
	}

	function __destruct() {
		echoln("destruct ElizaBot");
	}

	function reset() {
		echoln("called reset()");

		global $elizaKeywords;

		$this->quit = false;
		$this->mem = [];
		$this->lastChoice = [];
		for($k=0; $k<count($elizaKeywords); $k++)
		{
			$this->lastChoice[$k] = [];
			$rules = $elizaKeywords[$k][2];
			for($i=0; $i<count($rules); $i++)
				$this->lastChoice[$k][$i] = -1;
		}
	}

	function _init() {
		echoln("called _init()");

		global $elizaSynons;
		global $elizaKeywords;

		// parse data and convert it from canonical form to internal use
		// prodoce synonym list
		$synPatterns = [];
		if( $elizaSynons && is_array($elizaSynons) ) {
			foreach($elizaSynons as $key => $arrayValues)
				$synPatterns[$key] = '('.$key.'|'.join('|', $arrayValues).')';
		}

		// check for keywords or install empty structure to prevent any errors
		if(!$elizaKeywords) {
			$elizaKeywords = [['###',0,[['###',[]]]]];
		}
		// 1st convert rules to regexps
		// expand synonyms and insert asterisk expressions for backtracking
		$sre='/@(\S+)/';
		$are='/(\S)\s*\*\s*(\S)/';
		$are1='/^\s*\*\s*(\S)/';
		$are2='/(\S)\s*\*\s*$/';
		$are3='/^\s*\*\s*$/';
		$wsre='/\s+/g';

		// ...
	}
}

?>