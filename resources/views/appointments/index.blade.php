<x-Header/>
<style type="text/css">
    .des{
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
    <div class="row py-2">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Appointments</h2>
            </div>
            <div class="pull-right mb-2">
                @can('appointments-create')
                <a class="btn btn-primary" href="{{ route('appointments.create') }}"> Create New Appointments</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p class="mb-0">{{ $message }}</p>
        </div>
    @endif

    <?php //dd($appointments->links()); ?>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Patient</th>
                <th>Category</th>
                <th>Status</th>
                @if(\Auth::user()->roles[0]->id == '1')
                <th>Change Status</th>
                @endif
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($appointments) > 0)
    	    @foreach ($appointments as $value)
            @php
            ($value->status == "3") && $status = 'danger';            
            ($value->status == "2") && $status = 'success';
            ($value->status == "1") && $status = 'info';  
            ($value->status == "3") && $statusTxt = 'Cancel';
            ($value->status == "2") && $statusTxt = 'Confirm';
            ($value->status == "1") && $statusTxt = 'Pending';           
            @endphp
           
    	    <tr>
    	        <td>{{ ++$i }}</td>
    	        <td>{{ $value->patient }}</td>
    	        <td>{{ $value->category }}</td>
    	        <td><button class="btn btn-sm btn-{{ $status }}"> {{ $statusTxt }} </button> </td>
    	        @if(\Auth::user()->roles[0]->id == '1')
                <td class="des">
                    @if($value->status != '1') 
                        <a class="btn btn-sm btn-outline-info" href="<?= url('/').'/change-status/'.$value->id.'/1'?>"> Pending </a>
                    @endif    
                    @if($value->status != '3')               
                        <a class="btn btn-sm btn-outline-danger" href="<?= url('/').'/change-status/'.$value->id.'/3'?>"> Cancel </a>   
                    @endif    
                    @if($value->status != '2')      
                    <a class="btn btn-sm btn-outline-success" href="<?= url('/').'/change-status/'.$value->id.'/2'?>">Confirm</a>
                    @endif
                </td>
                @endif
    	        <td>
                    <form action="{{ route('appointments.destroy',$value->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('appointments.show',$value->id) }}">Show </a>
                        @can('appointments-edit')
                        <a class="btn btn-primary" href="{{ route('appointments.edit',$value->id) }}">Edit</a>
                        <!-- <a class="btn btn-primary" href="{{ route('appointments.edit',$value->id) }}">Edit</a> -->
                        @endcan


                        @csrf
                        @method('DELETE')
                        @can('appointments-delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
    	        </td>
    	    </tr>
    	    @endforeach
            @else
            <tr>
    	        <td colspan="5">No Record Found </td>
            </tr>
            @endif
        </tbody>
    </table>
    
    {!! @$appointments->links() !!}


<x-Footer/>
</body>
</html>
