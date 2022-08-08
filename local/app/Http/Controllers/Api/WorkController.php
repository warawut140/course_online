<?php

namespace App\Http\Controllers\Api;

use App\Models\Logview;
use App\Models\WorkComment;
use App\Models\WorkPosting;
use App\Models\WorkTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    public function work1()
    {
        // Data Work Posting : หาผู้รับจ้าง
        $works = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
            ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
            ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
            ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
            ->where('tpye_wp_id', '=',1)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();
        foreach ($works as $key => $work) {
            $wp_tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
                ->select('tags.name', 'work_tags.wp_id', 'work_tags.tag_id')
                ->where('wp_id', '=', $work->id)
                ->get();
            $works[$key]->tags = $wp_tags;
        }
        foreach ($works as $key => $work) {
//            $Logview = Logview::where('wp_id', $work->id)->sum('count');
            $Logview = Logview::where('wp_id', $work->id)->get();
            if ($Logview != null) {
                $works[$key]->sum = count($Logview);
            } else {
                $works[$key]->sum = 0;
            }
        }
        foreach ($works as $key => $work) {
            $wp_comment = WorkComment::where('wp_id', $work->id)->count('wp_id');
            if ($wp_comment != null) {
                $works[$key]->count = $wp_comment;
            } else {
                $works[$key]->count = 0;
            }
        }

        return response()->json($works);
    }
    public function work2()
    {
        // Data Work Posting : หาผู้รับเหมา
        $works = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
            ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
            ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
            ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
            ->where('tpye_wp_id', '=',2)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();
        foreach ($works as $key => $work) {
            $wp_tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
                ->select('tags.name', 'work_tags.wp_id', 'work_tags.tag_id')
                ->where('wp_id', '=', $work->id)
                ->get();
            $works[$key]->tags = $wp_tags;
        }
        foreach ($works as $key => $work) {
//            $Logview = Logview::where('wp_id', $work->id)->sum('count');
            $Logview = Logview::where('wp_id', $work->id)->get();
            if ($Logview != null) {
//                $works[$key]->sum = $Logview;
                $works[$key]->sum = count($Logview);
            } else {
                $works[$key]->sum = 0;
            }
        }
        foreach ($works as $key => $work) {
            $wp_comment = WorkComment::where('wp_id', $work->id)->count('wp_id');
            if ($wp_comment != null) {
                $works[$key]->count = $wp_comment;
            } else {
                $works[$key]->count = 0;
            }
        }

        return response()->json($works);
    }
    public function work3()
    {
        // Data Work Posting : หางาน หรือ ผู้รับจ้าง
        $works = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
            ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
            ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
            ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
            ->where('tpye_wp_id', '=',3)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();
        foreach ($works as $key => $work) {
            $wp_tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
                ->select('tags.name', 'work_tags.wp_id', 'work_tags.tag_id')
                ->where('wp_id', '=', $work->id)
                ->get();
            $works[$key]->tags = $wp_tags;
        }
        foreach ($works as $key => $work) {
            $Logview = Logview::where('wp_id', $work->id)->sum('count');
            if ($Logview != null) {
                $works[$key]->sum = $Logview;
            } else {
                $works[$key]->sum = 0;
            }
        }
        foreach ($works as $key => $work) {
            $wp_comment = WorkComment::where('wp_id', $work->id)->count('wp_id');
            if ($wp_comment != null) {
                $works[$key]->count = $wp_comment;
            } else {
                $works[$key]->count = 0;
            }
        }

        return response()->json($works);
    }
}
