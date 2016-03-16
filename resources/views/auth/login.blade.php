@include('layout.header')
<div class="row">
    <div class="col-lg-4 col-lg-offset-4 ">
        <h1>User login</h1>
        <?php
        if(isset($errors) && $errors != null){?>
        <b style="color:red;">
            <?php echo $errors;?>
        </b>
        <?php
        }

        if(isset($success) && $success != null){?>
        <b>
            <?php echo $success;?>
        </b>
        <?php
        }
        ?>

        {{ Form::open(array('method'=>'post')) }}
        <p>
            {{ Form::label('login', 'Login') }}<br>
            {{ Form::text('login', null, array('class'=>'form-control', 'placeholder'=>'login', 'required')) }}
        </p>
        <p>
            {{ Form::label('password', 'Password') }}<br>
            {{ Form::password('password', array('class'=>'form-control','required')) }}
        </p>
        <p>
            {{ Form::label('remember', 'Remember me') }}<br>
            {{ Form::checkbox('remember', 1) }}
        </p>
        {{ Form::button("login", array('class'=>'btn','type'=>'submit')) }}
        {{ Form::close() }}
    </div>
</div>
@include('layout.footer')