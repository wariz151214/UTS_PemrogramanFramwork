<?php

namespace App\Controllers;

class About extends BaseController
{
	public function index()
	{
		$data = [
            'title' => "U-Hotel | About"
        ];

		return view('about/index', $data);
	}
}
