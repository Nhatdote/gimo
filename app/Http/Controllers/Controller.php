<?php

namespace App\Http\Controllers;

use App\Exports\ExportCustom;
use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Maatwebsite\Excel\Facades\Excel;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function users() {
        $fields = User::fields();
        $items = User::with('department')->paginate(20);
        $model = 'user';

        return view('render', compact('items', 'fields', 'model'));
    }

    public static function departments() {
        $items = Department::paginate(20);
        $fields = Department::fields();
        $model = 'department';

        return view('render', compact('items', 'fields', 'model'));
    }

    public static function export(Request $request) {
        $object = $request->object;
        $fields = $request->fields;
        $fields = explode(',', $fields);

        if ($object == 'user') {
            $model = User::class;
            $name = 'users.xlsx';
            $items = User::with('department')->get();
        } else {
            $model = Department::class;
            $name = 'departments.xlsx';
            $items = Department::with('parent')->get();
        }

        return Excel::download(new ExportCustom($model, $fields, $items), $name);
    }
}
