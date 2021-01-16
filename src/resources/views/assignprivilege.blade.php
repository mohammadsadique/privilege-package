
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
                        <li class="nav-item">
                        <a class="nav-link" href="{{route('addpages')}}">Add Pages</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{route('showprivilege')}}">Show Privilege</a>
                        </li>
                        <li class="nav-item active">
                        <a class="nav-link" href="{{route('assignprivilege')}}">Assign Privilege</a>
                        </li>
                    </ul>
                </nav> <br>
            </div>
        </div>
        <div class="row">            
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Assign Privilege</h3>
                    </div>
                    <div class="card-body">
                        <table class="example1 table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Email</th>
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
        </div>
    </div>
</section>
<form method="post" action="{{ route('subassignpri') }}" class="sub_pri">
    @csrf
    <input type="hidden" class="id" name="id">
</form>

    <script>  
    $(document).on('click', '.assignpri', function(e) {
        e.preventDefault();
        var id = $(this).val();
        const staffname = $(this).parent('td').siblings('td').children('.staffname').val();
        if (window.confirm("Are you sure, you want to Assign Privileges to `"+staffname+"`?")) {
            $('input.id').attr('value', id);
            $('.sub_pri').submit();
        }
    });


    </script>