<?php

namespace App\Repositories;

use App\Http\Controllers\AppBaseController;
use App\Models\Assistant;
use App\Models\ServiceAssistant;
use App\Models\ServiceAssistantCategory;
use DB;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ServicesAssistantRepository
 *
 * @version August 2, 2021, 12:09 pm UTC
 */
class ServicesAssistantRepository extends AppBaseController
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'name',
        'charges',
        'assistants',
        'status',
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
        return ServiceAssistant::class;
    }

    public function store(array $input): bool
    {
        try {
            DB::beginTransaction();

            $input['charges'] = str_replace(',', '', $input['charges']);
            $input['status'] = (isset($input['status'])) ? 1 : 0;
            $services = ServiceAssistant::create($input);
            if (isset($input['assistants']) && ! empty($input['assistants'])) {
                $services->serviceAssistants()->sync($input['assistants']);
            }
            if (isset($input['icon']) && ! empty('icon')) {
                $services->addMedia($input['icon'])->toMediaCollection(ServiceAssistant::ICON, config('app.media_disc'));
            }
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($input, $service): bool
    {
        try {
            DB::beginTransaction();
            $input['charges'] = str_replace(',', '', $input['charges']);
            $input['status'] = (isset($input['status'])) ? 1 : 0;
            $service->update($input);
            $service->serviceAssistants()->sync($input['assistants']);

            if (isset($input['icon']) && ! empty('icon')) {
                $service->clearMediaCollection(ServiceAssistant::ICON);
                $service->media()->delete();
                $service->addMedia($input['icon'])->toMediaCollection(ServiceAssistant::ICON, config('app.media_disc'));
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function prepareData(): array
    {
        $data['serviceCategories'] = ServiceAssistantCategory::orderBy('name', 'ASC')->pluck('name', 'id');
        $data['assistants'] = Assistant::with('user')->get()->where('user.status', true)->pluck('user.full_name', 'id');

        return $data;
    }
}
