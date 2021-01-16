

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                        <a class="nav-link" href="{{route('addpages')}}">Add Pages</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{route('showprivilege')}}">Show Privilege</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{route('assignprivilege')}}">Assign Privilege</a>
                        </li>
                    </ul>
                </nav> <br>
            </div>
        </div>
        <div class="row">            
            <div class="modal fade" id="newmodule">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title titlemodule">@if(session()->has('ban')) {{ 'Update Module' }}@else{{ 'Add Module'}}@endif</h4>
                    <button type="button" class="close modalclose" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{route('subaddmodule')}}" role="form" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="id" name="id" value="@if(session()->has('ban')){{session()->get('ban')->id}}@endif">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Module Name</label>
                                        <input type="text" name="module" value="@if(session()->has('ban')){{session()->get('ban')->module}}@endif{{old('module')}}" class="form-control module" placeholder="Enter ...">
                                    </div>
                                </div>                                 
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default modalclose" >Close</button>
                            <button type="submit" class="btn btn-primary btnmodule">@if(session()->has('ban')) {{ 'Update Module' }}@else{{ 'Add Module'}}@endif</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
          
           
            <div class="col-md-6">
                <button type="submit" class="btn btn-danger" style="margin-bottom: 10px;" data-toggle="modal" data-target="#newmodule"><i class="fas fa-plus"></i> Add New Module</button>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Module</h3>
                    </div>
                    <div class="card-body">
                        <table class="example1 table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Module</th>
                                    <th>Show-Hide</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                               {!! $tb !!}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
            
            <div class="col-md-6">
                <button type="submit" class="btn btn-danger" style="margin-bottom: 10px;" data-toggle="modal" data-target="#newsubmodule"><i class="fas fa-plus"></i> Add New Sub Module</button>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sub Module</h3>
                    </div>
                    <div class="card-body">
                        <table class="example1 table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Module</th>
                                    <th>Sub Module</th>
                                    <th>Show-Hide</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                               {!! $tb2 !!}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>           
        </div>
        <hr>
        <div class="row">

            <div class="modal fade" id="newsubmodule">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title titlemodule2">@if(session()->has('ban2')) {{ 'Update Sub Module' }}@else{{ 'Add Sub Module'}}@endif</h4>
                    <button type="button" class="close modalclose2" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{route('subaddsubmodule')}}" role="form" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" class="id2" value="@if(session()->has('ban2')){{session()->get('ban2')->id}}@endif">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Module </label>
                                        <select name="selmodule" class="form-control select2 selmodule"
                                            style="width: 100%;">
                                            @if(session()->has('ban3'))
                                                @if(session()->get('ban3') == '')                   
                                                    <option value="nomodule">No Module</option>
                                                @else
                                                    <option value="{{session()->get('ban3')->id}}">{{session()->get('ban3')->module}}</option>
                                                @endif
                                            @endif
                                            {!! $mod !!}                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Sub Module Name</label>
                                        <input type="text" name="submodule" value="@if(session()->has('ban2')){{session()->get('ban2')->submodule}}@endif{{old('submodule')}}" class="form-control submodule" placeholder="Enter ...">
                                    </div>
                                </div>                                 
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default modalclose2">Close</button>
                            <button type="submit" class="btn btn-primary btnmodule2">@if(session()->has('ban2')) {{ 'Update Sub Module' }}@else{{ 'Add Sub Module'}}@endif</button>
                        </div>
                    </form>

                </div>
                </div>
            </div>
           
            
        </div>
    </div>
</section>
<form method="post" action="{{route('delmodule')}}" class="sub_del">
    @csrf 
    <input type="hidden" class="id_val" name="id">
</form>
<form method="post" action="{{route('delsubmodule')}}" class="sub_del2">
    @csrf 
    <input type="hidden" class="id_val" name="id">
</form>

<form method="post" action="{{ route('hidemodule') }}" class="sub_unavail">
    @csrf
    <input type="hidden" class="p1id" name="id">
</form>
<form method="post" action="{{ route('showmodule') }}" class="sub_avail">
    @csrf
    <input type="hidden" class="p1id2" name="id">
</form>
<form method="post" action="{{ route('hidesubmodule') }}" class="sub_unavail2">
    @csrf
    <input type="hidden" class="p1id" name="id">
