<div class='col-md-{{$size or '6'}}'>
    <!-- Box -->
    <div class="box box-{{$header_class or 'primary'}} @if(!empty($collapsed)) collapsed-box @endif">
        <div class="box-header with-border">
            <h3 class="box-title">{{$title or 'Widget title'}}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool {{$collapsible or 'hide'}}" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa @if(empty($collapsed))fa-minus @else fa-plus @endif"></i></button>
                <button class="btn btn-box-tool {{$removable or 'hide'}}" data-widget="remove" data-toggle="tooltip"
                        title="Remove"><i
                            class="fa fa-times"></i></button>
            </div>
            <div class="btn-toolbar pull-right clear">
                {{$buttons or ""}}
            </div>
        </div>
        @if(!empty($body))
            <div class="box-body">
                {{$body or 'Empty content'}}
            </div><!-- /.box-body -->
        @endif
        @if(!empty($footer))
            <div class="box-footer">
                {{$footer or ''}}
            </div><!-- /.box-footer-->
        @endif
    </div><!-- /.box -->
</div><!-- /.col -->