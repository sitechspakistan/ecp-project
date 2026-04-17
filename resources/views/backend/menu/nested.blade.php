@foreach($childrens as $k => $child)                                
    @component('backend.menu.menu-item',['meta'=>$child, 'type'=>$child->type, 'rand'=>$child->id]) @endcomponent
@endforeach