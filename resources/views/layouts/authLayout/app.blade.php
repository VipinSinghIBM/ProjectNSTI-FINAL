

<div class="loader">
    <img src="/assets/images/load (2).gif" alt="Loading..." />
</div>
<style>
.loader {
    position: fixed;
    z-index: 99999;
    width: 100%;
    height: 100%;
    background: white;
    display: flex;
    justify-content: center;
    align-items: center;
}

.loader > img {
    width: 80px;
}

.loader.hidden {
    animation: fadeOut 1s;
    animation-fill-mode: forwards;
}

@keyframes fadeOut {
    100% {
        opacity: 0;
        visibility: hidden;
    }
}

</style>

@include('layouts.authLayout.header')
@include('layouts.authLayout.navbar')

<body>


@yield('content')

@include('layouts.authLayout.footer')

<script>
    window.addEventListener("load", function () {
        const loader = document.querySelector(".loader");
        loader.className += " hidden"; // class "loader hidden"
    });
    </script>
</body>

