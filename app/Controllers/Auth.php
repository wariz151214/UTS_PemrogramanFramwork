<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        return redirect()->to('/');
    }

    public function login()
    {
        if ($this->isLoggedIn()) {
            return redirect()->to('/');
        }

        $data = [
            'title' => "U-Hotel | Login",
            'validation' => $this->validation
        ];

        return view('auth/login', $data);
    }

    public function register()
    {
        if ($this->isLoggedIn()) {
            return redirect()->to('/');
        }

        $data = [
            'title' => "U-Hotel | Register",
            'validation' => $this->validation,
            'custom_js' => [
                view('custom-js/auth-register')
            ]
        ];

        return view('auth/register', $data);
    }

    /**
     * * Handle logout request
     */
    public function logout()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('/auth/login');
        }

        session()->destroy();

        return redirect()->to('/');
    }

    /**
     * * Handle login request
     */
    public function doLogin()
    {
        $loginRules = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email Address is required',
                    'valid_email' => 'Email Address is not valid'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password is required'
                ]
            ]
        ];

        if (!$this->validate($loginRules)) {
            return redirect()->to('/auth/login')->withInput();
        }

        // Check if captcha is valid
        $recaptchaResponse = trim($this->request->getPost('g-recaptcha-response'));
        if (!$this->verifyCaptcha($recaptchaResponse)) {
            session()->setFlashdata('sweet-alert-error', 'Captcha Invalid.');
            return redirect()->to('/auth/login')->withInput();
        }

        $data = [
            'email' => htmlspecialchars($this->request->getPost('email'), ENT_QUOTES, 'UTF-8'),
            'password' => $this->request->getPost('password')
        ];

        $user = $this->userModel->getUserByEmail($data['email']);

        if (is_null($user)) {
            session()->setFlashdata('sweet-alert-error', 'Email or password incorrect.');

            return redirect()->to('/auth/login')->withInput();
        }

        if (!password_verify($data['password'], $user['password'])) {
            session()->setFlashdata('sweet-alert-error', 'Email or password incorrect.');

            return redirect()->to('/auth/login')->withInput();
        }

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

        session()->setFlashdata('sweet-alert-success', 'Logged in successfully.');
        session()->set($user_session);

        switch ($user['role_id']) {
            case 'R0001':
                return redirect()->to('/dashboard');
            case 'R0002':
                return redirect()->to('/');
        }
    }

    /**
     * * Handle register request
     */
    public function newUser()
    {
        $registerRules = [
            'full_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Full name is required'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[user_accounts.email]|valid_email',
                'errors' => [
                    'required' => 'Email address is required',
                    'is_unique' => 'Email address already exists',
                    'valid_email' => 'Email address is not valid'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be at least 8 characters long'
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Confirm password is required',
                    'matches' => 'Password does not match'
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

        if (!$this->validate($registerRules)) {
            return redirect()->to('/auth/register')->withInput();
        }

        // Handle avatar image
        $image = $this->request->getFile('user_avatar');

        if ($image->getError() == 4) {
            // if no image uploaded
            $imageName = 'avatar-placeholder.png';
        } else {
            // image uploaded
            $imageName = $image->getRandomName();
            $image->move('assets/img/user-profile', $imageName);
        }

        // Format phone number from +62 012 3456 7890 to 6201234567890
        $phoneNumber = htmlspecialchars(str_replace([' ', '_', '+'], '', $this->request->getPost('phone_number')), ENT_QUOTES, 'UTF-8');

        // Check if phone number already exist
        $user = $this->userModel->getUserByPhoneNumber($phoneNumber);

        if (!is_null($user)) {
            session()->setFlashdata('sweet-alert-error', 'Phone number already used.');

            return redirect()->to('/auth/register')->withInput();
        }

        $data = [
            'uid' => $this->generateUid(),
            'fullName' => htmlspecialchars($this->request->getPost('full_name'), ENT_QUOTES, 'UTF-8'),
            'email' => htmlspecialchars($this->request->getPost('email'), ENT_QUOTES, 'UTF-8'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'birthDate' => htmlspecialchars($this->request->getPost('birth_date'), ENT_QUOTES, 'UTF-8'),
            'phoneNumber' => $phoneNumber,
            'gender' => htmlspecialchars($this->request->getPost('gender'), ENT_QUOTES, 'UTF-8'),
            'avatar' => $imageName
        ];

        session()->setFlashdata('sweet-alert-success', 'Your account has been created.');

        $this->userModel->insertNewUser($data);

        return redirect()->to('/auth/login');
    }

    /**
     * * Google reCAPTCHA
     */
    private function verifyCaptcha($recaptchaResponse)
    {
        // reCAPTCHA config
        $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify";
        $secret = getenv('RECAPTCHA_SECRET_KEY');

        $credentials = [
            'secret' => $secret,
            'response' => $recaptchaResponse
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $recaptchaUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($credentials));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response, true);

        return $response['success'];
    }

    /**
     * * Generate random uid
     */
    private function generateUid()
    {
        // Loop generate random alphanumeric string
        while (true) {
            $uid = random_string('alnum', 12);
            $result = $this->userModel->getUserByUid($uid);

            if (is_null($result)) {
                // no record found, then no duplicate uid found
                return $uid;
            }
        }
    }

    /**
     * * Check if user already logged in
     */
    private function isLoggedIn()
    {
        return session()->get('logged_in');
    }
}
