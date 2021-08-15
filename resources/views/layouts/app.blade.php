

{{-- <div class="loader">
    <img src="/assets/images/circles.svg"/>
</div>
{{-- <style>
.loader{

width:100%;
height:100%;
position:fixed;
padding-top:19%;
background:#333;
padding-left:47%;
margin:0 auto;
z-index:99999;

}
</style> --}}
@include('layouts.header')
@include('layouts.navbar')


<body>

@yield('page-content')



@include('layouts.footer')

{{-- <script>
setTimeout(()=>{
$(".loader").fadeOut(3000);
})
</script> --}}
</body>



