<?php

namespace App\Models;

use CodeIgniter\Model;

class HotelModel extends Model
{
    protected $table = 'hotel_list';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $allowedFields = [
        'name',
        'star_rating',
        'number_of_rooms',
        'price_per_day',
        'address',
        'city',
        'province',
        'postal_code',
        'description',
        'image'
    ];

    private static $itemPerPage = 6;

    public function insertNewHotel($data)
    {
        $this->save([
            'name' => $data['name'],
            'star_rating' => $data['star_rating'],
            'number_of_rooms' => $data['number_of_rooms'],
            'price_per_day' => $data['price_per_day'],
            'address' => $data['address'],
            'city' => $data['city'],
            'province' => $data['province'],
            'postal_code' => $data['postal_code'],
            'description' => $data['description'],
            'image' => $data['image']
        ]);

        return $this->insertID();
    }

    public function updateHotel($data)
    {
        $this->save([
            'id' => $data['id'],
            'name' => $data['name'],
            'star_rating' => $data['star_rating'],
            'number_of_rooms' => $data['number_of_rooms'],
            'price_per_day' => $data['price_per_day'],
            'address' => $data['address'],
            'city' => $data['city'],
            'province' => $data['province'],
            'postal_code' => $data['postal_code'],
            'description' => $data['description'],
            'image' => $data['image']
        ]);
    }

    public function deleteHotel($id)
    {
        $this->delete($id);
    }

    public function getAllHotel()
    {
        return $this->findAll();
    }

    public function getAllHotelPaginate()
    {
        return $this->paginate(self::$itemPerPage, 'hotels');
    }

    public function getRandomThreeHotelExcept($id)
    {
        return $this->where('id !=', $id)->orderBy('name', 'RANDOM')->findAll(3);
    }

    public function getRandomHotel($amount = 1) {
        return $this->orderBy('name', 'RANDOM')->findAll($amount);
    }

    public function getHotelById($id, $withDeleted = false)
    {
        /**
         * SELECT hl.*, GROUP_CONCAT(hf.facility_id) AS `facilities`
         * FROM hotel_list hl
         * INNER JOIN hotel_facilities hf ON hl.id = hf.hotel_id
         * WHERE hl.id = $id
         * GROUP BY hf.hotel_id;
         */
        if ($withDeleted) {
            return $this->select('hotel_list.*, GROUP_CONCAT(hotel_facilities.facility_id) AS facilities')
                ->join('hotel_facilities', 'hotel_list.id = hotel_facilities.hotel_id')
                ->groupBy('hotel_facilities.hotel_id')
                ->withDeleted()
                ->find($id);
        }

        return $this->select('hotel_list.*, GROUP_CONCAT(hotel_facilities.facility_id) AS facilities')
            ->join('hotel_facilities', 'hotel_list.id = hotel_facilities.hotel_id')
            ->groupBy('hotel_facilities.hotel_id')
            ->find($id);
    }

    /**
     * * Get list of hotel location based on city
     */
    public function getHotelLocation()
    {
        return $this->select('city')->groupBy('city')->orderBy('city', 'ASC')->findAll();
    }

    /**
     * * Update hotel's number of room based on booking room amount
     */
    public function updateHotelRoomAmount($data)
    {
        $this->save([
            'id' => $data['id'],
            'number_of_rooms' => $data['number_of_rooms']
        ]);
    }

    public function searchHotel($keyword = "", $filters, $withFilter)
    {
        /**
         * SELECT hl.*, GROUP_CONCAT(hf.facility_id) AS `facilities`
         * FROM hotel_list hl
         * INNER JOIN hotel_facilities hf ON hl.id = hf.hotel_id
         * WHERE hl.name LIKE '%%'
         * AND hl.star_rating IN ('5', '4')
         * AND hf.facility_id IN ('F0001', 'F0002', 'F0003', 'F0004', 'F0005', 'F0007')
         * AND hl.price_per_day BETWEEN 1000000 AND 3000000
         * AND hl.city IN ('Denpasar', 'Bandung')
         * GROUP BY hf.hotel_id;
         */

        if ($withFilter) {
            $builder = $this->table('hotel_list');
            $builder->select('hotel_list.*, GROUP_CONCAT(hotel_facilities.facility_id) AS facilities');
            $builder->join('hotel_facilities', 'hotel_list.id = hotel_facilities.hotel_id');
            $builder->like('name', $keyword);

            if (!is_null($filters['hotel_rating'])) {
                $builder->whereIn('star_rating', $filters['hotel_rating']);
            }

            if (!is_null($filters['hotel_facilities'])) {
                $builder->whereIn('hotel_facilities.facility_id', $filters['hotel_facilities']);
            }

            if ($filters['hotel_min_price'] >= 0 && $filters['hotel_max_price'] > 0) {
                $builder->where('price_per_day >=', $filters['hotel_min_price']);
                $builder->where('price_per_day <=', $filters['hotel_max_price']);
            }

            if (!is_null($filters['hotel_location'])) {
                $builder->whereIn('city', $filters['hotel_location']);
            }

            $builder->groupBy('hotel_facilities.hotel_id');

            return $builder->paginate(self::$itemPerPage, 'hotels');
        }

        return $this->like('name', $keyword)->paginate(self::$itemPerPage, 'hotels');
    }
}
