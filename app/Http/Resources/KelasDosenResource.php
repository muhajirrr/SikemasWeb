<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KelasDosenResource extends JsonResource
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
            'nama' => $this->nama,
            'mata_kuliah' => $this->mata_kuliah,
            'dosen' => $this->dosen,
            'jadwal' => $this->jadwal,
            'ruangan' => $this->ruangan,
            'status' => $this->status,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->update_at,
        ];
    }
}
