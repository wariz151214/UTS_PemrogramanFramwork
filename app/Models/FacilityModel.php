<?php

namespace App\Models;

use CodeIgniter\Model;

class FacilityModel extends Model
{
    protected $table = 'facilities';

    public function getAllFacility()
    {
        return $this->findAll();
    }

    public function getFacilityFromList($array)
    {
        /**
         * SELECT *
         * FROM facilities
         * WHERE facility_id IN $array;
         */
        return $this->whereIn('facility_id', $array)->findAll();
    }
}
