<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminAuthentication implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // R001 = Admin role id
        if (session()->get('role_id') !== 'R0001') {
            return redirect()->to('/auth/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
