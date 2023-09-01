<?php

namespace App\Http\Controllers\backend;

use App\Models\Course;
use App\Models\CourseList;
use App\Models\Options;
use App\Models\Questions;
use App\Models\QuestionsDetail;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Image;
use App\Models\CourseChapter;

class AdminCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function course_chapter($id)
    {
        $course = Course::find($id);
        if($course){        
            $chapter = CourseChapter::where('course_id',$id)->orderBy('order','desc')->get();
            return view('backend.course.course_chapter', [
                'course' => $course,
                'chapter' => $chapter,
            ]);
        }else{
            return redirect()->back()->with('error','ไม่พบข้อมูลรายการ');
        }
    }

    public function course_chapter_delete($id)
    {
        CourseChapter::where('id',$id)->delete();  
            return response()->json([
                'success' => 'success',
            ]);
    }

    public function course_chapter_view($id)
    {
       $data = CourseChapter::find($id);  
       if($data){
        return response()->json([
            'success' => 'success',
            'data' =>$data,
        ]);
       }else{
        return response()->json([
            'success' => 'error',
        ]);
       } 
    }

    public function course_chapter_store(Request $request)
    {
        $now = new DateTime();
        $auth_name = Auth::user()->name;
        if($request->action == 'save'){
            $chapter = new CourseChapter();
            $chapter->name = $request->name;
            $chapter->order = $request->order;
            $chapter->course_id = $request->course_id;
            $chapter->actby = $auth_name;
            $chapter->created_at = $now;
            $chapter->updated_at = null;
            $chapter->save();
        }elseif($request->action == 'update'){
            $chapter = CourseChapter::find($request->id);
            $chapter->name = $request->name;
            $chapter->order = $request->order;
            $chapter->actby = $auth_name;
            $chapter->updated_at = null;
            $chapter->save();
        }
        return response()->json([
            'success' => 'success',
        ]);
    }

    public function index()
    {
        $course = Course::select('id', 'name', 'status','price', 'actby')->orderBy('id', 'desc')->get();
        return view('backend.course.index', [
            'view' => 1,
            'course' => $course,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ini_set('post_max_size', '64M');
        ini_set('upload_max_filesize', '64M');
        $type = $request->get('type');

        $now = new DateTime();
        $auth_name = Auth::user()->name;
        if ($type == 1) {
            //Course
            if ($request->get('action') == 'save'){
                $course = new Course();
                $course->name = $request->get('name');
                $course->status = $request->get('status');
                $course->price = $request->get('price');
                $course->detail = $request->get('detail');
                if ($request->file('image') != null) {
                    $imageFileName = 'course_banner_' . str_random(5) . "." . $request->file('image')->getClientOriginalExtension();
//                Image::make($request->file('course_image'))->save(public_path('/images/course/banner/').$imageFileName);
                    $request->file('image')->move(public_path() . '/images/course/banner/', $imageFileName);
                    $course->image = $imageFileName;
                }else{
                    $course->image = null;
                }
                $course->actby = $auth_name;
                $course->created_at = $now;
                $course->updated_at = null;
                $course->save();
                return response()->json([
                    'type' => $type,
                    'success' => 'success',
                ]);
            }else if($request->get('action') == 'update'){
                $course = Course::find($request->get('id'));
                $course->name = $request->get('name');
                $course->status = $request->get('status');
                $course->price = $request->get('price');
                $course->detail = $request->get('detail');
                if ($request->file('image') != null) {
                    $imageFileName = 'course_banner_' . str_random(5) . "." . $request->file('image')->getClientOriginalExtension();
                    $request->file('image')->move(public_path() . '/images/course/banner/', $imageFileName);
                    File::delete(public_path() . '/images/course/banner/' . $course->image);
                    $course->image = $imageFileName;
                }
                $course->actby = $auth_name;
                $course->updated_at = $now;
                $course->update();
                return response()->json([
                    'success' => 'success',
                ]);
            }
        } else {
            //Course List
            $form = $request->input('form');
            if($form == 'save'){
                if ($request->file('course_image') != null) {
                    $imageFileName = 'course_image_' . str_random(5) . "." . $request->file('course_image')->getClientOriginalExtension();
//                    Image::make($request->file('course_image'))->save(public_path('/images/course/image/').$imageFileName);
                    $request->file('course_image')->move(public_path() . '/images/course/image/', $imageFileName);
                }
                if ($request->file('file') != null) {
                    $file = $request->file('file');
                    $videoFileName = 'course_video_' . str_random(5) . "." . $request->file('file')->getClientOriginalExtension();
                    $file->move(public_path() . '/images/course/video/', $videoFileName);
                }
                $order = CourseList::where('course_id',$request->input('course_id'))->max('course_order');
                $is_order = ($order == null) ? 0 : $order;

                $chapter = CourseChapter::find($request->input('course_id'));
                if(!$chapter){
                    return response()->json([
                        'success' => 'error',
                    ]);
                }
                $courseList = new CourseList();
                // $courseList->course_id = $request->input('course_id');
                $courseList->course_id = $chapter->course_id;
                $courseList->course_name = $request->input('course_name');
                $courseList->course_detail = $request->input('course_detail');
                $courseList->course_image = $imageFileName;
                $courseList->course_video =  $videoFileName;
                $courseList->course_order = $is_order + 1;
                $courseList->course_free = $request->input('course_free');
                $courseList->course_time = $request->input('course_time');
                $courseList->actby = $auth_name;
                $courseList->created_at = $now;
                $courseList->updated_at = null;
                $courseList->chapter_id = $chapter->id;
                $courseList->save();

                $questions_details = new QuestionsDetail();
                $questions_details->course_list_id = $courseList->id;
                $questions_details->time_test = $request->input('time_test');
                $questions_details->details = $request->input('question_details');
                $questions_details->created_at = $now;
                $questions_details->updated_at = null;
                $questions_details->save();
                return response()->json([
                    'type' => $request->all(),
                    'success' => 'success',
                    'form' => $form,
                ]);

            }elseif ($form == 'update'){
                $courseList = CourseList::find($request->input('id'));
                $courseList->course_name = $request->input('course_name');
                $courseList->course_detail = $request->input('course_detail');
                if ($request->file('course_image') != null) {
                    $imageFileName = 'course_image_' . str_random(5) . "." . $request->file('course_image')->getClientOriginalExtension();
//                    Image::make($request->file('course_image'))->save(public_path('/images/course/image/').$imageFileName);
                    $request->file('course_image')->move(public_path() . '/images/course/image/', $imageFileName);
                    $courseList->course_image = $imageFileName;
                }
                if ($request->file('file') != null) {
                    $file = $request->file('file');
                    $videoFileName = 'course_video_' . str_random(5) . "." . $request->file('file')->getClientOriginalExtension();
                    $file->move(public_path() . '/images/course/video/', $videoFileName);
                    $courseList->course_video =  $videoFileName;
                }
                $courseList->course_free = $request->input('course_free');
                $courseList->course_time = $request->input('course_time');
                $courseList->actby = $auth_name;
                $courseList->updated_at = $now;
                $courseList->update();

                $qd = QuestionsDetail::where('course_list_id',$request->input('id'))->first();
                $qd->time_test = $request->input('time_test');
                $qd->details = $request->input('question_details');
                $qd->updated_at = $now;
                $qd->update();
                return response()->json([
                    'type' => $request->all(),
                    'success' => 'success',
                    'form' => $form,
                ]);
            }
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chapter = CourseChapter::find($id);
        if($chapter){
            $course_name = Course::find($chapter->course_id);
            return view('backend.course.index', [
                'view' => 2,
                'id' => $id,
                'chapter' => $chapter,
                'course_name' => $course_name->name,
            ]);
        }
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = $request->get('type');
        $now = new DateTime();
        $auth_name = Auth::user()->name;

        if ($type == 1) {
            $course = Course::find($id);
            $course->name = $request->get('name');
            $course->status = $request->get('status');
            $course->price = $request->get('price');
            $course->detail = $request->get('detail');
            if ($request->file('image') != null) {
                $imageFileName = 'course_banner_' . str_random(5) . "." . $request->file('image')->getClientOriginalExtension();
//                Image::make($request->file('course_image'))->save(public_path('/images/course/banner/').$imageFileName);
                $request->file('image')->move(public_path() . '/images/course/banner/', $imageFileName);
                $course->image = $imageFileName;
                File::delete(public_path() . '/images/course/banner/' . $course->image);
            }
            $course->actby = $auth_name;
            $course->updated_at = $now;
            $course->update();
            return response()->json([
                'success' => 'success',
            ]);
        } else {
            //Course List
            $courseList = CourseList::find($id);
            return response()->json([
                'data' => $request->all(),
                'course_name' => $request->input('course_name'),
                'course_detail' => $request->input('course_detail'),
                'course_image' => $request->file('course_image'),
                'file' => $request->file('file'),
                'db' => $courseList ,
                'success' => 'success',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $courseLists = CourseList::where('course_id','=',$course->id)->get();
        if($courseLists != null){
            foreach ($courseLists as $courseList){
                File::delete(public_path() . '/images/course/image/' . $courseList->course_image);
                File::delete(public_path() . '/images/course/video/' . $courseList->course_video);
                $questions = Questions::where('course_list_id',$courseList->id)
                    ->where('option_type_id','=',2)
                    ->get();
                if($questions != null) {
                    foreach ($questions as $question) {
                        Options::where('question_id', '=', $question->id)->delete();
                    }
                    Questions::where('course_list_id', $courseList->id)->delete();
                }
                CourseList::destroy($courseList->id);
            }
        }
        File::delete(public_path() . '/images/course/banner/' . $course->image);
        Course::destroy($id);
        return response()->json([
            'success' => 'success',
        ]);
    }

    public function delete($id)
    {
        $courseList = CourseList::find($id);
        File::delete(public_path() . '/images/course/image/' . $courseList->course_image);
        File::delete(public_path() . '/images/course/video/' . $courseList->course_video);
        $questions = Questions::where('course_list_id',$courseList->id)
            ->where('option_type_id','=',2)
            ->get();
        if($questions != null){
            foreach ($questions as  $question){
                Options::where('question_id','=',$question->id)->delete();
            }
            Questions::where('course_list_id',$courseList->id)->delete();
        }
        CourseList::destroy($id);
        return response()->json([
            'success' => 'success',
        ]);
    }

    //API
    public function getCourse(Request $request)
    {
        if ($request->input('client')) {
            return Course::select('id', 'name', 'status', 'actby')->get();
        }

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $columns = ['id', 'name', 'status', 'actby'];

        $query = Course::select('id', 'name', 'status','price', 'actby')->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%');
            });
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function getCourseID($id)
    {
        $course = Course::find($id);
        return response()->json($course);
    }

    public function getCourseList(Request $request,$id)
    {
//        dd($request->all());
        $course_id = $request->input('course_id');
        if ($request->input('client')) {
            return CourseList::select('id', 'course_id', 'course_name', 'course_detail', 'course_image', 'course_video', 'course_order', 'actby', 'created_at', 'updated_at')
                // ->where('course_id', '=', $course_id)
                ->where('chapter_id', '=', $course_id)
                ->get();
        }

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $columns = ['id', 'course_name', 'status', 'actby'];

        $query = CourseList::select('id', 'course_id', 'course_name', 'course_detail', 'course_image', 'course_video', 'course_order', 'actby', 'created_at', 'updated_at')
            // ->where('course_id', '=', $course_id)
            ->where('chapter_id', '=', $course_id)
            ->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('course_name', 'like', '%' . $searchValue . '%');
            });
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function getCourseListID($id)
    {
//        $course = CourseList::find($id);
        $course = CourseList::join('questions_details','questions_details.course_list_id','=','course_lists.id')
            ->select('course_lists.*','questions_details.time_test','questions_details.details as question_details')
            ->where('course_lists.id',$id)
            ->first();

        return response()->json($course);
    }
}
