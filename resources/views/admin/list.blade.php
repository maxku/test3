<h1 class="page-header">Records
    <div class="pull-right">
        <a href="javascript:ajaxLoad('admin/create')" class="btn btn-success pull-right"><i
                    class="glyphicon glyphicon-plus-sign"></i> New</a>
    </div>
</h1>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>
            <a href="javascript:ajaxLoad('admin/list?field=title&sort={{Session::get("record_sort")=="asc"?"desc":"asc"}}')">
                Title
            </a>
        </th>
        <th>
            <a href="javascript:ajaxLoad('admin/list?field=author_id&sort={{Session::get("record_sort")=="asc"?"desc":"asc"}}')">
                Author
            </a>
        </th>
        <th>
            <a href="javascript:ajaxLoad('admin/list?field=pub_date&sort={{Session::get("record_sort")=="asc"?"desc":"asc"}}')">
                Publication date
            </a>
        </th>
        <th width="140px"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $key=>$record)
        <tr>
            <td>{{$record->title}}</td>
            <td><?php if ($author = $authors->find($record->author_id))
                    echo $author->name;?></td>
            <td>{{$record->pub_date}}</td>
            <td style="text-align: center">
                <a class="btn btn-primary btn-xs" title="Edit"
                   href="javascript:ajaxLoad('/admin/update/{{$record->id}}')">
                    <i class="glyphicon glyphicon-edit"></i> Edit</a>
                <a class="btn btn-danger btn-xs" title="Delete"
                   href="javascript:if(confirm('Are you sure want to delete?')) ajaxLoad('/admin/delete/{{$record->id}}')">
                    <i class="glyphicon glyphicon-trash"></i> Delete
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="pull-left">{!! str_replace('/?','?',$records->render()) !!}</div>

<script>
    $('.pagination a').on('click', function (event) {
        event.preventDefault();
        ajaxLoad($(this).attr('href'));
    });
</script>