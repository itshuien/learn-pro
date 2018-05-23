<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Http\Resources\CourseResource;

class CourseController extends Controller {

    public function index() {
        $courses = Course::paginate(5);

        //return CourseResource::collection($courses);
        return view('courses.index', ['courses' => $courses]);
    }

    public function create() {
        $course = new Course();

        return view('courses.create', ['course' => $course]);
    }

    public function store(Request $request) {
        $course = new Course();
        $course->fill($request->all());
        $course->save();
        
        return view('courses.show', ['course' => $course]);
    }

    public function show($id) {
        $course = Course::findOrFail($id);

        return view('courses.show', ['course' => $course]);
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}
