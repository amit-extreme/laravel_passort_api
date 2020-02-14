<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }

    public function index()
    {

    }
}
