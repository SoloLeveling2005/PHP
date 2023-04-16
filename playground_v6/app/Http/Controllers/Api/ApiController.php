<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function games (Request $request) {
        $page = $request->get('page', 0);
        $size = $request->get('size', 10);
        $sortBy = $request->get('sortBy', 'title');  # popular / uploaddate
        $sortDir = $request->get('sortDir', 'asc');

        $games = Game::all();


    }
}
