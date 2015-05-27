<?php
class V6user extends MpModel
{
	public $args = array();
	public $res = array();

	public function __construct()
	{
		parent::__construct();
	}

	public function Validators()
	{
		return true;
	}

	public function load($arg)
	{
		$this->args = $arg;
		return true;
	}

























}


