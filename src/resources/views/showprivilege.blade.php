
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"><br>
              <div class="card card-success">
                  <div class="card-header"> 
                    <div class="icheck-default d-inline">
                      <input type="checkbox" id="checkall">
                      <label for="checkall"><h3 class="card-title">Check All</h3></label>
                    </div>
                  </div>
                </div>
            </div>

                {!! $mod !!}
                 
                        
        </div>
        <div class="row">
          {!! $hr !!}
          {!! $mod2 !!}          
        </div>
    </div>
</section>


<script>
          $('.singleSubMod').click(function() {
            const tabname = $(this).val();
            const name = $(this).attr('name')
            if ($(this).is(':checked')) {
                $('input[id='+tabname+']').prop('checked', true);
                const TotalName = $('input[name='+name+']').length;
                const a = TotalName - 1;
                const submoduleCheck =  $('input[name='+name+']').filter(':checked').length;
                if(submoduleCheck == a){
                  $('input[id='+name+']').prop('checked', true);
                }
            } else {
                $('input[id='+tabname+']').prop('checked', false);
                $('input[id='+name+']').prop('checked', false);
                
            }
          })

          $('#checkall').click(function() {
            const tabname = $(this).val();
            //console.log(tabname)
            if ($(this).is(':checked')) {
              $('input:checkbox').prop('checked', true);
            } else {
                $('input:checkbox').prop('checked', false);
            }
        });
        $('.selectall').click(function() {
            const tabname = $(this).val();
            //console.log(tabname)
            if ($(this).is(':checked')) {
              $('input[name='+tabname+']').prop('checked', true);
            } else {
                $('input[name='+tabname+']').prop('checked', false);
            }
        });

    </script>