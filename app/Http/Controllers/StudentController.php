<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Resources\studentResources;
use Illuminate\Support\Facades\Validator;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return new studentResources($students, 'Success', 'List of students' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'nim' => 'required',
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',

        ]);

        if ($validator->fails()) {
            return new studentResources(null, 'Failed', $validator->errors());
        }

        $student = Student::create($request->all());
        return new studentResources($student, 'Success', 'Student created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);
        if ($student) {
            return new studentResources($student, 'Success', 'Student found');
        } else {
            return new studentResources(null, 'Failed', 'Student not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->update($request->all());
            return new studentResources($student, 'Success', 'Student updated successfully');
        } else {
            return new studentResources(null, 'Failed', 'Student not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return new studentResources($student, 'Success', 'Student delete successfully');
        } else {
            return new studentResources(null, 'Failed', 'Student not found');
        }
    }
}
