<?php

namespace App\Imports;

use App\Models\Course;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $course = Course::where('course_id', $row['course_id'])->first();
            if ($row['status']=="active" || $row['status']=="Active") {
                $row['status'] = 1;
            }
            else{
                $row['status'] = 2;
            }
            if ($course) {
                $course->update([
                    'name' => $row['course_name'],
                    'semester' => $row['semester'],
                    'status_id' => $row['status'],
                ]);
            } else {
                Course::create([
                    'name' => $row['course_name'],
                    'course_id' => $row['course_id'],
                    'semester' => $row['semester'],
                    'status_id' => $row['status'],
                ]);
            }
        }
       
    }
}
