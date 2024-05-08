<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscribes;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsletterController extends Controller
{
    use Searchable;
    function __construct(){
        $this->middleware(['permission: new letter']);
    }

    public function index(Request $request) : View {
        $query = Subscribes::query();

       $this->search($query, ['email']);

       $subscribes = $query->orderBy('id', 'DESC')->paginate(10);

        return view('admin.news-letter.index', compact(
            'subscribes'
        ));
    }

    public function destroy(string $id){
        try {
            $tag = Subscribes::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'Success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
