<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CategoryType\CategoryTypeEditRequest;
use App\Http\Requests\admin\CategoryType\CategoryTypeCreateRequest;
use App\Models\CategoryType;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;


class CategoryTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexcategorytype()
    {
        $category_type = CategoryType::orderBy('order')->get();
        return view('admin.category_type.category_type_index', compact('category_type'));
    }

    public function createcategorytypepost(CategoryTypeCreateRequest $request)
    {
        $newcategorytype = new CategoryType();
        $newcategorytype->name = $request->input('name');
        $newcategorytype->order = $request->input('order');
        $newcategorytype->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create cartegory type';
        $log->data_change=$newcategorytype->name;
        $log->save();
        return redirect('/admin/category_type')->with('message', 'Add Category Type Is Done!');
    }

    public function createcategorytypeget()
    {
        return view('admin.category_type.category_type_create');
    }

    public function editcategorytypepost(CategoryTypeEditRequest $request, $id)
    {
        $newcategorytype = categorytype::find($id);
        if($newcategorytype->name != $request->input('name'))
        {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit cartegory type';
            $log->data_change=$newcategorytype->name ;
            $log->save();
        }
        $newcategorytype->name = $request->input('name');
        if($newcategorytype->order != $request->input('order'))
        {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit cartegory type';
            $log->data_change=$newcategorytype->name .','.$newcategorytype->order ;
            $log->save();
        }
        $newcategorytype->order = $request->input('order');
        $newcategorytype->save();
        return redirect('/admin/category_type')->with('message', 'Edit CategoryType Is Done!');
    }

    public function editcategorytypeget($id)
    {
        $category_type = CategoryType::find($id);
        return view('admin.category_type.category_type_edit', compact('category_type'));
    }

}

?>