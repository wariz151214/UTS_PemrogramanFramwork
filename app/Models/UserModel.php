<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user_accounts';
    protected $useTimestamps = true;
    protected $allowedFields = ['uid', 'role_id', 'full_name', 'email', 'password', 'birth_date', 'phone_number', 'gender', 'avatar'];
    private static $role_id = [
        'admin' => 'R0001',
        'user' => 'R0002'
    ];

    public function insertNewUser($data)
    {
        $this->save([
            'uid' => $data['uid'],
            'role_id' => self::$role_id['user'],
            'full_name' => $data['fullName'],
            'email' => $data['email'],
            'password' => $data['password'],
            'birth_date' => $data['birthDate'],
            'phone_number' => $data['phoneNumber'],
            'gender' => $data['gender'],
            'avatar' => $data['avatar']
        ]);
    }

    public function getUserByEmail($email)
    {
        return $this->where(['email' => $email])->first();
    }

    public function getUserByUid($uid)
    {
        return $this->where(['uid' => $uid])->first();
    }

    public function getUserByPhoneNumber($phoneNumber)
    {
        return $this->where(['phone_number' => $phoneNumber])->first();
    }

    public function updateUserDetails($data)
    {
        $this->save([
            'id' => $data['id'],
            'full_name' => $data['fullName'],
            'birth_date' => $data['birthDate'],
            'phone_number' => $data['phoneNumber'],
            'gender' => $data['gender'],
            'avatar' => $data['avatar']
        ]);
    }

    public function updateUserPassword($data)
    {
        $this->save([
            'id' => $data['id'],
            'password' => $data['password']
        ]);
    }

    public function countUser() {
        return $this->countAll();
    }
}
