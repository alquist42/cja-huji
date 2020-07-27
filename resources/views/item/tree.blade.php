<?php
    $nodes = $item->leaf(false);
?>

@if(count($nodes[0]->children))
    <div class="card mx-1 mb-4">
        <div class="card-header">
            Item Composition
        </div>
        <div class="card-body">
            @php
                $traverse = function ($categories, $prefix = '<li>', $suffix = '</li>') use (&$traverse, $item) {
                    foreach ($categories as $category) {
                        $me = $category->id === $item->id ? '[ME] ' : '';
                        echo $prefix.'<a href="/'.request()->project.'/items/'.$category->id.'">'.$me.$category->name_in_tree().'</a>'.$suffix;

                        $hasChildren = (count($category->children) > 0);

                        if($hasChildren) {
                            echo('<ul>');
                        }

                        $traverse($category->children);

                        if($hasChildren) {
                            echo('</ul>');
                        }
                    }
                };

                $traverse($nodes);
            @endphp
        </div>
    </div>
@endif
