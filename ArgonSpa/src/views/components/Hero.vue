<template>
    <section class="section-hero section-shaped my-0">
        <div class="shape shape-style-1 shape-primary">
            <span class="span-150"></span>
            <span class="span-50"></span>
            <span class="span-50"></span>
            <span class="span-75"></span>
            <span class="span-100"></span>
            <span class="span-75"></span>
            <span class="span-50"></span>
            <span class="span-100"></span>
            <span class="span-50"></span>
            <span class="span-100"></span>
        </div>
        <div class="container shape-container d-flex align-items-center">
            <div class="col px-0">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-7 text-center pt-lg">
                        <!--<img src="img/brand/white.png" style="width: 200px;" class="img-fluid">-->
                        <h4 class="text-white">{{$lang.landing.awesome}}</h4>
                        <p class="lead text-white mt-4 mb-5">{{$lang.landing.awesome_text}}</p>
                        <div class="btn-wrapper">
                            <base-button tag="a"
                                         href="#"
                                         class="mb-3 mb-sm-0"
                                         type="info"
                                         icon="fa fa-apple">
                                App store
                            </base-button>
                            <base-button tag="a"
                                         href="#"
                                         class="mb-3 mb-sm-0"
                                         type="white"
                                         icon="fa fa-google">
                                Google play
                            </base-button>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-around stars-and-coded">
                    <div class="col-sm-4">
                        <span class="text-white alpha-7 ml-3">Star us on</span>
                        <a href="https://github.com/VladimirKrupin/skill-tracking.ru" target="_blank" title="Support us on Github">
                            <img src="img/brand/github-white-slim.png" style="height: 22px; margin-top: -3px">
                        </a>
                    </div>
                    <div class="col-sm-4 mt-4 mt-sm-0 text-right">
                        <span class="text-white alpha-7">Coded by</span>
                        <a href="https://vk.com/?id=244842255" style="color: white;text-decoration: underline" target="_blank" title="Vladimir Krupin vk.com page">
                            Vladimir Krupin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {};
</script>
<style>
</style>
