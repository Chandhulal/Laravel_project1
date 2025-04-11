<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Can;
use Spatie\Permission\Traits\HasRoles;
use App\Imports\UserImport;
use App\Imports\UsersImport;
use App\Models\Status;
use Maatwebsite\Excel\Facades\Excel;

use function Laravel\Prompts\error;

class CourseController extends Controller
{
    use HasRoles;
    //
    public function __construct()
    {
        $this->middleware('permission:view course', ['only' => ['show']]);
        $this->middleware('permission:add course', ['only' => ['store']]);
        $this->middleware('permission:edit course', ['only' => ['edit']]);
        $this->middleware('permission:delete course', ['only' => ['destroy']]);
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = Course::all();
            return response()->json([
                $data,
            ]);
        }
        $data = Course::all();
        return view('components.course_table_layout_final', ['datas' => $data]);
    }

    public function store()
    {
        if (request()->ajax()) {
            $users = Course::create([
                "name" => request()->course_name,
                "course_id" => request()->course_id,
                "semester" => request()->semester,
                "status_id" => request()->status,
                
            ]);
            $data = Course::find($users->id);
            $status = $data->status->status;
            return response()->json([
                $users,
                $status,
            ]);
        }
    }

    public function edit($id)
    {
        $data = Course::find($id);
        $data['name'] = request()->edit_name;
        $data['course_id'] = request()->edit_id;
        $data['semester'] = request()->edit_semester;
        $data->save();

        return response()->json([
            $data,
        ]);
    }

    public function destroy($id)
    {
        $data = Course::find($id);
        $data->delete();
        return response()->json([
            'deleted',
        ]);
    }

    public function search_data()
    {
        if (request()->ajax()) {
            $datas = Course::where('name', 'LIKE', '%' . request()->search . '%')->get();
            return response()->json([
                $datas,
            ]);
        }
    }

    public function name_ascending()
    {
        if (request()->search && request()->ajax()) {
            $data = Course::where('name', 'LIKE', '%' . request()->search . '%')->orderBy('name', 'ASC')->get();
            return response()->json([
                $data,
            ]);
        }
        $data = Course::orderBy('name', 'ASC')->get();
        return response()->json([
            $data,
        ]);
    }

    public function name_descending()
    {
        if (request()->search && request()->ajax()) {
            $data = Course::where('name', 'LIKE', '%' . request()->search . '%')->orderBy('name', 'DESC')->get();
            return response()->json([
                $data,
            ]);
        }
        $data = Course::orderBy('name', 'DESC')->get();
        return response()->json([
            $data,
        ]);
    }

    public function id_ascending()
    {
        if (request()->search && request()->ajax()) {
            $data = Course::where('name', 'LIKE', '%' . request()->search . '%')->orderBy('course_id', 'ASC')->get();
            return response()->json([
                $data,
            ]);
        }
        $data = Course::orderBy('course_id', 'ASC')->get();
        return response()->json([
            $data,
        ]);
    }

    public function id_descending()
    {
        if (request()->search && request()->ajax()) {
            $data = Course::where('name', 'LIKE', '%' . request()->search . '%')->orderBy('course_id', 'DESC')->get();
            return response()->json([
                $data,
            ]);
        }
        $data = Course::orderBy('course_id', 'DESC')->get();
        return response()->json([
            $data,
        ]);
    }

    public function semester_ascending()
    {
        if (request()->search && request()->ajax()) {
            $data = Course::where('semester', 'LIKE', '%' . request()->search . '%')->orderBy('semester', 'ASC')->get();
            return response()->json([
                $data,
            ]);
        }
        $data = Course::orderBy('semester', 'ASC')->get();
        return response()->json([
            $data,
        ]);
    }

    public function semester_descending()
    {
        if (request()->search && request()->ajax()) {
            $data = Course::where('semester', 'LIKE', '%' . request()->search . '%')->orderBy('semester', 'DESC')->get();
            return response()->json([
                $data,
            ]);
        }
        $data = Course::orderBy('semester', 'DESC')->get();
        return response()->json([
            $data,
        ]);
    }

    public function import_exel()
    {
        Excel::import(new UsersImport, request()->file('import'));
        return back()->with('success', 'File imported successfully');
    }

    public function export_exel()
    {
        return Excel::download(new UsersExport, 'course.xlsx');
    }

    public function show_course_modal()
    {
        $status = Status::all();
        return response()->json([
            $status,
        ]);
    }
}
