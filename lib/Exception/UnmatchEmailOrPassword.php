<?php

namespace MyApp\Exception;

class UnmatchEmailOrPassword extends \Exception{
	protected $message = 'Email or Password do not match!'; 
}