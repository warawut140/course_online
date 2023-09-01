<?php

namespace App\Http\Controllers\frontend;

use App\Models\Tags;
use App\Models\Training;
use App\Models\TrainingComment;
use App\Models\TrainingGallery;
use App\Models\TrainingLogView;
use App\Models\TrainingTag;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Image;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //หมวดหมู่
        $tags =  Tags::orderBy('name')->pluck('name', 'id');
        $tags2 =  Tags::orderBy('name')->get();


        $training = Training::join('users','users.id','=','trainings.user_id')
            ->join('profiles','profiles.user_id','=','trainings.user_id')
            ->select('trainings.*','users.name as username','profiles.firstname','profiles.lastname'
                ,'profiles.image_profile')
            ->orderBy('id','desc')
//            ->get();
            ->paginate(8);

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

        return view('frontend.training',[
            'tags' => $tags ,
            'tags2' => $tags2 ,
            'training' => $training ,
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
//        dd($request->all());ๅ
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $auth_name = Auth::user()->name;
        $traing = new Training();
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
            $traing->video_training = null ;
        }
        $traing->actby = $auth_name;
        $traing->user_id = $auth_id;
        $traing->created_at = $now;
        $traing->updated_at = null;
        $traing->save();
        $traing_id = $traing->id;

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
        return redirect('training/'.$traing_id);

    }

    public function searchTraining(Request $request)
    {
//        dd($request->all());
        $type_page = $request->type_page ;
        $tags = $request->tags ;
//        echo $tags;
        $training_tagData = TrainingTag::where('tag_id','=',$tags)->get();

        if($type_page == 1){
            // Search Data
            //หมวดหมู่
            $tags =  Tags::orderBy('name')->pluck('name', 'id');
            $tags2 =  Tags::orderBy('name')->get();

            if(count($training_tagData) > 0){
                $training = Training::join('users','users.id','=','trainings.user_id')
                    ->join('profiles','profiles.user_id','=','trainings.user_id')
                    ->select('trainings.*','users.name as username','profiles.firstname','profiles.lastname'
                        ,'profiles.image_profile')
                    ->where(function ($query) use ($training_tagData) {
                        if(count($training_tagData) > 0){
                            for ($i = 0 ; $i < count($training_tagData);$i++){
                                $arr[] = $training_tagData[$i]['training_id'];
                            }
                            $query->whereIn('trainings.id', $arr);
                        }
                    })
                    ->orderBy('id','desc')
//            ->get();
                    ->paginate(8);

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
                return view('frontend.training',[
                    'tags' => $tags ,
                    'tags2' => $tags2 ,
                    'training' => $training ,
                ]);
            }else{
                $training = [];
                return view('frontend.training',[
                    'tags' => $tags ,
                    'tags2' => $tags2 ,
                    'training' => $training ,
                ]);
            }
        }elseif ($type_page == 2){
            return redirect('course');
        }
    }


    public function storeComment(Request $request)
    {
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $auth_name = Auth::user()->name;
        $training_comment = new TrainingComment();
        $training_comment->details = $request->details;
        $training_comment->training_id = $request->training_id;
        $training_comment->actby = $auth_name;
        $training_comment->user_id = $auth_id;
        $training_comment->created_at = $now;
        $training_comment->updated_at = null;
        $training_comment->save();

        Session::flash('status', 'Comment เรียบร้อย !');
        return redirect('training/'.$request->training_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $now = new DateTime();
        $ip = \Request::getClientIp(true);
        $visitor = TrainingLogView::where('ip','=',$ip)
            ->where('training_id','=',$id)
            ->first();
        if ($visitor == null){
            $logview = new TrainingLogView();
            $logview->training_id = $id;
            $logview->ip = $ip;
            $logview->count = 1;
            $logview->created_at = $now;
            $logview->updated_at = null;
            $logview->save();
        }else{
            DB::table('training_log_views')
                ->where('ip', '=', $ip)
                ->where('training_id', '=', $id)
                ->update([
                    'count' =>  $visitor->count + 1,
                    'updated_at' =>  $now ,
                ]);
        }

        $training = Training::join('users','users.id','=','trainings.user_id')
            ->join('profiles','profiles.user_id','=','trainings.user_id')
            ->select('trainings.*','users.name as username','profiles.firstname','profiles.lastname'
                ,'profiles.image_profile')
            ->where('trainings.id','=',$id)
            ->orderBy('id','desc')
            ->first();
        $trainingGallery = TrainingGallery::where('training_id','=',$id)->get();
        $trainingComment = TrainingComment::where('training_id','=',$id)->paginate(8);
        $tags = TrainingTag::join('tags','tags.id','=','training_tags.tag_id')
            ->select('tags.name', 'training_tags.training_id','training_tags.tag_id')
            ->where('training_tags.training_id','=',$training->id)
            ->get();
        $training->tags = $tags ;

//        dd($training);
        return view('frontend.article-traning',[
            'id' => $id,
            'training' => $training,
            'trainingGallery' => $trainingGallery,
            'trainingComment' => $trainingComment,
        ]);
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
}
