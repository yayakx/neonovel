@extends('header')

@section('content')

<nav class="navbar navbar-expand-lg navbar-dark bg-success col-md">
    <a class="navbar-brand" href="/"><h5>NeoNovel</h5></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#staytune">Forum</a>                       
        </li> 
        {{-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Donasi</a>                       
        </li>        --}}
        </ul>               
        <a href="/tambahft"><button class="btn btn-outline-light my-2 my-sm-0 mr-1 ml-1">Ingin Mendaftarkan FT?</button></a>
        <button class="btn btn-outline-light my-2 my-sm-0 mr-1 ml-1">Daftar</button>
        <button class="btn btn-outline-light my-2 my-sm-0 mr-1 ml-1">Masuk</button>        
    </div>
</nav>



<div class="row">

<div class="col-md-4 ">
<div class="card mr-auto h-10">    
    <div class="card-body">
        <a href="/"><h4 class="card-header bg-success text-white">NeoNovel</h4></a>
            <div>     
                <div> 

                    <div class="card-body">
                        <a href="/daftarft"><h4 class="card-header bg-success text-white">FT Terdaftar</h4></a>
                            <div class="row"> 
                                @foreach ($listft as $dataft)      
                                <div class="">                                      
                                    <h5 class="card-text col-md mt-2"><a class="namaft badge badge-pill" href="{{ str_replace('rss.xml', '', $dataft->url_ft)}}" target="_blank">{{$dataft->nama_ft}}</a></h5>                                            
                                </div>    
                                @endforeach
                                <h5 class="card-text col-md mt-2"><a class="namaft badge badge-pill" href="/daftarft">Selengkapnya...</a></h5>                                                    
                            </div>
                    </div> 

                </div>                                            
            </div>
    </div>    
  </div>   

  <div class="card mr-auto h-10 col-md">    
    <div class="card-body">
        <h4 class="card-header bg-success text-white">Cari Novel</h4>
            <div>     
                <div> 
                    <div class="col-md"> 
                        <form class="form-inline" action="/carinovel" method="post">
                            @csrf                            
                            <div class="form-group mb-2 mt-3">                              
                              <input type="text" class="form-control" id="cari" name="cari" placeholder="Judul Novel" required>
                            </div>
                            <button type="submit" class="btn btn-primary ml-3 col-md"><i class="fa fa-search" aria-hidden="true"></i> Cari Novel</button>
                        </form>                                                           
                    </div>  
                </div>                                           
            </div>
    </div>    
  </div>   

  <div class="card mr-auto h-10 col-md">    
    <div class="card-body">
        <h4 class="card-header bg-success text-white">Tampilkan Berdasarkan FT</h4>
            <div>     
                <div> 
                    <div class="col-md mt-3">  
                        <form action="/carift" method="post"> 
                            @csrf                                                                                                    
                            <select class="form-control mb-2" name="nama_ft" id="nama_ft" readonly>
                                @foreach ($listft as $dataft)  
                                <option value="{{$dataft->url_ft}}">{{$dataft->nama_ft}}</option> 
                                @endforeach                                                   
                            </select>                            
                            <button type="submit" class="btn btn-secondary col-md">Cari Update Terbaru</button>
                        </form>                                                                           
                    </div>  
                </div>                                           
            </div>
    </div>    
  </div>   

 

</div>

@yield('main')  

</div>

{{-- chatango --}}
<div class=""> 
    <script id="cid0020000271796876883" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 247px;height: 362px;">{"handle":"neonovel","arch":"js","styles":{"a":"383838","b":100,"c":"FFFFFF","d":"FFFFFF","k":"383838","l":"383838","m":"383838","n":"FFFFFF","p":"10","q":"383838","r":100,"pos":"br","cv":1,"cvbg":"202020","cvw":370,"cvh":41,"surl":0,"cnrs":"0.35","ticker":1}}</script>
</div>

 <!-- Modal Stay Tuned -->
 <div class="modal fade" id="staytune" z-index="99" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">            
            <div class="modal-body text-center">
                <h3>Stay Tuned ^^</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>                
            </div>
        </div>
    </div>
</div>

<script>
    var warna = ['badge-primary', 'badge-secondary', 'badge-warning', 'badge-success', 'badge-danger'];
    $(document).ready(function() {        
        $(".namaft").each(function() {
            var randomize = Math.floor(Math.random() * warna.length);
            $(this).addClass(warna[randomize]);
        });
    });    
</script>

@endsection