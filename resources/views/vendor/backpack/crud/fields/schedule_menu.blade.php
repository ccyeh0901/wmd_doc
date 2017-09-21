<!-- 行程菜單的欄位 -->

<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>


    {{--這邊要把 json資料做分析， 然後做結構化的呈現！--}}

    <?php /*xdebug_break()*/?>


    @foreach ( reset($field['value']) as $key => $var )

        <hr>{{$key}}<hr>
        {{--{{var_dump($var['value'])}}--}}


        <div class="set">
            @foreach ($var['value'] as $k => $v)
                <div class="row input-group col-sm-12">
                    {{--{{$v['name']}} <br>--}}
                    <input type="text"
                           name="{{ $var['name']}}[]"
                           value="{{$v['name']}}"
                            @include('crud::inc.field_attributes') {{--加入attribute的設定--}}
                    >
                    <span class="input-group-btn"><button class="btn btn-default delete_item" type="button">刪除</button></span>

                </div>
            @endforeach

            <button class="btn btn-primary add_item" type="button">+增加項目</button>
        </div>



    @endforeach

    <input type="text"
            name="{{ $field['name'] }}"
            value="{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? json_encode($field['value']) : (isset($field['default']) ? $field['default'] : '' )) }}"
            @include('crud::inc.field_attributes') {{--加入attribute的設定--}}
    style="display: none;">

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p> {{--加入提示的設定--}}
    @endif
</div>


@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    {{-- FIELD EXTRA CSS  --}}
    {{-- push things in the after_styles section --}}

    @push('crud_fields_styles')
        <!-- no styles -->
        <style>
            div.set{
                margin:10px;
            }

            div.set > button {
                margin:10px;
            }


        </style>

    @endpush


    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}

    @push('crud_fields_scripts')
        <!-- no scripts -->
        <script>
            jQuery(document).ready(function($) {
                $(".btn.delete_item").on('click', function(e) {
                    var row = $(this).parent().parent();
                    row.remove();
                });


                $(".btn.add_item").on('click', function(e) {
                    var row = $(this).parent().children(".row").last();
                    var inputname = row.children('input').attr("name");
                    //set.after("<div class='list_block'><input type='checkbox' id='inlist_" + num + "' name='invited[]' value='" + item + "' /> " + item + "</div>");
                    row.after('<div class="row input-group col-sm-12"> <input type="text" name="'+ inputname +   '" value="" class="form-control"> <span class="input-group-btn"><button class="btn btn-default delete_item" type="button">刪除</button></span></div>');

                });



            });

        </script>

    @endpush
@endif

{{-- Note: most of the times you'll want to use @if ($crud->checkIfFieldIsFirstOfItsType($field, $fields)) to only load CSS/JS once, even though there are multiple instances of it. --}}