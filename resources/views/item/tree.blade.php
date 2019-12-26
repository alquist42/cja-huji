<div class="card mx-1 mb-4">
    <div class="card-header">
        Item Tree
    </div>
    <div class="card-body">
        @php
            $nodes = $item->leaf();

            $traverse = function ($categories, $prefix = '<li>', $suffix = '</li>') use (&$traverse, $item) {
                foreach ($categories as $category) {
                    $me = $category->id === $item->id ? '[ME] ' : '';
                    echo $prefix.'<a href="/'.request()->project.'/items/'.$category->id.'">'.$me.$category->name().'</a>'.$suffix;

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
