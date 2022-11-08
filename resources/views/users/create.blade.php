<x-Header/>
<div class="row py-2">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New User</h2>
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
<form method="POST" action="{{ route('users.store') }}"> 
    @csrf
    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
        </div>
    </div> 
    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>
    </div> 
    <div class="row mb-3">
        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" value="" required>
        </div>
    </div> 
    <div class="row mb-3">
        <label for="password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="confirm-password" value="" required>
        </div>
    </div> 
    
    <div class="row mb-3">
        <label for="password" class="col-md-4 col-form-label text-md-right">Role</label>
        <div class="col-md-6">
           <select class="form-control" name="roles[]" >
               @foreach($roles as $key=>$value)
               <option value="{{$value}}">{{$value}}</option>
               @endforeach
           </select>
        </div>
    </div> 

    <div class="row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">Submit</button>           
        </div>
    </div>
</form>

<x-Footer/>
</body>
</html>
