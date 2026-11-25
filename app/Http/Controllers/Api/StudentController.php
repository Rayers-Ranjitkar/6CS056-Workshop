<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all(); //This returns eloquent collection table now, prev in workshop2, API > studentController.php -> "routes/web.php" returned blade html file

        return StudentResource::collection($students); //prev new StudentResource($student); = 1 student, collection = multiple students data hold //then, it's sended one by one to StudentResources.php for outgoing data formatting to show to client 
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated()); //Create() inserts data into db //Validated() is a built-in Laravel method that returns the data that has passed our validation rules, now validation rules of what, where defined? -> in StoreStudentRequest.php at first inside Requests folder , those validate and rules() function automatically gets called at first 

        return (new StudentResource($student)) //Resource = outgoing, Request - incomming
            ->response() 
            ->setStatusCode(201);
    }

    public function show(Student $student)
    {
        return new StudentResource($student); //passing the Student object into the StudentResource class, now we can access through $this as it's constructor has it. //GET /api/students/5 =  Laravel automatically retrieves student ID 5 through Route Model Binding because we have specified: Student $student // internally it does $student = Student::findOrFail(5);
    }

    public function update( //both old and new params
        UpdateStudentRequest $request,
        Student $student
    ) {
        $student->update($request->validated());

        return new StudentResource($student->fresh()); // retrieve new instance //fresh() =  ensures that we return the latest saved information. = fresh()  is a built-in Eloquent method that retrieves a new instance of the student from the database
    }

    public function destroy(Student $student): JsonResponse //Student $student retrieves the particular student using Route Model Binding aka internally findonfail(id)
    {
        $student->delete();

        return response()->json(null, 204);
    }
}