<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\KursusMurid;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\ResponseFormatterController;
use Illuminate\Support\Facades\Http;

class KelasController extends Controller
{
    public function index()
    {
        $kursus = Kursus::withCount(['mentors', 'students'])
            ->latest()
            ->get();
        $kursus->map(function ($item) {
            $item->thumbnail = $item->getFirstMediaUrl('kursus-thumbnail');
            unset($item->media);
            return $item;
        });
        return ResponseFormatterController::success($kursus, 'Berhasil mendapatkan data kursus');
    }

    public function getKursusBySlug($slug)
    {
        $kursus = Kursus::whereSlug($slug)->whereIsPublished(true)->first();

        if(!$kursus) {
            return ResponseFormatterController::error('Kursus tidak ditemukan', 404);
        }

        return ResponseFormatterController::success($kursus, 'Berhasil mendapatkan data kursus');
    }

    public function checkIfKursusIsCreatedByUser($slug)
    {
        $kursus = Kursus::whereSlug($slug)->first();
        if(!$kursus) {
            return ResponseFormatterController::error('Kursus tidak ditemukan', 404);
        }

        $user = Http::user()->get('/auth/me')->json()['data'];
        if(in_array($user['id'], $kursus->mentors()->pluck('kursus_id')->toArray()))
        {
            return ResponseFormatterController::success([
                'is_mentor' => true
            ], 'Kursus ini dibuat oleh user');
        } else {
            return ResponseFormatterController::success([
                'is_mentor' => false
            ], 'Kursus ini tidak dibuat oleh user');
        }
    }

    public function checkIfStudentIsEnrolledToCourse($slug)
    {
        $user = Http::user()->get('/auth/me')->json()['data'];
        $kursus = Kursus::whereSlug($slug)->first();
        
        if(!$kursus) {
            return ResponseFormatterController::error('Kursus tidak ditemukan', 404);
        }

        $studentIsEnrolledToCourse = KursusMurid::whereKursusId($kursus->id)
            ->whereStudentId($user['id'])
            ->exists();

        if($studentIsEnrolledToCourse) {
            return ResponseFormatterController::success([
                'is_enrolled' => true
            ], 'User sudah terdaftar di kursus ini');
        } else {
            return ResponseFormatterController::success([
                'is_enrolled' => false
            ], 'User belum terdaftar di kursus ini');
        }
    }

    public function enrollStudentToCourse($slug)
    {
        $user = Http::user()->get('/auth/me')->json()['data'];
        $kursus = Kursus::whereSlug($slug)->first();
        
        KursusMurid::firstOrCreate([
            'student_id' => $user['id'],
            'kursus_id' => $kursus->id,
        ]);

        return ResponseFormatterController::success(null, 'Berhasil mendaftarkan siswa ke kursus');
    }
}
