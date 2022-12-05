<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RealizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        switch ($this->status) {
            case 1:
                $this->status = 'Menunggu';
                break;

            case 2:
                $this->status = 'Disetujui';
                break;

            case 3:
                $this->status = 'Ditolak';
                break;
            
            default:
                $this->status = 'Draf';
                break;
        }

        // $realization = (float) $this->realization;

        // $bobot = (float) $this->additional['bobot'];
        // $target = (float) $this->additional['target'];

        // $ach =  ($realization / $target);

        // $formula = [
        //     'lower_is_better' => $ach > (105/100) ? 4 : ($ach >= (100/100) ? 3 : ($ach >= (90/100) ? 2 : 1)),
        //     'higher_is_better' => $ach > (105/100) ? 1 : ($ach >= (100/100) ? 2 : ($ach >= (90/100) ? 3 : 4)),

        //     'optimal' => '',
        //     'special_case' => '',
        //     'unknown' => 0
        // ];

        // $kondisi = $this->additional['parameter_kondisi'];

        // switch ($kondisi) {
        //     case '<':
        //         $score = $formula['lower_is_better'];
        //         break;
            
        //     case '>':
        //         $score = $formula['higher_is_better'];
        //         break;

        //     default:
        //         $score = null;
        //         break;
        // }

        // $score_x_bobot = (($score * $bobot) / 10);

        // $total = !is_null($score) ? $score_x_bobot : 'unknown score!';

        return [
            'id' => (integer) $this->id,
            'target_id' => (integer) $this->target_id,
            'quarter' => (integer) $this->quarter,
            
            // 'parameter_kondisi' => $kondisi,

            'realization' => $this->realization,
            'score' => $this->score,
            'score_x_bobot' => $this->score_x_bobot,

            'status' => $this->status,
            'evidence' => new RealizationEvidenceResource($this->whenLoaded('evidence')),
            'change_request' => new RealizationChangeRequestResource($this->whenLoaded('changeRequest')),
            'pica' => new RealizationPicaResource($this->whenLoaded('pica'))
        ];
    }
}
