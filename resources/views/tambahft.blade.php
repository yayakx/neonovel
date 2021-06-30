@extends('main')

@section('main')
<div class="card col-md-8 ml-auto" style="overflow-y: scroll; height:650px;">    
    <div class="card-body">
        <div class="card-header bg-success text-white row" style="position:sticky; top:0;z-index:50;width:100%">
            <h4 class="text-white col-md" >Silahkan Mengisi Data FT</h4>
            <button class="btn btn-outline-light d-block ml-auto" onclick="location.reload()"><i class="fa fa-sync-alt" aria-hidden="true"></i></button> 
        </div>
            <div class="col-md mt-2">     
                <div class="container">
                    <div id="status" class="mt-3 alert alert-info">
                        <strong>Perhatian!</strong> Sementara ini kami hanya menerima FT yang menggunakan Blogger atau Wordpress Saja.
                    </div>
                    <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step">
                                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                <p>Langkah 1</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                <p>Langkah 2</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                <p>Selesai</p>
                            </div>
                        </div>
                    </div>                    
                    <form id="form" action="/addft" method="post">
                        @csrf
                        <div class="row setup-content" id="step-1">
                            <div class="col-md">
                                <div class="col-md-12">
                                    <h3 class="text-center"> Informasi Owner</h3>
                                    <div class="form-group">
                                        <label class="control-label">Nama Owner</label>
                                        <input  name="owner_ft" maxlength="100" type="text" required="required" class="form-control col-md-8" placeholder="Masukkan Nama Anda"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Email Owner</label>
                                        <input name="email_ft" maxlength="100" type="text" required="required" class="form-control col-md-8" placeholder="emailanda@email.com" />
                                    </div>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Selanjutnya</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-2">
                            <div class="col-md">
                                <div class="col-md-12">
                                    <h3 class="text-center"> Informasi FT</h3>
                                    <div class="form-group">
                                        <label class="control-label">Nama FT</label>
                                        <input  name="nama_ft" maxlength="100" type="text" required="required" class="form-control col-md-8" placeholder="Masukkan Nama FT Anda"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Link / URL FT</label>
                                        <input name="url_ft" maxlength="100" type="text" required="required" class="form-control col-md-8" placeholder="Masukkan URL / Link FT Anda" />
                                    </div>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Selanjutnya</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-3">
                            <div class="col-md">
                                <div class="col-md-12">
                                    <h3 class="text-center"> Selesai</h3>
                                     {{-- <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                            <label class="col-md-8 control-label">Anda Bukan Robot kan?</label>
                                            <div class="col-md-6 pull-center">
                                                {!! app('captcha')->display() !!}
                                                @if ($errors->has('g-recaptcha-response'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>  --}}
                                    <button class="btn btn-success btn-lg pull-right" type="submit">Ajukan Request</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>                 
            </div>
    </div>
  </div> 
  {!! NoCaptcha::renderJs() !!}


    @if(session()->has('success'))
        <script type="text/javascript">  
                $('#status').removeClass('alert alert-info')     
                $('#status').addClass('alert alert-success')          
                $('#status').show();
                $('#status').html('<h4>FT Berhasil Ditambahkan</h4>');                
        </script>
    @elseif(session()->has('gagal'))
    <script type="text/javascript">
            $('#status').removeClass('alert alert-info')     
            $('#status').addClass('alert alert-danger')            
            $('#status').show(); 
            $('#status').html('<h4>ERROR GAN! Mungkin Karena FT Agan Tidak Memakai Blogger atau Wordpress</h4>');           
    </script>
    @endif

<script>
$(document).ready(function () {

var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

allWells.hide();

navListItems.click(function (e) {
    e.preventDefault();
    var $target = $($(this).attr('href')),
            $item = $(this);

    if (!$item.hasClass('disabled')) {
        navListItems.removeClass('btn-primary').addClass('btn-default');
        $item.addClass('btn-primary');
        allWells.hide();
        $target.show();
        $target.find('input:eq(0)').focus();
    }
});

allNextBtn.click(function(){
    var curStep = $(this).closest(".setup-content"),
        curStepBtn = curStep.attr("id"),
        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
        curInputs = curStep.find("input[type='text'],input[type='url']"),
        isValid = true;

    $(".form-group").removeClass("has-error");
    for(var i=0; i<curInputs.length; i++){
        if (!curInputs[i].validity.valid){
            isValid = false;
            $(curInputs[i]).closest(".form-group").addClass("has-error");
        }
    }

    if (isValid)
        nextStepWizard.removeAttr('disabled').trigger('click');
});

$('div.setup-panel div a.btn-primary').trigger('click');
});   

</script>
@endsection