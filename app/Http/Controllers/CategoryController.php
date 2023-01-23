<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Symfony\Component\String\b;

class CategoryController extends Controller
{
    //direct category list page
    public function index () {
        $categories = Category::get();
        return view('admin.category.index',compact('categories'));
    }

    //create category
    public function createCategory(Request $request) {

         $this->categoryValidationCheck($request);


        $categoryData = $this->getCategoryData($request);
        Category::create($categoryData);

        return back();
    }

    //delete category
    public function deleteCategory($id) {
        Category::where('category_id',$id)->delete();
        return redirect()->route('admin#category')->with('deleteSuccess','Category Deleted Successfully!');
    }

    //category search
    public function categorySearch(Request $request) {
        $categories = Category::where('title', 'like', '%'.$request->categorySearch.'%')->get();

        return view('admin.category.index',compact('categories'));
    }


    //category edit page
    public function categoryEditPage($id) {
        $categories = Category::get();
        $updateCategory = Category::where('category_id',$id)->first();
        return view('admin.category.edit',compact('categories','updateCategory'));
    }

    //category update
    public function categoryUpdate(Request $request, $id) {
        $this->categoryValidationCheck($request);

        $updatedCategory = $this->getCategoryData($request);

        Category::where('category_id', $id)->update($updatedCategory);

        return redirect()->route('admin#category')->with('updateSuccess','Category Updated Successfully!');;


    }

    //get category data
    private function getCategoryData($request) {
        return  [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }


    //category validation check
    private function categoryValidationCheck($request) {
        Validator::make($request->all(),[
            'categoryName' => 'required',
            'categoryDescription' => 'required'
        ])->validate();
    }

}
