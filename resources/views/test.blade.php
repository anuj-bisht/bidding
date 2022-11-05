@foreach($category as $categories)
{{$categories->category}} >
@foreach ($categories->children as  $child)
{{$child->category}} >
@foreach ( $child->children as $subchild )
{{$subchild->category}}
@endforeach

@endforeach
@endforeach

<ul>
    @foreach($cat as $cats)
<li>{{$cats->category}}</li>
@if($cats->parent_id != 'null')
@foreach($cats->children as  $child)
&nbsp;&nbsp;&nbsp;{{$child->category}}
@endforeach
@endif
@if($child->parent_id != 'null')
@foreach($child->children as  $subchild)
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$subchild->category}}</li>
@endforeach
@endif
@endforeach
</ul>
