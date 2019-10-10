<?php

use App\User;
use Carbon\Carbon;

use App\Models\Origin;
use App\Models\Subject;
use App\Models\Image;
use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Item::class, 10)->create();
        factory(Image::class, 10)->create();
        factory(Origin::class, 10)->create();
        factory(Subject::class, 10)->create();
//        factory(Category::class, 10)->create();
//        factory(Tag::class, 10)->create();
//        factory(User::class, 9)->create();
//        factory(Post::class, 25)->create();
//        factory(Comment::class, 40)->create();
//
//        $data = [];
//        for($i=0; $i<60; $i++) {
//            $data[] = [
//                'post_id'    => rand(1, 25),
//                'tag_id'     => rand(1, 10),
//                'created_at' => Carbon::now()->toDateTimeString(),
//                'updated_at' => Carbon::now()->toDateTimeString()
//            ];
//        }
//
//        DB::table('post_tag')->insert($data);
    }
}
