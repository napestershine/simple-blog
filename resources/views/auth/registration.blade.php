@include('layout.header')
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 ">
            <h1>Registration</h1>
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
                    {{ Form::label('name', 'Name') }}<br>
                    {{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'name', 'required')) }}
                </p>
                <p>
                    {{ Form::label('login', 'Login') }}<br>
                    {{ Form::text('login', null, array('class'=>'form-control', 'placeholder'=>'login', 'required')) }}
                </p>
                <p>
                    {{ Form::label('password', 'Password') }}<br>
                    {{ Form::password('password', array('class'=>'form-control', 'required')) }}
                </p>
                <p>
                    {{ Form::label('password_confirmation', ' Confirm password') }}<br>
                    {{ Form::password('password_confirmation', array('class'=>'form-control', 'required')) }}
                </p>
                {{ Form::button("Register", array('class'=>'btn', 'type'=>'submit')) }}
            {{ Form::close() }}
        </div>
    </div>
@include('layout.footer')