<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;
use App\Course;
use App\Http\Resources\CourseResource;
use App\Http\Requests\StoreCourse;
use App\Http\Requests\UpdateCourse;

class CourseController extends Controller {

    public function index() {
        return view('courses.index');
    }

    public function create() {
        return view('courses.create');
    }

    public function store(StoreCourse $request) {
        $course = new Course();
        $course->fill($request->except('image'));

        if($request->hasFile('image')) {
            $course->image = str_slug($course->code) . '.jpg';
            $request->file('image')->storeAs('public/courses', $course->image);
        } else {
            $course->image = 'placeholder-image.png';
        }
        
        $course->save();

        return response()->json(['course' => $course]);
        // return redirect()->route('courses.show', $course->slug);
    }

    public function show($slug) {
        $course = Course::findBySlugOrFail($slug);

        return view('courses.show', ['course' => $course]);
    }

    public function edit($slug) {
        $course = Course::findBySlugOrFail($slug);

        return view('courses.edit', ['slug' => $course->slug]);
    }

    public function update(UpdateCourse $request, $slug) {
        $course = Course::findBySlugOrFail($slug);
        $course->fill($request->except('image'));

        if($request->hasFile('image')) {
            $course->image = str_slug($course->code) . '.jpg';
            $request->file('image')->storeAs('public/courses', $course->image);
        }
        
        $course->save();

        return response()->json(['course' => $course]);
    }

    public function destroy($slug) {
        $course = Course::findBySLugOrFail($slug);

        $course->delete();

        return response()->json(['course' => $course]);
    }
}
