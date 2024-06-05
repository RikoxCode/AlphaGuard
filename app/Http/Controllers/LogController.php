<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogResource;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LogController extends Controller
{
    public function index()
    {
        return LogResource::collection(Log::get());
    }

    public function show(Log $log)
    {
        return LogResource::make($log);
    }

    public function store(Request $request, $res)
    {
        $ip = $request->ip();

        $ipinfos = Http::withHeaders([
            'Authorization' => $request->header('Authorization'),
        ])->get("https://api.geoapify.com/v1/ipinfo?ip=$ip&apiKey=5334e4085cf2410ca9ec0430d32a2348");

        $ipinfos = $ipinfos->json();

        $log = new Log();
        $log->user_agent = '' . $request->header('User-Agent') ?? 'N/A';
        $log->user_id = '' . auth()->id() || 'guest';

        if (array_key_exists('isPrivate', $ipinfos) && $ipinfos['isPrivate']){
            $log->location_continent = 'N/A';
            $log->location_country = 'N/A';
            $log->location_iso_code = 'N/A';
            $log->location_city = 'N/A';
        } else {
            $log->location_continent = '' . $ipinfos['continent']['names']['en'] || 'N/A';
            $log->location_country = '' . $ipinfos['country']['names']['en'] || 'N/A';
            $log->location_iso_code = '' . $ipinfos['country']['iso_code'] || 'N/A';
            $log->location_city = '' . $ipinfos['city']['names']['en'] || 'N/A';
        }

        $log->url = '' . $request->url();
        $log->method = '' . $request->method();
        $log->input = json_encode($request->all());
        $log->response = '' . json_encode($res);
        $log->status_code = '' . $res->getStatusCode();
        $log->response_time = '' . microtime(true) - LARAVEL_START;
        $log->response_size = '' . strlen(json_encode($res));
        $log->response_headers = '' . json_encode($request->headers->all());
        $log->request_headers = '' . json_encode($request->headers->all());
        $log->level = '' . $res->getStatusCode() >= 400 ? 'error' : ($res->getStatusCode() >= 300 ? 'warning' : 'info');
        $log->message = '' . $res->getStatusCode() . ' ' . $res->status();
        $log->context = '' . json_encode($request->all());
        $log->save();

        return LogResource::make($log);
    }

    public function destroy(Log $log)
    {
        $log->delete();
        return response()->noContent();
    }
}
