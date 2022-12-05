<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KondisiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      switch ($this->value) {
        case '<':
          $name = 'Lower Is Better';
          break;
        
        case '>':
          $name = 'Higher Is Better';
          break;
        
        case 'Optimal':
          $name = 'Optimal';
          break;
        
        default:
          $name = 'Unnamed';
          break;
      }

      return [
        'id' => $this->id,
        'value' => $this->value,
        'name' => $name,
        'condition_formulas' => ConditionFormulaResource::collection($this->whenLoaded('conditionFormulas'))
      ];
    }
}
