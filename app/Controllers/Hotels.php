<?php

namespace App\Controllers;

class Hotels extends BaseController
{
    public function index()
    {
        $hotelRating = $this->request->getGet('rating');
        $hotelFacilities = $this->request->getGet('facility');
        $hotelMinPrice = intval(htmlspecialchars($this->request->getGet('min_price'), ENT_QUOTES, 'UTF-8'));
        $hotelMaxPrice = intval(htmlspecialchars($this->request->getGet('max_price'), ENT_QUOTES, 'UTF-8'));
        $hotelLocation = $this->request->getGet('location');

        // * Filter
        $filters = [
            'hotel_rating' => $hotelRating,
            'hotel_facilities' => $hotelFacilities,
            'hotel_min_price' => $hotelMinPrice,
            'hotel_max_price' => $hotelMaxPrice,
            'hotel_location' => $hotelLocation
        ];

        // check if filters array element contains any value
        if (array_filter($filters)) {
            // if so, then user is applying a filter
            $withFilter = true;
        } else {
            // user not applying any filter
            $withFilter = false;
        }

        // * Search
        $searchKeyword = htmlspecialchars($this->request->getGet('search'), ENT_QUOTES, 'UTF-8');

        if ($searchKeyword || $withFilter) {
            $hotelList = $this->hotelModel->searchHotel($searchKeyword, $filters, $withFilter);
        } else {
            $hotelList = $this->hotelModel->getAllHotelPaginate();
        }

        $data = [
            'title' => "U-Hotel | Hotels",
            'custom_css' => [
                view('custom-css/list-hotel')
            ],
            'custom_js' => [
                view('custom-js/list-hotel')
            ],
            'hotel_list' => $hotelList,
            'hotel_location' => $this->hotelModel->getHotelLocation(),
            'facilities' => $this->facilityModel->getAllFacility(),
            'pager' => $this->hotelModel->pager
        ];

        return view('hotel/list-hotel', $data);
    }

    public function detail($id = null)
    {
        // return if id is not provided
        if (empty($id)) {
            return redirect()->to('/hotels');
        }

        $hotel = $this->hotelModel->getHotelById($id);

        if (empty($hotel)) {
            return redirect()->to('/hotels');
        }

        $facilityList = explode(',', $hotel['facilities']);

        $data = [
            'title' => "U-Hotel | {$hotel['name']}",
            'hotel' => $hotel,
            'facilities' => $this->facilityModel->getFacilityFromList($facilityList),
            'hotel_list' => $this->hotelModel->getRandomThreeHotelExcept($id)
        ];

        return view('hotel/hotel-details', $data);
    }

    public function bookingPost()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $hotel_id = htmlspecialchars($this->request->getPost('hotel_id'), ENT_QUOTES, 'UTF-8');
        $data = [
            'title' => "U-Hotel | Booking",
            'validation' => $this->validation,
            'custom_js' => [
                view('custom-js/booking-hotel')
            ],
            'hotel' => $this->hotelModel->getHotelById($hotel_id)
        ];

        return view('hotel/booking', $data);
    }

    public function bookingGet()
    {
        if (empty(old('hotel_id'))) {
            return redirect()->to('/hotels');
        }

        $data = [
            'title' => "U-Hotel | Booking",
            'validation' => $this->validation,
            'custom_js' => [
                view('custom-js/booking-hotel')
            ],
            'hotel' => $this->hotelModel->getHotelById(old('hotel_id'))
        ];

        return view('hotel/booking', $data);
    }

    /**
     * * Handle hotel booking request
     */
    public function newBooking()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $bookingRules = [
            'full_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Full Name is required',
                ]
            ],
            'phone_number' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Phone Number is required'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email Address is required',
                    'valid_email' => 'Email Address is not valid'
                ]
            ],
            'room_amount' => [
                'rules' => 'required|numeric|greater_than[0]|max_length[10]',
                'errors' => [
                    'required' => 'Room amount required',
                    'numeric' => 'Must be a number',
                    'greater_than' => 'Must be greater than 0',
                    'max_length' => 'Number is too long'
                ]
            ],
        ];

        if (!$this->validate($bookingRules)) {
            return redirect()->to('/hotels/booking')->withInput();
        }

        $hotel_id = htmlspecialchars($this->request->getPost('hotel_id'), ENT_QUOTES, 'UTF-8');
        $hotel = $this->hotelModel->getHotelById($hotel_id);

        if (empty($hotel)) {
            return redirect()->to('/hotels');
        }

        // retrieve POST data
        $uid = htmlspecialchars($this->request->getPost('uid'), ENT_QUOTES, 'UTF-8');
        $fullName = htmlspecialchars($this->request->getPost('full_name'), ENT_QUOTES, 'UTF-8');
        // Format phone number from +62 012 3456 7890 to 6201234567890
        $phoneNumber = htmlspecialchars(str_replace([' ', '_', '+'], '', $this->request->getPost('phone_number')), ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($this->request->getPost('email'), ENT_QUOTES, 'UTF-8');
        $numberOfRooms = htmlspecialchars($this->request->getPost('room_amount'), ENT_QUOTES, 'UTF-8');
        $checkInDate = htmlspecialchars($this->request->getPost('check_in'), ENT_QUOTES, 'UTF-8');
        $checkOutDate = htmlspecialchars($this->request->getPost('check_out'), ENT_QUOTES, 'UTF-8');
        $totalPrice = htmlspecialchars($this->request->getPost('total_price'), ENT_QUOTES, 'UTF-8');

        // Validate hotel capacity to room amount requested by user
        if ($numberOfRooms > $hotel['number_of_rooms']) {
            session()->setFlashdata('sweet-alert-error', 'Hotel room capacity is full.');

            return redirect()->to('/hotels/booking')->withInput();
        }

        // Validate check-in check-out date
        if (date_create($checkInDate) > date_create($checkOutDate)) {
            session()->setFlashdata('sweet-alert-error', 'Check-in date exceeding the check-out date.');

            return redirect()->to('/hotels/booking')->withInput();
        }

        // Get booking duration in days
        $duration = date_diff(date_create($checkInDate), date_create($checkOutDate))->format('%a');
        $duration = ($duration > 0) ? $duration : 1;
        $bookingId = $this->generateBookingId();

        $bookingData = [
            'user_id' => $uid,
            'booking_id' => $bookingId,
            'hotel_id' => $hotel['id'],
            'full_name' => $fullName,
            'phone_number' => $phoneNumber,
            'email' => $email,
            'number_of_rooms' => $numberOfRooms,
            'duration' => $duration,
            'check_in' => $checkInDate,
            'check_out' => $checkOutDate,
            'price_per_day' => $hotel['price_per_day'],
            'total_price' => $totalPrice
        ];

        session()->setFlashdata('sweet-alert-success', 'Booked successfully.');
        $this->bookingModel->insertNewBooking($bookingData);

        $this->hotelModel->updateHotelRoomAmount([
            'id' => $hotel['id'],
            'number_of_rooms' => $hotel['number_of_rooms'] - $numberOfRooms
        ]);

        return redirect()->to('/user/booking-details/' . $bookingId);
    }

    /**
     * * Generate random booking id
     */
    private function generateBookingId()
    {
        // Loop generate random numeric string
        while (true) {
            $bookingId = random_string('numeric', 11);
            $result = $this->bookingModel->getBookingId($bookingId);

            if (is_null($result)) {
                // no record found, then no duplicate booking id found
                return $bookingId;
            }
        }
    }
}
