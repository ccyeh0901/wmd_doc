{{-- Show the inputs 用foreach 依序秀出每個欄位 --}}
@foreach ($fields as $field)
    <!-- load the view from the application if it exists, otherwise load the one in the package -->
    @if(view()->exists('vendor.backpack.crud.fields.'.$field['type'])) {{--因這邊我們使用 schedule_menu 這個自訂的資料型態， 所以會去抓 schedule_menu.blade.php 這個檔案--}}
        @include('vendor.backpack.crud.fields.'.$field['type'], array('field' => $field))
    @else
        @include('crud::fields.'.$field['type'], array('field' => $field))
    @endif
@endforeach