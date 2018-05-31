<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Http\Resources\PageResource;
use App\Course;

class PageController extends Controller {

    public function index() {
        $pages = Page::paginate(5);

        return view('pages.index', ['pages' => $pages]);
    }

    public function create($course_code) {
        $page = new Page;
        $course = Course::where('code', $course_code)->firstOrFail();

        return view('pages.create', ['page' => $page, 'course' => $course]);
    }

    public function store(Request $request) {
        $page = new Page;
        $page->fill($request->except('slug'));
        $page->slug = str_slug($request->course_id . ' ' . $request->title);
        $page->save();

        return view('pages.show', ['page' => $page]);
    }

    public function show($course_code, $page_id) {
        $course = Course::where('code', $course_code)->firstOrFail();
        $page = Page::where('id', $page_id)->where('course_id', $course->id)->firstOrFail();

        return view('pages.show', ['page' => $page]);
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
