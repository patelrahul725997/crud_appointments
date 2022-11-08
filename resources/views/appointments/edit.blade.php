<x-Header/>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Appointments</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('appointments.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <?php //dd($appointments); ?>
    <form action="{{ route('appointments.update',$appointments->id) }}" method="POST">
    	@csrf
        @method('PUT')
         <div class="row">
            <div class="row mb-3">
                <label for="patient" class="col-md-4 col-form-label text-md-right">Patient Name</label>
                <div class="col-md-6">
                     <input type="text" name="patient" value="{{ $appointments->patient }}" class="form-control" placeholder="Patient Name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-right">Category</label>
                <div class="col-md-6">
                    <select name="category" class="form-control">
                        <option selected disabled >Select Category </option>
                        <option value="doctor" @if($appointments->category == "doctor") {{ "selected "}} @endif>Doctor</option>
                        <option value="category 1" @if($appointments->category == "category 1") {{ "selected "}} @endif>Category 1</option>
                        <option value="category 2" @if($appointments->category == "category 2") {{ "selected "}} @endif>Category 2</option>
                    </select>    
                </div>
            </div>           
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-right">Start time</label>
                <div class="col-md-6">
                <div class="input-group date" data-provide="datepicker">
                    <input type="time" name="stime" value="{{ $appointments->stime }}" class="form-control">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>                    
                </div>
            </div> 
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-right">End time</label>
                <div class="col-md-6">
                <div class="input-group date" data-provide="datepicker">
                    <input type="time" name="etime" value="{{ $appointments->etime }}" class="form-control">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>                    
                </div>
            </div> 		 		    
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>


<x-Footer/>
</body>
</html>