<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category, Request $request)
    {
        $category['categories']=$category->all();
        return view('admin/category/index', $category );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories['category']=Category::all();
        return view('admin/category/create', $categories );
    }

    public function submitCategory(Request $request){
        if($request->hasFile('transport_icon')){
            $image=$request->transport_icon;
            $filename = time().'.'.$request->transport_icon->extension();
            $image->move('Icon', $filename);
        }
        DB::table('categories')->insert([
            'category'=>$request->category,
            'parent_category'=>$request->parent_category,
            'icon'=>$filename
        ]);
        return redirect('categories');
   }

   public function editCategory(Request $request,  $id){

    $data['categories']=DB::table('categories')->where('id', $id)->first();
    // return $data['categories']->parent_category;
    //  die;
    $data['parent_category']=Category::where('id','!=', $id)->get();



    // DB::table('categories')->insert([
    //     'category'=>$request->category,
    //     'parent_category'=>$request->parent_category
    // ]);
     return view('admin/category/edit', $data);
}

public function updateCategory(Request $request){
    if($request->hasFile('transport_icon')){
        $image=$request->transport_icon;
        $filename = time().'.'.$request->transport_icon->extension();
        $path=$image->move('Icon', $filename);
    }else{
        $path=$request->transport_icon;
    }


    DB::table('categories')->where('id', $request->category_id)->update([
        'category'=>$request->category,
        'parent_category'=>$request->parent_category,
        'icon'=>url('/').'/'.$path
    ]);
    return redirect('categories');
}

public function test(){
    $data['cat']=Category::root()->get();
    $data['category']= Category::where('id',1)->root()->get();
    return view('test', $data);
}
// public function test(){
//     $data['category']= Category::with('children.children')->root()->get();
//     return view('test', $data);
// }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
   public function changeStatus($user_id, $value){
    if($value=='yes'){
        DB::table('categories')->where('id',$user_id)->update(['status'=>1]);
        return response()->json(['status'=>'User Activated']);
    }elseif($value=='no'){
        DB::table('categories')->where('id',$user_id)->update(['status'=>0]);
        return response()->json(['status'=>'User Deactivated']);
    }
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
