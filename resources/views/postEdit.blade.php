@include('layout.header')


{!! Form::open(array('method'=>'post')) !!}

<div class="row">
    <div class='col-md-6 col-md-offset-3'>
        <h1 class="center">Edit post</h1>
        <br>
        <?php
        if(isset($errors) && $errors != null){?>
        <b style="color:red;">
            <?php echo $errors;?>
        </b>
        <?php
        }?>
        <div class="form-group">
            {{ Form::label('title', 'Name post') }}<br>
            {{ Form::text('title', $post->title , array('class'=>'form-control', 'required')) }}
        </div>
        <div class="form-group">
            {{ Form::label('startDate', 'Date') }}<br>
            <div class='input-group date' id='datetimepicker1'>
                {!! Form::text("startDate",  $post->start_post, array('class'=>'form-control')) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class='col-md-10 col-md-offset-1'>
        <div class="form-group">
            {{ Form::label('preview', 'Preview post') }}<br>
            {{ Form::textarea('preview', $post->preview , array('class'=>'form-control', 'required', 'id' => 'preview')) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Description post') }}<br>
            {{ Form::textarea('description', $post->description, array('class'=>'form-control', 'id' => 'description')) }}
        </div>
        <p class="center">
            <a class="btn" href="{{ URL::previous() }}" alt="back">
                < back
            </a>
            {!! Form::button("Save", array('class'=>'btn btn-primary', 'type'=>'submit')) !!}
        </p>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: "YYYY-MM-DD HH:mm",
            locale: 'en'
        });
    });
</script>
<script src="{{ URL::asset('../vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>

<script>
    CKEDITOR.replace( 'description',{
        language: 'en',
        filebrowserBrowseUrl: '{!! url('../public/upload') !!}'
    } );
    CKEDITOR.replace( 'preview',{
        language: 'en',
        filebrowserBrowseUrl: '{!! url('../public/upload') !!}'
    } );
</script>

@include('layout.footer')



