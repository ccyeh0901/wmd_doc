{{-- regular object attribute --}}
<td>{{--這邊可以修改欄位的樣板--}}{{ str_limit(strip_tags(is_array($entry->{$column['name']})? key($entry->{$column['name']}):$entry->{$column['name']}), 80, "[...]") }}</td>