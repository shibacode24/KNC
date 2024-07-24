<?php

namespace App\Http\Controllers\panel;
use App\Http\Controllers\Controller;
use App\Models\account_department\Expence_Head;
use Illuminate\Http\Request;
use App\Models\account_department\Expence_Category;

class AccountDepartmentController extends Controller
{
    public function expenseMaster(Request $request)
    {
        $expence_categorys = Expence_Category::all();
        $expence_head = Expence_Head::all();
        return view('adminpanel.expense_master',compact('expence_head','expence_categorys'));
    }

    public function expence_category_create(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'expence_category' => 'required|',

        ]);
        $expence_category = new Expence_Category();
        $expence_category->expence_category = $request->expence_category;

        $expence_category->save();
        return redirect()->route('expence_master')->with('success', 'expence_category added successfully!');
    }

 

    public function expence_category_delete($id)
    {
     Expence_Category::find($id)->delete();
        return redirect()->route('expence_master')->with('success', 'expence_category is Deleted Successfully');
    }

    
    

    public function edit_expence_category($id){

        $expence_categoryAll = Expence_Category::all();
        $expence_categoryEdit = Expence_Category::find($id);
        return view('adminpanel.expence_category_edit', compact('expence_categoryAll', 'expence_categoryEdit'));
    }

    public function update_expence_category(Request $request)
    {
        $expence_category = Expence_Category::find($request->id);
        $expence_category->expence_category = $request->expence_category;
        $expence_category->save();


        return redirect(route('expence_master'))->with('success', 'Successfully Updated !');
    }

    public function expence_category_head(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'expence_category_id' => 'required|',
            'expence_head' => 'required|',

        ]);
        $expence_category = new Expence_Head();
        $expence_category->expence_category_id = $request->expence_category_id;
        $expence_category->expence_head = $request->expence_head;

        $expence_category->save();
        return redirect()->route('expence_master')->with('success', 'expence_category added successfully!');
    }
    
    public function edit_expence_head($id){
        $expence_categorys = Expence_Category::all();
        $expence_head = Expence_Head::all();
        $expence_head_edit = Expence_Head::find($id);
        // echo json_encode($expence_head_edit);
        // echo json_encode($id);
        // exit();
        return view('adminpanel.expence_head_edit', compact('expence_head', 'expence_head_edit','expence_categorys'));
    }


    public function update_expence_head(Request $request)
    {
        $expence_head = Expence_Head::find($request->id);
        $expence_head->expence_category_id = $request->expence_category_id;
        $expence_head->expence_head = $request->expence_head;
        $expence_head->save();


        return redirect(route('expence_master'))->with('success', 'Successfully Updated !');
    }

    public function expence_head_delete($id)
    {
     Expence_Head::find($id)->delete();
        return redirect()->route('expence_master')->with('success', 'expence head is Deleted Successfully');
    }

    public function incomeBilling(Request $request)
    {
        return view('adminpanel.income');
    }

    public function expenseEntry(Request $request)
    {
        return view('adminpanel.expense_entry');
    }
}
