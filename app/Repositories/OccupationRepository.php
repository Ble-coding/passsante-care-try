<?php

namespace App\Repositories;

use App\Models\Occupation;

/**
 * Class SpecializationRepository
 *
 * @version August 2, 2021, 10:19 am UTC
 */
class OccupationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
    ];

    /**
     * Return searchable fields
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Occupation::class;
    }
}
