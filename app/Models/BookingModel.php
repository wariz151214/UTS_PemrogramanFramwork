<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'hotel_bookings';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'user_id',
        'booking_id',
        'hotel_id',
        'full_name',
        'phone_number',
        'email',
        'number_of_rooms',
        'duration',
        'check_in',
        'check_out',
        'price_per_day',
        'total_price'
    ];

    public function getAllBooking()
    {
        return $this->findAll();
    }

    public function getBookingId($bookingId)
    {
        return $this->where(['booking_id' => $bookingId])->first();
    }

    public function getBookingDetailsByBookingId($bookingId)
    {
        return $this->where(['booking_id' => $bookingId])->first();
    }

    public function getBookingsByUserId($user_id)
    {
        /**
         * SELECT hb.*, hl.name AS hotel_name
         * FROM hotel_bookings hb
         * INNER JOIN hotel_list hl ON hb.hotel_id = hl.id
         * WHERE user_id = $user_id;
         */
        return $this->select('hotel_bookings.*, hotel_list.name AS hotel_name')
            ->join('hotel_list', 'hotel_bookings.hotel_id = hotel_list.id')
            ->where(['user_id' => $user_id])
            ->findAll();
    }

    public function insertNewBooking($data)
    {
        $this->save([
            'user_id' => $data['user_id'],
            'booking_id' => $data['booking_id'],
            'hotel_id' => $data['hotel_id'],
            'full_name' => $data['full_name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'number_of_rooms' => $data['number_of_rooms'],
            'duration' => $data['duration'],
            'check_in' => $data['check_in'],
            'check_out' => $data['check_out'],
            'price_per_day' => $data['price_per_day'],
            'total_price' => $data['total_price']
        ]);
    }

    public function getTotalIncome()
    {
        return $this->selectSum('total_price')->first();
    }

    public function countBooking()
    {
        return $this->countAll();
    }
}
