//item.index
<legend>未完成的Items</legend>
<ul id="uncompletedItemsList" class="list-group">
	@foreach ($uncompletedItems as $item)
	@include('item.show')
	@endforeach
</ul>
<hr>
<legend>完成的Items</legend>
<ul id="completedItemsList" class="list-group">
	@foreach ($completedItems as $item)
	@include('item.show')
	@endforeach
</ul>