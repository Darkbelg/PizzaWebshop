<?php

	/**
	 * Created by PhpStorm.
	 * User: cyber09
	 * Date: 17/05/2017
	 * Time: 11:31
	 */
	class NotANumberException extends Exception
	{
		public function __construct($message = "", $code = 0, Throwable $previous = null)
		{
			parent::__construct($message, $code, $previous);
		}

	}