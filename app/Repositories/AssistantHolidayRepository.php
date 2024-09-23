<?php

namespace App\Repositories;

use App\Models\AssistantHoliday;
use Illuminate\Http\RedirectResponse;

/** 
 * Class CityRepository
 *
 * @version July 31, 2021, 7:41 am UTC
 */
class AssistantHolidayRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'assistant_id',
        'date',
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
        return AssistantHoliday::class;
    }

    public function store($input) 
    {
        $assistant_holiday = AssistantHoliday::where('assistant_id', $input['assistant_id'])->where('date',
            $input['date'])->exists();

        if (! $assistant_holiday) {
            AssistantHoliday::create($input);

            return true;
        } else {
            return false;
        }
    }
}
