{{-- regular object attribute --}}
<td>{{--這邊可以修改欄位的樣板--}}{{ str_limit(strip_tags($entry->{$column['name']}), 80, "[...]") }}</td>