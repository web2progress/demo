<?php

namespace App\Exports;

use App\Models\NewsLatter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class NewsLatterExport implements FromCollection,WithHeadings
{
    public function headings():array{
          return[
              'id',
              'email',
              'created_at'
          ];
        }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return NewsLatter::all();
        return collect(NewsLatter::getNewsLatter());
    }
}
