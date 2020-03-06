<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Test extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->kota,
            'latitude' => $this->lat,
            'longitude' => $this->lng,
            'zone' => $this->cekzone($this->prov),
        ];
    }

    private function cekzone($prov)
    {
        $wib = [ "Aceh", "Sumatera Utara", "Sumatera Barat", "Riau", "Kepulauan Riau (Kepri)", "Jambi", "Sumatera Selatan", "Lampung", "Bangka Belitung", "Bengkulu", "Jakarta", "Jawa Barat", "Banten", "Jawa Tengah", "Yogyakarta", "Jawa Timur", "Kalimantan Barat", "Kalimantan Tengah" ];
        $wita = ["Kalimantan Utara","Kalimantan Timur","Kalimantan Selatan","Bali","Nusa Tenggara Barat","Nusa Tenggara Timur","Sulawesi Barat","Sulawesi Tengah","Sulawesi Selatan","Sulawesi Tenggara","Sulawesi Utara","Gorontalo"];
        $wit = ["Maluku","Maluku Utara","Papua","Papua Barat"];

        if (in_array($prov, $wib)) { return 7; }
        elseif (in_array($prov, $wita)) { return 8; }
        elseif (in_array($prov, $wit)) { return 9; }
        else { return 7; }
    }
}
