<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\TransactionAssistant;

/**
 * Class RoleRepository
 *
 * @version August 5, 2021, 10:43 am UTC
 */
class TransactionAssistantRepository extends BaseRepository
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
        return TransactionAssistant::class;
    }

    public function show($id): array
    {
        $transaction['data'] = TransactionAssistant::with('user', 'appointment.assistant.user',
            'acceptedPaymentUser')->whereId($id)->first();

        return $transaction;
    }
}
