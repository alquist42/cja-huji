<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Set;
use App\Models\Image as ImageModel;

class ImagesController extends Controller
{
    const SMALL_WIDTH = 300;
    const MEDIUM_WIDTH = 500;
    const THUMB_WIDTH = 600;

    public function view($type,$id,$size)
    {
        switch ($type){
            case 's':
                $modelClass = '\\App\\Models\\Set';
                break;
            case 'i':
                $modelClass = '\\App\\Models\\Item';
                break;
        }
        $model = $modelClass::where('id',$id)->with('images')->with('collections')->first();
        $url = $model->images()->first()->url();

      //  $image = ImageModel::find($id);
    //    $url = $image->url();

        if(!file_exists($url)){
            $this->saveImage($url); //YOU may save it to test the speed
            $url='http://cja.huji.ac.il/' . $url;
        }

        $img = \Image::make($url);

        switch ($size){
            case 'small':
                $width = self::SMALL_WIDTH;
                break;
            default:
                $width = self::MEDIUM_WIDTH;
                break;
        }

        if($size != 'original'){
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $wm = \Image::make('cr_wm.png');

        $ratio = round($img->width() / $wm->width());
        $wm->resize(($wm->width() * $ratio / 3), null, function ($constraint) {
            $constraint->aspectRatio();
        });
      //  dd($ratio);
        if($size !='small'){
            $img->insert($wm,'top-left',0,0);
        }

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
            if (!@mkdir($dirname, 0777, true)) {
                $error = error_get_last();
                dd($error['message']);
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
