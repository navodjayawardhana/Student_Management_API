<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $students = Student::all();

            return response()->json([
                'message' => 'Students retrieved successfully.',
                'students' => $students
            ], 200);

        } catch (Exception $e) {
            Log::error('Error retrieving students: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve students. Please try again later.'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        try {
            $fields = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'nullable|string|max:255',
                'contact_num' => 'nullable|string|max:15',
                'email' => 'required|email|unique:students,email',
            ]);

            $student = Student::create($fields);

            return response()->json([
                'message' => 'Student created successfully.',
                'student' => $student
            ], 201);

        } catch (Exception $e) {
            Log::error('Error creating student: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to create student. Please try again later.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
