<!-- 行程菜單的欄位 -->

<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>


    {{--這邊要把 json資料做分析， 然後做結構化的呈現！--}}

    @if (!empty($field['value']))

        @foreach ( reset($field['value']) as $key => $var )


            {{--{{var_dump($var['value'])}}--}}


            <div class="sect">
                {{--{{$var['title']}}--}}

                {{--加入section 時段的修改 刪除--}}
                <div class="row input-group col-sm-12">

                    <input type="text"
                           name="sect_title{{$key}}"
                           value="{{$var['title']}}"
                            @include('crud::inc.field_attributes') {{--加入attribute的設定--}}
                    >
                    <span class="input-group-btn"><button class="btn btn-danger delete_sect"
                                                          type="button">刪除</button></span>

                </div>

                <hr>


                @foreach ($var['value'] as $k => $v)
                    <div class="row input-group col-sm-12">
                        {{--{{$v['name']}} <br>--}}

                        <input type="text"
                               name="sect{{$key}}[]"
                               value="{{$v['name']}}"
                                @include('crud::inc.field_attributes') {{--加入attribute的設定--}}
                        >
                        <span class="input-group-btn"><button class="btn btn-default delete_item"
                                                              type="button">刪除</button></span>

                    </div>
                @endforeach

                <button class="btn btn-primary add_item" type="button">+增加項目</button>
            </div>

            <hr size="20" style="height:10px; border-top: 3px solid #f55753;">



        @endforeach

        <button class="btn btn-info add_sect" type="button">＋增加時段</button>
    @else

    <!--放一個時段的樣板-->

        <hr size="20" style="height:10px; border-top: 3px solid #f55753;">
        <div class="sect">
            <div class="row input-group col-sm-12">
                <input type="text" placeholder="請輸入時段名稱" name="sect_title0" value="" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-danger delete_sect" type="button">刪除</button></span>
            </div>
            <hr>
            <div class="row input-group col-sm-12">
                <input type="text" placeholder="請輸入行程項目名稱" name="sect0[]" value="" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default delete_item" type="button">刪除</button>
                </span>
            </div>
            <button class="btn btn-primary add_item" type="button">+增加項目</button>
        </div>
        <hr size="20" style="height:10px; border-top: 3px solid #f55753;">
        <button class="btn btn-info add_sect" type="button">＋增加時段</button>
    @endif

    @if (isset($field['value']))

        <input type="text"
               name="{{ $field['name'] }}"
               value="{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? json_encode($field['value']) : (isset($field['default']) ? $field['default'] : '' )) }}"
               @include('crud::inc.field_attributes') {{--加入attribute的設定--}}
               style="display: none;">

    @else
        <input type="text"
               name="{{ $field['name'] }}"
               value="{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? json_encode($field['value']) : (isset($field['default']) ? $field['default'] : '' )) }}"
                @include('crud::inc.field_attributes') {{--加入attribute的設定--}}
        >

    @endif

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
            div.sect {
                margin: 10px;
            }

            div.sect > button {
                margin: 10px;
            }


        </style>

    @endpush


    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}

    @push('crud_fields_scripts')
        <!-- no scripts -->
        <script>
            jQuery(document).ready(function ($) {
                //$(".btn.delete_item").on('click', function(e) {
                $(document).on('click', '.delete_item', function (e) {
                    $(this).parent().parent().remove();
                });


                $(document).on('click', '.add_item', function (e) {
                    var row = $(this).parent().children(".row").last(); //抓出最後一列
                    var inputname = row.children('input').attr("name"); //延用之前的name
                    //sect.after("<div class='list_block'><input type='checkbox' id='inlist_" + num + "' name='invited[]' value='" + item + "' /> " + item + "</div>");
                    row.after('<div class="row input-group col-sm-12"> <input type="text" placeholder="請輸入行程項目名稱" name="' + inputname + '" value="" class="form-control"> <span class="input-group-btn"><button class="btn btn-default delete_item" type="button">刪除</button></span></div>');

                });


                $(".btn.add_sect").on('click', function (e) {

                    var last_row = $("div.sect").last(); //抓出最後一列

                    var num = $("div.sect").length;

                    var inputname = last_row.children('input').attr("name"); //延用之前的name
                    last_row.after('<hr size="20" style="height:10px; border-top: 3px solid #f55753;">' +
                        '<div class="sect"> <div class="row input-group col-sm-12"> ' +
                        '<input type="text" placeholder="請輸入時段名稱" name="sect_title' + num + '" value="" class="form-control"> ' +
                        '<span class="input-group-btn"><button class="btn btn-danger delete_sect" type="button">刪除</button></span> ' +
                        '</div> <hr> ' +
                        '<div class="row input-group col-sm-12"> <input type="text" placeholder="請輸入行程項目名稱" name="sect' + num + '[]" value="" class="form-control"> <span class="input-group-btn"><button class="btn btn-default delete_item" type="button">刪除</button></span></div>' +
                        '<button class="btn btn-primary add_item" type="button">+增加項目</button> </div>');

                });


                $(document).on('click', '.delete_sect', function (e) {
                    $(this).parent().parent().parent().remove();
                });


            });

        </script>

    @endpush
@endif

{{-- Note: most of the times you'll want to use @if ($crud->checkIfFieldIsFirstOfItsType($field, $fields)) to only load CSS/JS once, even though there are multiple instances of it. --}}