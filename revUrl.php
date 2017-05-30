<?php

file::$methods['revUrl'] = function($file) {
	if ($file) {
		$url = $file->url();
		$hash = substr(md5($file->modified()), 0, 10);
		$pos = strrpos($url, $file->extension());

		return substr_replace($url, '-'. $hash, $pos - 1, 0);
	}
	else{
		return kirby()->site()->errorPage()->url();
	}
};
