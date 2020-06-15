<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Support\Facades\Gate;

class ImagesController extends Controller
{
    const SMALL_WIDTH = 300;
    const MEDIUM_WIDTH = 500;
    const THUMB_WIDTH = 600;
    const PIC_NORIGHTS_JPG = 'no_rights.jpg';

    public function view($type, $id, $size)
    {
        $addWatermark = false;
        switch ($type) {
            case 's':
                $modelClass = '\\App\\Models\\Set';
                break;
            case 'i':
                $modelClass = '\\App\\Models\\Item';
                break;
        }


        $model = $modelClass::where('id', $id)->with('images')->with('collections')->first();
        $image = $model->images()->first();


        $allowedToShow = $this->allowedToShow($model, $image, $size);

        if ($allowedToShow) {
            $url = $image->url();
            $addWatermark = $this->addWatermark($image);
        } else {
            $url = self::PIC_NORIGHTS_JPG;
        }


        //  $image = ImageModel::find($id);
        //    $url = $image->url();
        $url = str_replace(" ", "%20", $url);

        if(!file_exists($url)){
          //  $this->saveImage($url); //YOU may save it to test the speed
            $url='http://cja.huji.ac.il/' . $url;
        }

        $img = \Image::make($url);

        switch ($size) {
            case 'small':
                $width = self::SMALL_WIDTH;
                break;
            default:
                $width = self::MEDIUM_WIDTH;
                break;
        }

        if ($size != 'original') {
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        if ($addWatermark && $size !='small') {
            $wm = \Image::make('cr_wm.png');

            $ratio = round($img->width() / $wm->width());
            $wm->resize(($wm->width() * $ratio / 3), null, function ($constraint) {
                $constraint->aspectRatio();
            });
            //  dd($ratio);
            //    if($size !='small'){
            $img->insert($wm, 'top-left', 0, 0);
            //    }
        }



        return $img->response('jpg');
    }

    public function saveImage($url)
    {
        $img_file='http://cja.huji.ac.il/' . $url;
        // dd($img_file);
        $img_file=file_get_contents($img_file);
        $file_loc=$_SERVER['DOCUMENT_ROOT'].'/'.$url;

        $dirname = dirname($file_loc);
        if (!is_dir($dirname)) {
            if (!@mkdir($dirname, 0777, true)) {
                $error = error_get_last();
                dd($error['message']);
            }
        }

        $file_handler=fopen($file_loc, 'w');

        if (fwrite($file_handler, $img_file)==false) {
            echo 'error';
        }

        fclose($file_handler);
    }

    /**
     * @return boolean
     */
    public function allowedToShow($model, $image, $size)
    {
        if (Gate::allows('has-account')) {
            return true; //TODO : PERMISSIONS FOR USERS
        }
            $img_rights = $image->rights;
        if(empty($img_rights) || $img_rights == 2){
         //   $collection = $model->collections()->first();
            $collection = $model->getCollections()->first();
            if(!empty($collection)){
                $img_rights = $collection->rights;
            }
        }

        if (empty($img_rights)) {
            return true; // TODO clear this
        }

        switch ($size) {
            case 'original': case 'thumb': return (bool)$img_rights [2];
            case 'medium': return (bool)$img_rights [1];
            case 'small': return (bool)$img_rights [0];
        }
    }

    public function addWatermark($image)
    {
        if (Gate::allows('has-account')) {
            return false; //TODO : PERMISSIONS FOR USERS
        }
        if (empty($image->copyright)) {
            return true;
        }
        $noCJAWatermarkCopirights = array('/wiki/i','/kunstkamera/i', '/Virtual Shtetl/i', '/Ajuntament/i', '/IS PAN/i', '/Tel Aviv Museum of Art/i'); //List of copirights with wich watermark will BE NOT applied (TODO: mov o separate file)

        $copyright=$image->copyright->name;

        foreach ($noCJAWatermarkCopirights as $term) {
            if (preg_match($term, $copyright)) {
                return false;
            }
        }
        return true;
    }
    public function show(Item $item)
    {
        $item->loadMissing(['children', 'parent']);
        return response()->json($item);
    }
}
