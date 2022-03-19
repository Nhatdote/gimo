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
use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Facades\Excel;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function index()
    {
        Config::set('gimo.crumbs', [
            ['url' => route('index'), 'label' => __('Home'), 'icon' => 'home']
        ]);


        return view('index');
    }

    public static function users(Request $request)
    {
        Config::set('gimo.crumbs', [
            ['url' => route('index'), 'label' => __('Home'), 'icon' => 'home'],
            ['label' => __('Users'), 'icon' => 'people']
        ]);


        $fields = User::fields();
        $items = User::with('department');
        $model = 'user';

        if ($request->ajax && $request->filter) {
            $filters = $request->except('ajax', 'filter');
            $items = $items->filters($filters)->paginate(20);

            $html = view('list', compact('items', 'fields'))->render();

            return response()->json([
                'status' => 1,
                'html' => $html
            ]);
        }

        $items = $items->paginate(20);

        return view('render', compact('items', 'fields', 'model'));
    }

    public static function departments(Request $request)
    {
        Config::set('gimo.crumbs', [
            ['url' => route('index'), 'label' => __('Home'), 'icon' => 'home'],
            ['label' => __('Departments'), 'icon' => 'layers-outline']
        ]);


        $items = Department::with('parent');
        $fields = Department::fields();
        $model = 'department';

        if ($request->ajax && $request->filter) {
            $filters = $request->except('ajax', 'filter');
            $items = $items->filters($filters)->paginate(20);

            $html = view('list', compact('items', 'fields'))->render();

            return response()->json([
                'status' => 1,
                'html' => $html
            ]);
        }

        $items = $items->paginate(20);

        return view('render', compact('items', 'fields', 'model'));
    }

    public static function export(Request $request)
    {
        $object = $request->object;
        $fields = $request->fields;
        $fields = explode(',', $fields);

        if ($object == 'user') {
            $model = User::class;
            $name = 'users.xlsx';
            $items = User::with('department')->filters($request->all())->get();
        } else {
            $model = Department::class;
            $name = 'departments.xlsx';
            $items = Department::with('parent')->filters($request->all())->get();
        }

        return Excel::download(new ExportCustom($model, $fields, $items), $name);
    }
}
