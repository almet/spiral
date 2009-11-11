<?php

namespace spiral\framework\di\fixtures;

/**
 * Represent a golden microphone.
 * 
 * @author	Frédéric Sureau <frederic.sureau@gmail.com>
 */
class GoldenMicrophone
{
	public $messages = array();
	
	public function say(Artist $artist, $message)
	{
		$this->messages[] = array('artist'=>$artist, 'message'=>$message);
	}
}
