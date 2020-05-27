<?php

namespace App\Http\Guards;

use Base\Authenticable as auth;
use Base\BaseController as base; 

class CheckGuest
{
	public function __construct()
	{
		$auth = new auth;
		if($auth->check()){
			base::redirect('admin/members/all');
		}
	}

}