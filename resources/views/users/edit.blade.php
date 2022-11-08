<x-Header/>
<div class="row py-2">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit New User</h2>
        </div>
        <div class="pull-right mb-2">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif

<div class="container">
{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}

    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
        <div class="col-md-6">
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div> 
    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-right">Email</label>
        <div class="col-md-6">
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div> 
    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-right">Password</label>
        <div class="col-md-6">
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div> 
    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
        <div class="col-md-6">
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div> 
    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-right">Role</label>
        <div class="col-md-6">
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
        </div>
    </div>     
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
{!! Form::close() !!}
</div>

<x-Footer/>
</body>
</html>
