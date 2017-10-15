<?php

namespace App\Http\Controllers;

use App\Record;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class RecordController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Check input values
    public function checkValidator($input)
    {
        $rules = [
            'title' => 'required',
            'desc'  => 'required',
            'image' => 'image',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return [
                'fail'   => true,
                'errors' => $validator->getMessageBag()->toArray(),
            ];
        }
    }

    // Get input image and save it
    public function saveImage($image)
    {
        if (!$image) {
            return false;
        }

        $size = 380;
        $filename = uniqid('img_') . '.' . $image->getClientOriginalExtension();

        Image::make($image)->resize($size, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save("pics/$filename");

        return $filename;
    }

    // Delete image file
    public function deleteImage($rec)
    {
        if ($img = $rec->image) {
            if (file_exists(public_path() . '/pics/' . $img)) {
                unlink(public_path() . '/pics/' . $img);
            }
        }
    }

    // Users page
    public function getUsers()
    {
        return view('admin/users', ['users' => User::all()]);
    }

    // Home page
    public function getIndex()
    {
        return view('admin/index');
    }

    // Builds list of records
    public function getList()
    {
        // Check if there are input values, otherwise check session values
        Session::put('record_field', Input::has('field')
            ? Input::get('field')
            : (Session::has('record_field') ? Session::get('record_field')
                : 'pub_date'));
        Session::put('record_sort', Input::has('sort')
            ? Input::get('sort')
            : (Session::has('record_sort') ? Session::get('record_sort')
                : 'desc'));

        $records = Record::orderBy(Session::get('record_field'),
            Session::get('record_sort'))
            ->paginate(50);
        $authors = User::all();

        return view('admin/list',
            ['records' => $records, 'authors' => $authors]);
    }

    public function getUpdate($id)
    {
        return view('admin/update', ['record' => Record::find($id)]);
    }

    // Update record in DB
    public function postUpdate($id)
    {
        // Validate
        if (is_array($res = RecordController::checkValidator(Input::all()))) {
            return $res;
        }

        $record = Record::find($id);

        $record->title = Input::get('title');
        $record->desc = Input::get('desc');
        if ($image = RecordController::saveImage(Input::file('image'))) {
            RecordController::deleteImage($record);
            $record->image = $image;
        }

        $record->save();

        return ['url' => '/admin/list'];
    }

    public function getCreate()
    {
        return view('admin/create', ['record' => '']);
    }

    // Create new record in DB
    public function postCreate()
    {
        // Validate
        if (is_array($res = RecordController::checkValidator(Input::all()))) {
            return $res;
        }

        $record = new Record;

        $record->title = Input::get('title');
        $record->desc = Input::get('desc');
        $record->author_id = Auth::id();
        if ($image = RecordController::saveImage(Input::file('image'))
        ) {
            $record->image = $image;
        }

        $record->save();

        return ['url' => '/admin/list'];
    }

    // Delete record from DB
    public function getDelete($id)
    {
        $rec = Record::find($id);
        RecordController::deleteImage($rec);

        $rec->delete();
        return Redirect('/admin/list');
    }

}
