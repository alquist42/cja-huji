<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Image as ImageModel;

class ImagesController extends Controller
{
    public function index($id)
    {

        $image = ImageModel::find($id);
        $url = $image->url();

        if(!file_exists($url)){
            $this->saveImage($url);
        }

        $img = \Image::make($image->url());
        $img->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->insert('cr_wm.png','top-left',0,0);
        return $img->response('jpg');
    }

    public function saveImage($url){
        $img_file='http://cja.huji.ac.il/' . $url;
       // dd($img_file);
        $img_file=file_get_contents($img_file);
        $file_loc=$_SERVER['DOCUMENT_ROOT'].'/'.$url;

        $dirname = dirname($file_loc);
        if (!is_dir($dirname))
        {
            mkdir($dirname, 0777, true);

            if (!@mkdir($dirname, 0777, true)) {
                $error = error_get_last();
                echo $error['message'];
            }

        }

        $file_handler=fopen($file_loc,'w');

        if(fwrite($file_handler,$img_file)==false){
            echo 'error';
        }

        fclose($file_handler);
    }

    public function show(Item $item)
    {
        $item->loadMissing(['children', 'parent']);
        return response()->json($item);
    }
}
