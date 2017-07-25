<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Http\Requests\TeacherRequest;

class TeachersController extends Controller {

    public function index()
    {
        $teachers = Teacher::all();
        return view("teachers.index", compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(TeacherRequest $request)
    {
        Teacher::create($request->all());
        \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionCreate')]);
        return redirect('teachers');
    }

    public function show(Teacher $teacher)
    {
        //
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->all());
        \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionUpdate')]);
        return redirect()->route('teachers.index');
    }

    public function destroy(Teacher $teacher)
    {

        try {

            $teacher->delete();
            \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionDelete')]);
            return redirect()->route('teachers.index');
        } catch (\PDOException $e) {
             \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => trans('messages.error')]);
            return redirect()->back();
        }
    }

}
