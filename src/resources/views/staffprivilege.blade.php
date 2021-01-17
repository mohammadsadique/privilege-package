<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
<style>
#snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 17px;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;} 
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;} 
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
</style>

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
<input type="hidden" class="staffid" value="{!! $staff->id !!}">
<div id="snackbar">Some text some message..</div>


    <script>
          $('.singleSubMod').click(function() {
            const tabname = $(this).val();
            const token = $('.token').val();
            const staffid = $('.staffid').val();
            const name = $(this).attr('name');
            let moduleid = '';
            if ($(this).is(':checked')) {
                $('input[id='+tabname+']').prop('checked', true);
                const TotalName = $('input[name='+name+']').length;
                const a = TotalName - 1;
                const submoduleCheck =  $('input[name='+name+']').filter(':checked').length;  console.log(TotalName)              
                if(submoduleCheck == a){
                  $('input[id='+name+']').prop('checked', true);
                  moduleid = name;
                }


                          $.ajax({
                              'url': '{{route('assignsubmodule')}}',
                              'type': 'post',
                              data: {
                                  'id': tabname,
                                  'staffid': staffid,
                                  'moduleid': moduleid,
                                  _token: token            },
                              success: function(msg) {
                                  if(msg == 1){
                                    const ms = 'Assign privileges successfully.';
                                    $('#snackbar').addClass('show');
                                    $('#snackbar').html(ms);
                                    setTimeout(function(){ $('#snackbar').removeClass('show');  } , 3000);                             
                                  }
                              }
                          });
            } else {
                $('input[id='+tabname+']').prop('checked', false);
                $('input[id='+name+']').prop('checked', false);
                moduleid = name;
                          $.ajax({
                              'url': '{{route('removesubmodule')}}',
                              'type': 'post',
                              data: {
                                  'id': tabname,
                                  'staffid': staffid,
                                  'moduleid': moduleid,
                                  _token: token            },
                              success: function(msg) { //console.log(msg)
                                  if(msg == 1){
                                    const ms = 'Remove privileges successfully.';
                                    $('#snackbar').addClass('show');
                                    $('#snackbar').html(ms);
                                    setTimeout(function(){ $('#snackbar').removeClass('show');  } , 3000);                             
                                  }
                              }
                          });
            }
          })


          $('#checkall').click(function() {
            const tabname = $(this).val();
            const token = $('.token').val();
            const staffid = $('.staffid').val();
            //console.log(tabname)
            if ($(this).is(':checked')) {
              $('input:checkbox').prop('checked', true);
              console.log(tabname)
                          $.ajax({
                              'url': '{{route('Allassignmodule')}}',
                              'type': 'post',
                              data: {
                                  'id': tabname,
                                  'staffid': staffid,
                                  _token: token            },
                              success: function(msg) { 
                                  if(msg == 1){ 
                                    const ms = 'All privileges assign successfully.';
                                    $('#snackbar').addClass('show');
                                    $('#snackbar').html(ms);
                                    setTimeout(function(){ $('#snackbar').removeClass('show');  } , 3000);                             
                                  }
                              }
                          });
            } else {
                $('input:checkbox').prop('checked', false);

                          $.ajax({
                              'url': '{{route('Allremovemodule')}}',
                              'type': 'post',
                              data: {
                                  'id': tabname,
                                  'staffid': staffid,
                                  _token: token            },
                              success: function(msg) { 
                                  if(msg == 1){ 
                                    const ms = 'All privileges remove successfully.';
                                    $('#snackbar').addClass('show');
                                    $('#snackbar').html(ms);
                                    setTimeout(function(){ $('#snackbar').removeClass('show');  } , 3000);                             
                                  }
                              }
                          });
            }
        });
        $('.selectall').click(function() {
            const tabname = $(this).val();
            const token = $('.token').val();
            const staffid = $('.staffid').val();
            // console.log(tabname)
            if ($(this).is(':checked')) {
              $('input[name='+tabname+']').prop('checked', true);
              
                          $.ajax({
                              'url': '{{route('assignmodule')}}',
                              'type': 'post',
                              data: {
                                  'id': tabname,
                                  'staffid': staffid,
                                  _token: token            },
                              success: function(msg) {
                                  if(msg == 1){
                                    const ms = 'Assign privileges successfully.';
                                    $('#snackbar').addClass('show');
                                    $('#snackbar').html(ms);
                                    setTimeout(function(){ $('#snackbar').removeClass('show');  } , 3000);                             
                                  }
                              }
                          });


            } else {
                $('input[name='+tabname+']').prop('checked', false);


                          $.ajax({
                              'url': '{{route('notassignmodule')}}',
                              'type': 'post',
                              data: {
                                  'id': tabname,
                                  'staffid': staffid,
                                  _token: token            },
                              success: function(msg) {
                                  if(msg == 1){
                                    const ms = 'Removed assign privileges successfully.';
                                    $('#snackbar').addClass('show');
                                    $('#snackbar').html(ms);
                                    setTimeout(function(){ $('#snackbar').removeClass('show');  } , 3000);     
                                  }
                              }
                          });



            }
        });

        $(document).Toasts('create', {
            class: 'bg-default', 
            title: '{!! $staff->name !!}',
            body: `Email: {!! $staff->email !!} <br>
                    Phone: {!! $staff->mobile !!} 
                    `
        })
        

       


    </script>