</form>
<form method="post" action="{{ route('showsubmodule') }}" class="sub_avail2">
    @csrf
    <input type="hidden" class="p1id2" name="id">
</form>

    <script>  
    
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        var id = $(this).val();
        const modulename = $(this).parent('div').parent('td').siblings('td').children('.modulename').val();
        if (window.confirm("Are you sure, you want to delete `"+modulename+"`?")) {
            $('input.id_val').attr('value', id);
            $('.sub_del').submit();
        }
    });
    $(document).on('click', '.delete2', function(e) {
        e.preventDefault();
        var id = $(this).val();
        const submodulename = $(this).parent('div').parent('td').siblings('td').children('.submodulename').val();
        if (window.confirm("Are you sure, you want to delete `"+submodulename+"`?")) {
            $('input.id_val').attr('value', id);
            $('.sub_del2').submit();
        }
    });       
    $(document).on('click', '.modalclose', function(e) {
        $('#newmodule').modal('hide')
        $('.id').val('')
        $('.module').val('')
        $('.btnmodule').html('Add Module')
        $('.titlemodule').html('Add Module')
    });
    $(document).on('click', '.upd', function(e) {
        e.preventDefault();
        var id = $(this).val();
        //$('input.upd_val').attr('value', id);
       // $('.sub_upd').submit();

        let token = $('.token').val();
        $.ajax({
            'url': '{{route('updmodule')}}',
            'type': 'post',
            data: {
                'id': id,
                _token: token            },
            success: function(msg) {
                $('#newmodule').modal('show')
                $('.id').val(msg.id)
                $('.module').val(msg.module)
                $('.btnmodule').html('Update Module')
                $('.titlemodule').html('Update Module')
            }
        });
    });     
    $(document).on('click', '.modalclose2', function(e) {
        $('#newsubmodule').modal('hide')
        $('.id2').val('')
        $('.fopt').remove()
        $('.submodule').val('')
        $('.btnmodule2').html('Add Sub Module')
        $('.titlemodule2').html('Add Sub Module')
    }); 
    $(document).on('click', '.upd2', function(e) {
        e.preventDefault();
        var id = $(this).val();
        // $('input.upd_val').attr('value', id);
        // $('.sub_upd2').submit();

        let token = $('.token').val();
        $.ajax({
            'url': '{{route('updsubmodule')}}',
            'type': 'post',
            data: {
                'id': id,
                _token: token            },
            dataType:'json',
            success: function(msg){
                console.log((msg[1]))
                $('#newsubmodule').modal('show')
                $('.id2').val(msg[0].id)
                $('.submodule').val(msg[0].submodule)
                $('.selmodule').html(msg[1])
                $('.btnmodule2').html('Update Sub Module')
                $('.titlemodule2').html('Update Sub Module')
            }
        });
    }); 
        $(document).on('click', '.available', function(e) {
            e.preventDefault();
            var id = $(this).val();
            const modulename = $(this).parent('td').siblings('td').children('.modulename').val();
            if (window.confirm("Are you sure, you want to Hide `"+modulename+"` Module?")) {
                $('input.p1id').attr('value', id);
                $('.sub_unavail').submit();
            }
        });
        $(document).on('click', '.unavailable', function(e) {
            e.preventDefault();
            var id = $(this).val();
            const modulename = $(this).parent('td').siblings('td').children('.modulename').val();
            if (window.confirm("Are you sure, you want to Show `"+modulename+"` Module?")) {
                $('input.p1id2').attr('value', id);
                $('.sub_avail').submit();
            }
        });
        $(document).on('click', '.available2', function(e) {
            e.preventDefault();
            var id = $(this).val();
            const submodulename = $(this).parent('td').siblings('td').children('.submodulename').val();
            if (window.confirm("Are you sure, you want to Hide `"+submodulename+"` Sub Module?")) {
                $('input.p1id').attr('value', id);
                $('.sub_unavail2').submit();
            }
        });
        $(document).on('click', '.unavailable2', function(e) {
            e.preventDefault();
            var id = $(this).val();
            const submodulename = $(this).parent('td').siblings('td').children('.submodulename').val();
            if (window.confirm("Are you sure, you want to Show `"+submodulename+"` Sub Module?")) {
                $('input.p1id2').attr('value', id);
                $('.sub_avail2').submit();
            }
        });
    </script>