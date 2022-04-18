<?php

namespace App\Models;

use CodeIgniter\Model;

class HotelFacilityModel extends Model
{
    protected $table = 'hotel_facilities';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'hotel_id',
        'facility_id'
    ];

    public function insertHotelFacility($data)
    {
        $this->insertBatch($data);
    }

    public function deleteFacilityByHotelId($hotelId)
    {
        $this->where('hotel_id', $hotelId)->delete();
    }
}
