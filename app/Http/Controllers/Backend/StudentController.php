<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\studentApprovalEmail;
use App\Models\Agent;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use App\Services\MediaFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PDF;
use Countries;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    private $root = 'backend.students.';

    public function form(Request $request)
    {
        return view($this->root . 'form');
    }

    public function index()
    {
        $student = Student::whereNotIn('status_id', [0])->orderBy('id', 'DESC')->get();
        return view($this->root . 'index', ['students' => $student]);
    }

    public function pending()
    {
        $student = Student::where('status_id', 0)->orderBy('id', 'DESC')->get();

        return view($this->root . 'pending', ['students' => $student]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validation
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:students'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $student = new Student();

            do {
                $code = random_int(100000, 999999);
            } while (Student::where("code", "=", $code)->first());

            $date = Carbon::now()->format('y');
            $code = 'ST-' . $date . $code;
            $student = $this->patch($student, $request, $code);

            if ($student->save()) {
                DB::commit();
                return redirect()->back()->with('success', 'Admission form submitted successfully');
            }

            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function show($id)
    {
        $student = Student::where('id', $id)->first();
        return view($this->root . 'view', ['student' => $student]);
    }

    public function edit($id)
    {
        $student = Student::where('id', $id)->first();

        Session::flash('url', request()->headers->get('referer')); // Store previous url

        return view($this->root . 'edit', ['student' => $student]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            // Validation
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:students,email,' . $id,
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $student = Student::find($id);
            $student = $this->patch($student, $request, $student->code);

            if ($student->save()) {

                DB::commit();
                return Redirect::to(Session::get('url'))->with('success', 'Admission application updated successfully'); // Redirect to session stored url
            }

            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $student = Student::find($id);

            if (!is_null($student)) {
                if ($student->delete()) {
                    $user = User::where('email', $student->email)->first();
                    if (!is_null($user)) {
                        $user->delete();
                    }
                    Storage::deleteDirectory('public/students/' . $student->code);

                    DB::commit();
                    return redirect()->back()->with('success', 'Student has been deleted');
                }
            }

            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function approveApplication(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $student = Student::find($id);
            $student->status_id = 1;
            if ($student->save()) {
                $user = new User();
                $user->name = $student->name;
                $user->email = $student->email;
                $user->password = Hash::make('password');
                $user->assignRole('Student');
                $user->save();

                DB::commit();
                return redirect()->back()->with('success', 'New admission application has been approved');
            }

            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * @param $student
     * @param $request
     * @param $code
     * @return object
     */
    private function patch($student, $request, $code): object
    {
        $student->code = $code;
        $student->name = $request->name;
        $student->mobile1 = $request->mobile1;
        $student->email = $request->email;
       
        return $student;
    }
}
