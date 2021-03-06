<?php

namespace Partymeister\Core\Transformers;

use League\Fractal;
use Partymeister\Core\Models\Callback;

/**
 * Class CallbackTransformer
 * @package Partymeister\Core\Transformers
 */
class CallbackTransformer extends Fractal\TransformerAbstract
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];


    /**
     * Transform record to array
     *
     * @param Callback $record
     *
     * @return array
     */
    public function transform(Callback $record)
    {
        return [
            'id'   => (int) $record->id,
            'hash' => $record->hash,
            'name' => $record->name
        ];
    }
}
