<?php

namespace App\Http\Controllers\backend;

use App\Models\Training;
use App\Models\TrainingComment;
use App\Models\TrainingLogView;
use App\Models\TrainingGallery;
use DateTime;
use App\Models\TrainingTag;
use App\Models\Tags;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminTrainingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $training = Training::join('users','users.id','=','trainings.user_id')
            ->join('profiles','profiles.user_id','=','trainings.user_id')
            ->select('trainings.*','users.name as username','profiles.firstname','profiles.lastname'
                ,'profiles.image_profile')
            ->orderBy('id','desc')
            ->get();
        foreach ($training as $key => $item){
            $trainingCount = TrainingLogView::select(DB::raw('sum(count) as total'))
                ->where('training_id','=',$item->id)
                ->groupBy('training_id')
                ->first();
            $training[$key]->total =  ($trainingCount == null)?0:$trainingCount->total;;
            $trainingCountCM = TrainingComment::select(DB::raw('count(training_id) as total'))
                ->where('training_id','=',$item->id)
                ->groupBy('training_id')
                ->first();
            $training[$key]->commentTotal =  ($trainingCountCM == null)?0:$trainingCountCM->total;
        }
//        dd($training);
        return view('backend.training.index',[
                'training' => $training
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

    public function training_edit($id)
    {   
        $tags =  Tags::orderBy('name')->pluck('name', 'id');
        $tags2 =  Tags::orderBy('name')->get();

       $training = Training::where('id',$id)->first();
       if(!$training){
        Session::flash('error', 'ไม่พบข้อมูลทำรายการ !');
        return redirect()->back();
       }else{
        $trainingCM = TrainingComment::where('training_id','=',$training->id)->get();
        $trainingTag = TrainingTag::where('training_id','=',$training->id)->get();
        return view('backend.training.edit',[
            'training' => $training,
            'trainingCM' => $trainingCM,
            'tags' => $tags ,
            'tags2' => $tags2 ,
            'trainingTag' => $trainingTag ,
            ]);
       }
    }

    public function training_delete($id)
    {   
        TrainingGallery::where('training_id',$id)->delete();
      Training::where('id',$id)->delete();
        Session::flash('status', 'ลบสำเร็จ !');
        return redirect()->back();
    }

    public function training_com_delete($id)
    {   
        $trainingCM = TrainingComment::where('id','=',$id)->delete();
        Session::flash('status', 'ลบสำเร็จ !');
        return redirect()->back();
    }

    public function training_update(Request $request)
    {
//        dd($request->all());ๅ
        $now = new DateTime();
        // $auth_id = Auth::user()->id;
        // $auth_name = Auth::user()->name;
        // $traing = new Training();
        $traing = Training::where('id',$request->training_id)->first();
        $traing->title = $request->title;
        $traing->details = $request->details;
        if ($request->file('image_training') != null) {
            $imageFileName = 'image_training_' . str_random(5) . "." . $request->file('image_training')->getClientOriginalExtension();
            Image::make($request->file('image_training'))->save(public_path('/images/training/image/').$imageFileName);
            $traing->image_training = $imageFileName;
        }
        if ($request->file('video_training') != null) {

            $file = $request->file('video_training');
            $videoFileName = 'video_training_' . str_random(5) . "." . $request->file('video_training')->getClientOriginalExtension();
            $file->move(public_path() . '/images/training/video/', $videoFileName);
            $traing->video_training = $videoFileName;
        }else{
            // $traing->video_training = null ;
        }
        // $traing->actby = $auth_name;
        // $traing->user_id = $auth_id;
        // $traing->created_at = $now;
        $traing->updated_at = null;
        $traing->save();
        $traing_id = $traing->id;

        TrainingTag::where('training_id',$traing_id)->delete();
        if($request->tags != null){
            for ($i = 0 ; $i < count($request->tags);$i++){
                $traing_tag = new  TrainingTag();
                $traing_tag->training_id = $traing_id ;
                $traing_tag->tag_id = $request->tags[$i] ;
                $traing_tag->created_at =  $now;
                $traing_tag->updated_at =  null;
                $traing_tag->save();
            }
        }
        if(!empty($request->file('galley'))){
            /* insert file Gallery */
            if ($request->file('galley') != ""){
                $count = count($request->file('galley'));
                for ($i = 0 ; $i < $count;$i++){
                    $filename = 'gallery_training_'.$traing_id."-".str_random(3).'.'.$request->file('galley')[$i]->getClientOriginalExtension();
                    $request->galley[$i]->move(public_path() . '/images/training/gallery/', $filename);
                    $image_gal[$i] = $filename;
                }
            }
            /* end */
            /* insert database TrainingGallery */
            if($image_gal != null){
                for ($i = 0 ; $i < count($image_gal);$i++){
                    $gallery = new  TrainingGallery();
                    $gallery->filename = $image_gal[$i];
                    $gallery->training_id =  $traing_id;
                    $gallery->created_at = $now;
                    $gallery->updated_at = null;
                    $gallery->save();
                }
            }
            /* end */
        }
        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('admin/training');

    }

}
