<template>
    <footer class="footer has-cards">
        <div class="container">
            <div class="row row-grid align-items-center my-md">
                <div class="col-lg-6">
                    <h3 class="text-primary font-weight-light mb-2">{{$lang.landing.thanks}}</h3>
                    <h4 class="mb-0 font-weight-light">{{$lang.landing.thanks_text}}</h4>
                </div>
                <div class="col-lg-6 text-lg-center btn-wrapper">
                    <a target="_blank" rel="noopener" :href="socials.tw"
                       class="btn btn-neutral btn-icon-only btn-twitter btn-round btn-lg" data-toggle="tooltip"
                       :title="$lang.landing.tw">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a target="_blank" rel="noopener" :href="socials.fb"
                       class="btn btn-neutral btn-icon-only btn-facebook btn-round btn-lg" data-toggle="tooltip"
                       :title="$lang.landing.fb">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                    <a target="_blank" rel="noopener" :href="socials.vk"
                       class="btn btn-neutral btn-icon-only btn-lg btn-round" data-toggle="tooltip"
                       :title="$lang.landing.vk">
                        <i class="fa fa-vk"></i>
                    </a>
                    <a target="_blank" rel="noopener" :href="socials.git"
                       class="btn btn-neutral btn-icon-only btn-github btn-round btn-lg" data-toggle="tooltip"
                       :title="$lang.landing.git">
                        <i class="fa fa-github"></i>
                    </a>
                    <a target="_blank" rel="noopener" :href="socials.inst"
                       class="btn btn-neutral btn-icon-only btn-instagram btn-round btn-lg" data-toggle="tooltip"
                       :title="$lang.landing.inst">
                        <i class="fa fa-instagram"></i>
                    </a>
                </div>
            </div>
            <hr>
            <div class="row align-items-center justify-content-md-between">
                <div class="col-md-6">
                    <div class="copyright">
                        &copy; {{year}}
                        <a target="_blank" rel="noopener">{{$lang.landing.signature}}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="nav nav-footer justify-content-end">
                        <li class="nav-item">
                            <a :href="socials.coders_link" class="nav-link" target="_blank" rel="noopener">{{$lang.landing.coders_label}}</a>
                        </li>
                        <li class="nav-item">
                            <a :href="socials.about_us" class="nav-link" target="_blank" rel="noopener">{{$lang.landing.about_us}}</a>
                        </li>
                        <li class="nav-item">
                            <a :href="socials.news" class="nav-link" target="_blank" rel="noopener">{{$lang.landing.news}}</a>
                        </li>
                        <li class="nav-item">
                            <a :href="socials.mit"
                               class="nav-link" target="_blank" rel="noopener">MIT License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>
<script>
export default {
  name: 'app-footer',
  data() {
    return {
        socials: window.socials,
        year: new Date().getFullYear()
    }
  }
};
</script>
<style>
</style>
