<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = [
            'title' => "U-Hotel",
			'hotels' => $this->hotelModel->getRandomHotel(4),
        ];

		return view('home/index', $data);
	}
}
