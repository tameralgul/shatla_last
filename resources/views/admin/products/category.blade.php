@if ($products->category == null)
    لا يوجد تصنيف لهذا المنتج
    @else
   <span class="badge badge-primary">{{$products->category}}</span> 
@endif
