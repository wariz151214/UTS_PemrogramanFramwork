<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
	public function index()
	{
		// check user role before redirecting
		switch (session()->get('role_id')) {
			case 'R0001':
				return $this->admin();
			case 'R0002':
				return redirect()->to('/');
			default:
				return redirect()->to('/auth/login');
		};
	}

	/**
	 * * Dashboard Admin page
	 */
	private function admin()
	{
		$totalIncome = $this->bookingModel->getTotalIncome()['total_price'];

		if (empty($totalIncome)) {
			$totalIncome = 0;
		}

		$data = [
			'title' => "U-Hotel | Dashboard - Home",
			'sidebar_title' => "U-Hotel",
			'total_income' => $totalIncome,
			'total_booking' => $this->bookingModel->countBooking(),
			'user_count' => $this->userModel->countUser(),
			'booking_list' => $this->bookingModel->getAllBooking(),
			'custom_js' => [
				view('custom-js/admin-index')
			]
		];

		return view('dashboard/index', $data);
	}

	public function hotelList()
	{
		$data = [
			'title' => "U-Hotel | Dashboard - Hotel List",
			'sidebar_title' => "U-Hotel",
			'hotel_list' => $this->hotelModel->getAllHotel(),
			'custom_js' => [
				view('custom-js/admin-hotels')
			]
		];

		return view('dashboard/hotel-list', $data);
	}

	public function addHotel()
	{
		$data = [
			'title' => "U-Hotel | Dashboard - Add Hotel",
			'sidebar_title' => "U-Hotel",
			'facilities' => $this->facilityModel->getAllFacility(),
			'validation' => $this->validation,
			'custom_js' => [
				view('custom-js/admin-cu-hotel')
			]
		];

		return view('dashboard/add-hotel', $data);
	}

	public function editHotelPost()
	{
		$hotel_id = htmlspecialchars($this->request->getPost('hotel_id'), ENT_QUOTES, 'UTF-8');
		$hotel = $this->hotelModel->getHotelById($hotel_id);
		$hotel_facility = explode(',', $hotel['facilities']);

		$data = [
			'title' => "U-Hotel | Dashboard - Edit Hotel",
			'sidebar_title' => "U-Hotel",
			'hotel' => $hotel,
			'hotel_facility' => $hotel_facility,
			'facilities' => $this->facilityModel->getAllFacility(),
			'validation' => $this->validation,
			'custom_js' => [
				view('custom-js/admin-cu-hotel')
			]
		];

		return view('dashboard/edit-hotel', $data);
	}

	public function editHotelGet()
	{
		if (empty(old('hotel_id'))) {
			return redirect()->to('/dashboard/hotels');
		}

		$hotel = $this->hotelModel->getHotelById(old('hotel_id'));
		$hotel_facility = explode(',', $hotel['facilities']);

		$data = [
			'title' => "U-Hotel | Dashboard - Edit Hotel",
			'sidebar_title' => "U-Hotel",
			'hotel' => $hotel,
			'hotel_facility' => $hotel_facility,
			'facilities' => $this->facilityModel->getAllFacility(),
			'validation' => $this->validation,
			'custom_js' => [
				view('custom-js/admin-cu-hotel')
			]
		];

		return view('dashboard/edit-hotel', $data);
	}

	/**
	 * * Handle add new hotel request
	 */
	public function newHotel()
	{
		$rules = [
			'hotel_name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Hotel Name is required'
				]
			],
			'star_rating' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Star Rating is required'
				]
			],
			'hotel_facilities' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Hotel Facilities is required'
				]
			],
			'hotel_room_amount' => [
				'rules' => 'required|numeric|max_length[10]',
				'errors' => [
					'required' => 'Number of Rooms is required',
					'numeric' => 'Must be a number',
					'max_length' => 'Number is too long'
				]
			],
			'hotel_price_per_day' => [
				'rules' => 'required|numeric|greater_than[0]|max_length[20]',
				'errors' => [
					'required' => 'Price Per Day is required',
					'numeric' => 'Must be a number',
					'greater_than' => 'Must be greater than 0',
					'max_length' => 'Number is too long'
				]
			],
			'hotel_address' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Hotel Address is required'
				]
			],
			'hotel_city' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'City is required'
				]
			],
			'hotel_province' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Province is required'
				]
			],
			'hotel_postal_code' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Postal Code is required'
				]
			],
			'hotel_description' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Hotel Description is required'
				]
			],
			'hotel_image' => [
				'rules' => 'max_size[hotel_image,3072]|is_image[hotel_image]|mime_in[hotel_image,image/png,image/jpg,image/jpeg]',
				'errors' => [
					'max_size' => 'Image size is too large. Max 3 MB',
					'is_image' => 'Please choose an image',
					'mime_in' => 'Please choose an image'
				]
			]
		];

		if (!$this->validate($rules)) {
			return redirect()->to('/dashboard/hotels/add')->withInput();
		}

		// Handle hotel image
		$image = $this->request->getFile('hotel_image');

		if ($image->getError() == 4) {
			// if no image uploaded
			$imageName = 'placeholder.png';
		} else {
			// image uploaded
			$imageName = $image->getRandomName();
			$image->move('assets/img/hotels', $imageName);
		}

		// post data
		$hotelName = htmlspecialchars($this->request->getPost('hotel_name'), ENT_QUOTES, 'UTF-8');
		$hotelStarRating = htmlspecialchars($this->request->getPost('star_rating'), ENT_QUOTES, 'UTF-8');
		$hotelFacilities = $this->request->getPost('hotel_facilities');
		$hotelRoomAmount = htmlspecialchars($this->request->getPost('hotel_room_amount'), ENT_QUOTES, 'UTF-8');
		$hotelPrice = htmlspecialchars($this->request->getPost('hotel_price_per_day'), ENT_QUOTES, 'UTF-8');
		$hotelAddress = htmlspecialchars($this->request->getPost('hotel_address'), ENT_QUOTES, 'UTF-8');
		$hotelCity = htmlspecialchars($this->request->getPost('hotel_city'), ENT_QUOTES, 'UTF-8');
		$hotelProvince = htmlspecialchars($this->request->getPost('hotel_province'), ENT_QUOTES, 'UTF-8');
		$hotelPostalCode = htmlspecialchars($this->request->getPost('hotel_postal_code'), ENT_QUOTES, 'UTF-8');
		$hotelDescription = htmlspecialchars($this->request->getPost('hotel_description'), ENT_QUOTES, 'UTF-8');

		$data = [
			'name' => $hotelName,
			'star_rating' => $hotelStarRating,
			'number_of_rooms' => $hotelRoomAmount,
			'price_per_day' => $hotelPrice,
			'address' => $hotelAddress,
			'city' => $hotelCity,
			'province' => $hotelProvince,
			'postal_code' => $hotelPostalCode,
			'description' => $hotelDescription,
			'image' => $imageName
		];

		$currentInsertId = $this->hotelModel->insertNewHotel($data);

		foreach ($hotelFacilities as $i => $facilityId) {
			$facilities[$i]['hotel_id'] = $currentInsertId;
			$facilities[$i]['facility_id'] = $facilityId;
		}

		$this->hotelFacilityModel->insertHotelFacility($facilities);

		session()->setFlashdata('sweet-alert-success', 'Added hotel successfully.');

		return redirect()->to('/dashboard/hotels');
	}

	/**
	 * * Handle edit hotel request
	 */
	public function updateHotel()
	{
		$rules = [
			'hotel_name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Hotel Name is required'
				]
			],
			'star_rating' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Star Rating is required'
				]
			],
			'hotel_facilities' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Hotel Facilities is required'
				]
			],
			'hotel_room_amount' => [
				'rules' => 'required|numeric|max_length[10]',
				'errors' => [
					'required' => 'Number of Rooms is required',
					'numeric' => 'Must be a number',
					'max_length' => 'Number is too long'
				]
			],
			'hotel_price_per_day' => [
				'rules' => 'required|numeric|greater_than[0]|max_length[20]',
				'errors' => [
					'required' => 'Price Per Day is required',
					'numeric' => 'Must be a number',
					'greater_than' => 'Must be greater than 0',
					'max_length' => 'Number is too long'
				]
			],
			'hotel_address' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Hotel Address is required'
				]
			],
			'hotel_city' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'City is required'
				]
			],
			'hotel_province' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Province is required'
				]
			],
			'hotel_postal_code' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Postal Code is required'
				]
			],
			'hotel_description' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Hotel Description is required'
				]
			],
			'hotel_image' => [
				'rules' => 'max_size[hotel_image,3072]|is_image[hotel_image]|mime_in[hotel_image,image/png,image/jpg,image/jpeg]',
				'errors' => [
					'max_size' => 'Image size is too large. Max 3 MB',
					'is_image' => 'Please choose an image',
					'mime_in' => 'Please choose an image'
				]
			]
		];

		if (!$this->validate($rules)) {
			return redirect()->to('/dashboard/hotels/edit')->withInput();
		}

		// Handle hotel image
		$image = $this->request->getFile('hotel_image');
		$oldImage = $this->request->getVar('old_hotel_image');

		if ($image->getError() == 4) {
			// if no image uploaded, use old image
			$imageName = $oldImage;
		} else {
			// image uploaded
			$imageName = $image->getRandomName();
			$image->move('assets/img/hotels', $imageName);

			if (strpos($oldImage, 'placeholder') === false) {
				unlink('assets/img/hotels/' . $oldImage);
			}
		}

		// post data
		$hotelId = htmlspecialchars($this->request->getPost('hotel_id'), ENT_QUOTES, 'UTF-8');
		$hotelName = htmlspecialchars($this->request->getPost('hotel_name'), ENT_QUOTES, 'UTF-8');
		$hotelStarRating = htmlspecialchars($this->request->getPost('star_rating'), ENT_QUOTES, 'UTF-8');
		$hotelFacilities = $this->request->getPost('hotel_facilities');
		$hotelRoomAmount = htmlspecialchars($this->request->getPost('hotel_room_amount'), ENT_QUOTES, 'UTF-8');
		$hotelPrice = htmlspecialchars($this->request->getPost('hotel_price_per_day'), ENT_QUOTES, 'UTF-8');
		$hotelAddress = htmlspecialchars($this->request->getPost('hotel_address'), ENT_QUOTES, 'UTF-8');
		$hotelCity = htmlspecialchars($this->request->getPost('hotel_city'), ENT_QUOTES, 'UTF-8');
		$hotelProvince = htmlspecialchars($this->request->getPost('hotel_province'), ENT_QUOTES, 'UTF-8');
		$hotelPostalCode = htmlspecialchars($this->request->getPost('hotel_postal_code'), ENT_QUOTES, 'UTF-8');
		$hotelDescription = htmlspecialchars($this->request->getPost('hotel_description'), ENT_QUOTES, 'UTF-8');

		$data = [
			'id' => $hotelId,
			'name' => $hotelName,
			'star_rating' => $hotelStarRating,
			'number_of_rooms' => $hotelRoomAmount,
			'price_per_day' => $hotelPrice,
			'address' => $hotelAddress,
			'city' => $hotelCity,
			'province' => $hotelProvince,
			'postal_code' => $hotelPostalCode,
			'description' => $hotelDescription,
			'image' => $imageName
		];

		$this->hotelModel->updateHotel($data);

		foreach ($hotelFacilities as $i => $facilityId) {
			$facilities[$i]['hotel_id'] = $hotelId;
			$facilities[$i]['facility_id'] = $facilityId;
		}

		// Delete the old facility first
		$this->hotelFacilityModel->deleteFacilityByHotelId($hotelId);
		// Then insert the new one
		$this->hotelFacilityModel->insertHotelFacility($facilities);

		session()->setFlashdata('sweet-alert-success', 'Updated hotel successfully.');

		return redirect()->to('/dashboard/hotels');
	}

	/**
	 * * Handle delete hotel request
	 */
	public function deleteHotel($id = null)
	{
		if (empty($id)) {
			return redirect()->to('/dashboard/hotels');
		}

		$hotel = $this->hotelModel->getHotelById($id);
		$hotelId = $hotel['id'];
		$hotelImage = $hotel['image'];

		if (strpos($hotelImage, 'placeholder') === false) {
			/**
			 * if hotel is not using placeholder image
			 * then delete the image from the folder
			 */
			unlink('assets/img/hotels/' . $hotelImage);
		}

		$this->hotelModel->deleteHotel($hotelId);

		session()->setFlashdata('sweet-alert-success', 'Deleted hotel successfully.');

		return redirect()->to('/dashboard/hotels');
	}
}
