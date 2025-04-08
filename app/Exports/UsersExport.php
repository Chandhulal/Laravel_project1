<?php

namespace App\Exports;

use App\Models\Course;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Course::select('name','course_id','semester','status')->get();
    // }

    // public function headings(): array
    // {
    //     return [
    //         'name',
    //         'course_id',
    //         'semester',
    //         'status',
    //     ];
    // }

    public function view(): View
    {
        return view('templates.export_course', [
            'course' => Course::all()
        ]);
    }
}
