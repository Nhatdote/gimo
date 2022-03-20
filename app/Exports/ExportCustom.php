<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExportCustom implements FromArray, WithHeadings, ShouldAutoSize
{
    protected $model;
    protected $fields;
    protected $items;
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($model, $fields, $items)
    {
        $this->model = $model;
        $this->fields = $fields;
        $this->items = $items;
    }

    public function array(): array
    {
        $model = $this->model;
        $sort = $this->fields;
        $items = $this->items;
        $fields = $model::fields();


        $rows = [];
        foreach ($items as $item) {
            $row = [];

            foreach ($sort as $f) {
                $config = $fields[$f];

                if (!empty($config['display'])) {
                    $row[] = $item[$config['display']];
                } else {
                    $row[] = $item->$f;
                }
            }

            $rows[] = $row;
        }

        return $rows;
    }

    public function headings(): array
    {
        $data = [];
        $items = $this->model::fields();

        foreach ($this->fields as $f) {
            $data[] = $items[$f]['label'] ?? $f;
        }

        return $data;
    }
}
