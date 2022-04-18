<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        return redirect()->to('/user/profile');
    }

    public function profile()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $uid = session()->get('uid');
        $data = [
            'title' => "U-Hotel | My Profile",
            'booking_list' => $this->bookingModel->getBookingsByUserId($uid)
        ];

        return view('user/index', $data);
    }

    public function edit()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'title' => "U-Hotel | Edit Profile",
            'validation' => $this->validation,
            'custom_js' => [
                view('custom-js/edit-profile')
            ]
        ];

        return view('user/edit-profile', $data);
    }

    public function password()
    {
        $data = [
            'title' => "U-Hotel | Change Password",
            'validation' => $this->validation
        ];

        return view('user/change-password', $data);
    }

    public function bookings($bookingId = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        if (empty($bookingId)) {
            return redirect()->to('/user/profile');
        }

        $booking = $this->bookingModel->getBookingDetailsByBookingId($bookingId);

        if (empty($booking)) {
            return redirect()->to('/user/profile');
        }

        if (session()->get('uid') !== $booking['user_id']) {
            // unauthorized access to booking details
            return redirect()->to('/user/profile');

        }
        $withDeleted = true;
        $hotel = $this->hotelModel->getHotelById($booking['hotel_id'], $withDeleted);

        $data = [
            'title' => "U-Hotel | Booking Details - #{$booking['booking_id']}",
            'booking' => $booking,
            'hotel' => $hotel
        ];

        return view('user/booking-details', $data);
    }

    /**
     * * Handle edit user profile request
     */
    public function editProfile()
    {
        $rules = [
            'full_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Full name is required'
                ]
            ],
            'birth_date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Birth date is required'
                ]
            ],
            'phone_number' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Phone number is required'
                ]
            ],
            'gender' => [
                'rules' => 'required|in_list[M,F]',
                'errors' => [
                    'required' => 'Gender is required',
                    'in_list' => 'Choose Male/Female'
                ]
            ],
            'user_avatar' => [
                'rules' => 'max_size[user_avatar,3072]|is_image[user_avatar]|mime_in[user_avatar,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'Image size is too large. Max 3 MB',
                    'is_image' => 'Please choose an image',
                    'mime_in' => 'Please choose an image'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/user/profile/edit')->withInput();
        }

        // Format phone number from +62 012 3456 7890 to 6201234567890
        $phoneNumber = htmlspecialchars(str_replace([' ', '_', '+'], '', $this->request->getPost('phone_number')), ENT_QUOTES, 'UTF-8');

        $oldPhoneNumber = '62' . htmlspecialchars($this->request->getPost('old_phone_number'), ENT_QUOTES, 'UTF-8');

        // Check if user change the phone number
        if ($phoneNumber !== $oldPhoneNumber) {
            // Check if phone number already exist
            $user = $this->userModel->getUserByPhoneNumber($phoneNumber);

            if (!is_null($user)) {
                session()->setFlashdata('sweet-alert-error', 'Phone number already used.');

                return redirect()->to('/user/profile/edit')->withInput();
            }
        } else {
            $phoneNumber = $oldPhoneNumber;
        }

        // Handle avatar image
        $image = $this->request->getFile('user_avatar');
        $oldImage = $this->request->getPost('old_user_avatar');

        if ($image->getError() == 4) {
            // if no image uploaded, use old image
            $imageName = $oldImage;
        } else {
            // image uploaded
            $imageName = $image->getRandomName();
            $image->move('assets/img/user-profile', $imageName);

            if (strpos($oldImage, 'placeholder') === false) {
                unlink('assets/img/user-profile/' . $oldImage);
            }
        }

        $uid = htmlspecialchars($this->request->getPost('uid'), ENT_QUOTES, 'UTF-8');
        $user = $this->userModel->getUserByUid($uid);

        if (is_null($user)) {
            session()->setFlashdata('sweet-alert-error', 'Oops! something went wrong.');

            return redirect()->to('/user/profile/edit')->withInput();
        }

        $data = [
            'id' => $user['id'],
            'fullName' => htmlspecialchars($this->request->getPost('full_name'), ENT_QUOTES, 'UTF-8'),
            'birthDate' => htmlspecialchars($this->request->getPost('birth_date'), ENT_QUOTES, 'UTF-8'),
            'phoneNumber' => $phoneNumber,
            'gender' => htmlspecialchars($this->request->getPost('gender'), ENT_QUOTES, 'UTF-8'),
            'avatar' => $imageName
        ];

        $this->userModel->updateUserDetails($data);
        $user = $this->userModel->getUserByUid($uid);

        // update session
        $user_session = [
            'uid' => $user['uid'],
            'role_id' => $user['role_id'],
            'nickname' => explode(' ', $user['full_name'])[0],
            'full_name' => $user['full_name'],
            'email' => $user['email'],
            'birth_date' => $user['birth_date'],
            'phone_number' => substr($user['phone_number'], 2),
            'gender' => ($user['gender'] === 'M') ? 'Male' : 'Female',
            'avatar' => $user['avatar'],
            'created_at' => $user['created_at'],
            'updated_at' => $user['updated_at'],
            'logged_in' => TRUE
        ];

        foreach ($user_session as $key => $value ) {
            session()->set($key, $value);
        }

        return redirect()->to('/user/profile');
    }

    /**
     * * Handle change password request
     */
    public function changePassword()
    {
        $changePassRules = [
            'old_password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Old password is required'
                ]
            ],
            'new_password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'New password is required',
                    'min_length' => 'New password must be at least 8 characters long'
                ]
            ],
            'confirm_new_password' => [
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => 'Confirm new password is required',
                    'matches' => 'New password does not match'
                ]
            ],
        ];

        if (!$this->validate($changePassRules)) {
            return redirect()->to('/user/profile/change-password')->withInput();
        }

        $uid = htmlspecialchars($this->request->getPost('uid'), ENT_QUOTES, 'UTF-8');
        $user = $this->userModel->getUserByUid($uid);

        if (is_null($user)) {
            session()->setFlashdata('sweet-alert-error', 'Oops! Something went wrong.');

            return redirect()->to('/user/profile/change-password')->withInput();
        }

        $oldPassword = $this->request->getPost('old_password');
        if (!password_verify($oldPassword, $user['password'])) {
            session()->setFlashdata('sweet-alert-error', 'Old password incorrect.');

            return redirect()->to('/user/profile/change-password')->withInput();
        }

        $data = [
            'id' => $user['id'],
            'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT)
        ];

        $this->userModel->updateUserPassword($data);

        return redirect()->to('/auth/logout');
    }
}
