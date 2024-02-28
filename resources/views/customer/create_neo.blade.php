<x-master-layout>
    <style>
        .cardd {
            box-shadow: 0 10px 30px 0 rgba(0, 0, 0, 0) !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">Add New Neopreneur</h5>
                            <a href="{{ route('user.index') }}" class="float-right btn btn-sm btn-primary"><i
                                    class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @if($auth_user->can('user list'))
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($customerdata,['method' => 'POST','route'=>'user.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'user'] ) }}
                        {{ Form::hidden('id') }}
                        {{ Form::hidden('user_type','Neopreneur') }}
                        <input type="hidden" name="referal_code" id="referal_code" />
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('first_name',__('messages.first_name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('first_name',old('first_name'),['placeholder' => __('messages.first_name'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('last_name',__('messages.last_name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('last_name',old('last_name'),['placeholder' => __('messages.last_name'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('username',__('messages.username').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('username',old('username'),['placeholder' => __('messages.username'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            @if(auth()->user()->hasAnyRole(['admin','demo_admin']))
                            <div class="form-group col-md-4">
                                {{ Form::label('user_type',__('messages.user_type').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                <select class='form-control select2js' id='user_type' name="user_type" disabled>
                            
                                    @foreach($roles as $value)
                                    <option value="{{$value->name}}" data-type="{{$value->id}}"
                                        {{ "Neopreneur" == $value->name ? 'selected' : '' }}>
                                        {{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="form-group col-md-4">
                                {{ Form::label('email', __('messages.email').' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::email('email', old('email'), ['placeholder' => __('messages.email'), 'class' => 'form-control', 'required', 'pattern' => '[^@]+@[^@]+\.[a-zA-Z]{2,}', 'title' => 'Please enter a valid email address']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>


                            @if (!isset($customerdata->id) || $customerdata->id == null)
                            <div class="form-group col-md-4">
                                {{ Form::label('password', __('messages.password').' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('messages.password'), 'required', 'autocomplete' => 'new-password']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            @endif

    
                            <div class="form-group col-md-4">
                                {{ Form::label('contact_number',__('messages.contact_number').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('contact_number',old('contact_number'),['placeholder' => __('messages.contact_number'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('status',__('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'class' =>'form-control select2js','required']) }}
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('address',__('messages.address'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('address', null, ['class'=>"form-control textarea" , 'rows'=>1  , 'placeholder'=> __('messages.address') ]) }}
                            </div>
                            
                        </div>

                        {{ Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary float-right']) }}
                        {{ Form::close() }}
                    </div>
                    
                </div>
            </div>
        </div>
        @if($customerdata->id)
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex p-3 ">
                                <h5 class="font-weight-bold">Tag Neopreneur Upline</h5>
                            </div>
                            <div class="form-group col-md-4">
                                <lavel cclass="form-control-label">Upline name</lavel>
                                <input type="text" class ="form-control" id="inputNeo" /> 
                            </div>
                            <div id="pangErrorNeo">
                                
                            </div>
                            <div id="neoAccordionSearch">
                                <div class="card">
                                    <div class="card-header" id="neoAcjabuid">
                                        
                                    </div>
                                    <div id="collapseAccjabuid" class="collapse " aria-labelledby="neoAcjabuid" data-parent="#neoAccordionSearch">
                                        <div class="card-body">
                                            <span><b></b></span><br>
                                            <span>Name: </span><br>
                                            <span>Contact no.: </span><br>
                                            <span>Email: </span><br>
                                            <span>Address: </span><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="neoAccordion">
                                @if(isset($userupline->id))
                                    <div class="card">
                                        <div class="card-header" id="neoAc{{ $userupline->id }}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseAcc{{ $userupline->id }}" aria-expanded="true" aria-controls="collapseAcc{{ $userupline->id }}">
                                                    Name: {{$userupline->first_name}} {{$userupline->last_name}}
                                                </button>
                                                <button class="btn btn-danger float-right" onClick="removeUpline('{{ $customerdata->id }}');">
                                                    Remove
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseAcc{{ $userupline->id }}" class="collapse " aria-labelledby="neoAc{{ $userupline->id }}" data-parent="#neoAccordion">
                                            <div class="card-body">
                                                <span><b>{{$userupline->user_type}}</b></span><br>
                                                <span>Name: {{$userupline->first_name}} {{$userupline->last_name}}</span><br>
                                                <span>Contact no.: {{$userupline->contact_number}}</span><br>
                                                <span>Email: {{$userupline->email}}</span><br>
                                                <span>Address: {{$userupline->address}}</span><br>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-md btn-primary float-right" id="taguplineBtn" >Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex p-3 ">
                                    <h5 class="font-weight-bold">Search Service Provider</h5>
                            </div>
                            <div class="input-group ml-2 mb-2">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control " placeholder="Search..." id="searchNeo">
                                <input type="hidden" value="{{ $customerdata->referal_code }}" id="neo_referal_code">
                                <input type="hidden" value="{{ $customerdata->id }}" id="neo_id">
                            </div>
                            <div id="pangError">
                                
                            </div>
                            <div id="accordion">
                                <div id="searchContent">
                                    
                                </div>
                                <div id="alertAdd">
                                    
                                </div>
                                <hr>
                                <div class="d-flex p-3 ">
                                    <h5 class="font-weight-bold">Service Provider List</h5>
                                </div>
                                <div id="neoList">
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>  
            
            </div>
        @endif
        
    </div>
</x-master-layout>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on('keyup', '.contact_number', function() {
        var contactNumberInput = document.getElementById('contact_number');
        var inputValue = contactNumberInput.value;
        inputValue = inputValue.replace(/[^0-9+\- ]/g, '');
        if (inputValue.length > 15) {
            inputValue = inputValue.substring(0, 15);
            $('#contact_number_err').text('Contact number should not exceed 15 characters');
        } else {
                $('#contact_number_err').text('');
        }
        contactNumberInput.value = inputValue;
        if (inputValue.match(/^[0-9+\- ]+$/)) {
            $('#contact_number_err').text('');
        } else {
            $('#contact_number_err').text('Please enter a valid mobile number');
        }
    });
    function makeid(length) {
        var result           = 'AYS-';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
    $('#referal_code').val(makeid(6));
    $('#taguplineBtn').css('display', '{{ isset($customerdata->upline) ? "none" : "block"}}')
    $('#taguplineBtn').attr('disabled', true)
    $('#taguplineBtn').on('click', () => {
        console.log('asd')
        var vdata = {
            email: $('#inputNeo').val(),
            refid: $('#neo_referal_code').val(),
            userid: "{{ $customerdata->id }}"
        }
        $.ajax({
            type: 'POST',
            url: '{{ route("booking.add_neo_tag") }}',
            data: vdata,
            dataType: 'JSON',
            success: function(data) {
                // console.log(data);
                var nData = data.data;
                console.log(nData)
                if(data.status == "error"){
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "error",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    // $('#taguplineBtn').attr('disabled', true)
                }else{
                    $('#pangErrorNeo').html("")
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Your work has been saved",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(()=>{
                        location.reload();
                    });
                    
                }
            }
        });
    })
    $('#inputNeo').on('keyup', () => {
        var vdata = {
            email: $('#inputNeo').val(),
        }
        $.ajax({
            type: 'GET',
            url: '{{ route("booking.search_neo_tagged") }}',
            data: vdata,
            dataType: 'JSON',
            success: function(data) {
                console.log(data)
                var nData = data.data;
                console.log(nData)
                if(data.status == "error"){
                    $('#pangErrorNeo').html("")
                    $('#pangErrorNeo').append(`<label class="text-danger ml-2">Email not found !</label>`)
                    $('#taguplineBtn').attr('disabled', true)
                }else{
                    $('#pangErrorNeo').html("")
                    $('#pangErrorNeo').append(`<label class="text-success ml-2">Email matched !</label>`)
                    $('#taguplineBtn').attr('disabled', false)
                }
            }
        });
    })
    $('#searchNeo').on('keyup', function(e){
        var vdata = {
            email: $('#searchNeo').val(),
            id: $('#neo_referal_code').val(),
            neo_id: $('#neo_id').val()
        }
        if(e.keyCode == 13)
        {
            $.ajax({
            type: 'GET',
            url: '{{ route("booking.search_neo") }}',
            data: vdata,
            dataType: 'JSON',
            success: function(data) {
                console.log(data);
                var nData = data.data;
                console.log(nData)
                if(data.status == "error"){
                   $('#pangError').html("")
                   $('#searchContent').html("") 
                   $('#pangError').append(`<label class="text-danger ml-2">Email not found !</label>`)
                   
                }else{
                    $('#pangError').html("")
                    $('#searchContent').html("")
                    $('#pangError').append(`<label class="text-success ml-2">Email matched !</label>`)
                    $('#searchContent').append(`
                                <div class="card">
                                    <div class="card-header" id="heading${nData.id}">
                                        <h5>
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#data${nData.id}" aria-expanded="true" aria-controls="data${nData.id}">
                                              ${nData.first_name} ${nData.last_name}
                                            </button>
                                            <button class="btn btn-primary float-right addTag" data-data-tagid="${nData.id}" onClick="addTag('${nData.id}', '{{ $customerdata->referal_code }}', '{{ $customerdata->id }}');">
                                                Add
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="data${nData.id}" class="collapse " aria-labelledby="heading${nData.id}" data-parent="#accordion">
                                      <div class="card-body">
                                        <span>Name: ${nData.first_name} ${nData.last_name}</span><br>
                                        <span>Contact no.: ${nData.contact_number}</span><br>
                                        <span>Email: ${nData.email}</span><br>
                                        <span>Address: ${nData.address}</span><br>
                                      </div>    
                                    </div>
                                </div>`)
                }
                
              
            }
        });
        }
        
    })
    function addTag(dataa, dataid, neoid){
        $('#alertAdd').html("")
        var token = "{{ csrf_token() }}";
        var ndata = {
            tagId: dataa,
            refId: dataid,
            neo_id: neoid,
            _token: token
        }
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, add it!"
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({     
                type: 'POST',
                url: '{{ route("booking.add_neo") }}',
                data: ndata,
                dataType: 'JSON',
                success: function(data){
                    if(data.status == "success"){
                        $('#alertAdd').append(`
                            <div class="alert alert-success ml-2" role="alert">
                              Successfully Added !
                            </div>`)
                        $('#searchContent').html("")
                        neoList("{{ $customerdata->referal_code }}");
                        setTimeout(()=>{
                            $('#alertAdd').html("")
                            
                        }, 2000)
                    }else{
                        $('#alertAdd').append(`
                            <div class="alert alert-danger ml-2" role="alert">
                              Failed !
                            </div>`)
                        setTimeout(()=>{
                            $('#alertAdd').html("")
                        }, 2000)
                    }
                    console.log(data)
                   
                }
            })
            // Swal.fire({
            //   title: "Deleted!",
            //   text: "Your file has been deleted.",
            //   icon: "success"
            // });
          }
        });
        
         
    }
    function removeUpline(id){
        var token = "{{ csrf_token() }}";
        var ndata = {
            id: id,
            _token: token
        }
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, Remove it!"
        }).then((result) => {
          if (result.isConfirmed) {
           $.ajax({     
                type: 'POST',
                url: '{{ route("booking.remove_neo_upline") }}',
                data: ndata,
                dataType: 'JSON',
                success: function(data){
                    if(data.status == "success"){
                        $('#pangErrorNeo').append(`
                            <div class="alert alert-success ml-2" role="alert">
                              Successfully Removed !
                            </div>`)
                        neoList("{{ $customerdata->referal_code }}");
                        $('#neoAccordion').html("");
                        setTimeout(()=>{
                            $('#pangErrorNeo').html("")
                        }, 2000)
                    }else{
                        $('#pangErrorNeo').append(`
                            <div class="alert alert-danger ml-2" role="alert">
                              Failed !
                            </div>`)
                        setTimeout(()=>{
                            $('#pangErrorNeo').html("")
                        }, 2000)
                    }
                    console.log(data)
                   
                }
            })
          }
        })
    }
    function removeTag(dataa, dataid){
        $('#alertAdd').html("")
        var token = "{{ csrf_token() }}";
        var ndata = {
            tagId: dataa,
            refId: dataid,
            _token: token
        }
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, Remove it!"
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({     
                type: 'POST',
                url: '{{ route("booking.remove_neo") }}',
                data: ndata,
                dataType: 'JSON',
                success: function(data){
                    if(data.status == "success"){
                        $('#alertAdd').append(`
                            <div class="alert alert-success ml-2" role="alert">
                              Successfully Removed !
                            </div>`)
                        neoList("{{ $customerdata->referal_code }}");
                        setTimeout(()=>{
                            $('#alertAdd').html("")
                        }, 2000)
                    }else{
                        $('#alertAdd').append(`
                            <div class="alert alert-danger ml-2" role="alert">
                              Failed !
                            </div>`)
                        setTimeout(()=>{
                            $('#alertAdd').html("")
                        }, 2000)
                    }
                    console.log(data)
                   
                }
            })
          }
        });
        
    }
    function neoList(id){
        $('#neoList').html("")
        var vdata = {
            id: id
        }
        $.ajax({
            type: 'GET',
            url: '{{ route("booking.neo_tagged") }}',
            data: vdata,
            dataType: 'JSON',
            success: function(data) {
                var nData = data.data;
                if(data.status == "error"){
                    console.log('wala')
                }else{
                    console.log(nData)
                    nData.forEach((element) => {
                        $('#neoList').append(`
                            <div class="card">
                                <div class="card-header" id="tagged${element.id}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapsetagged${element.id}" aria-expanded="true" aria-controls="collapseOne">
                                            Name ${element.first_name} ${element.last_name}
                                        </button>
                                        <button class="btn btn-danger float-right" onClick="removeTag('${element.id}', '{{ $customerdata->referal_code }}');">
                                            Remove
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapsetagged${element.id}" class="collapse " aria-labelledby="tagged${element.id}" data-parent="#accordion">
                                    <div class="card-body">
                                        <span>Name: ${element.first_name} ${element.last_name}</span><br>
                                        <span>Contact no.: ${element.contact_number}</span><br>
                                        <span>Email: ${element.email}</span><br>
                                        <span>Address: ${element.address}</span><br>
                                    </div>
                                </div>
                            </div>`); 
                    });
                }
                
              
            }
        });
        
        
    }
    neoList("{{ $customerdata->referal_code }}");
    
    
        
</script>