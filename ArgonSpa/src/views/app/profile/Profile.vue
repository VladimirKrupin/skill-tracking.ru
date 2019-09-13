<template>
    <div class="profile-page">
        <section class="section-profile-cover">
        </section>
        <section class="section section-skew">
                <card shadow class="card-profile mt--300" no-body>
                    <div class="px-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="#">
                                        <img v-lazy="'img/user/no-pic.png'" class="rounded-circle">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                                <div class="card-profile-actions py-4 mt-lg-0">
<!--                                    <base-button type="info" size="sm" class="mr-md-4 mr-sm-1">Connect</base-button>-->
<!--                                    <base-button type="default" size="sm" class="float-right">Message</base-button>-->
                                    <i class="fa fa-cogs ml-5 settings-user"></i>
                                </div>
                            </div>
                            <div class="col-lg-4 order-lg-1">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">0</span>
                                        <span class="description">Skills</span>
                                    </div>
                                    <div>
                                        <span class="heading">0</span>
                                        <span class="description">Subscriptions</span>
                                    </div>
                                    <div>
                                        <span class="heading">0</span>
                                        <span class="description">Subscribers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <h3>Jessica Jones
                                <span class="font-weight-light">, 27</span>
                            </h3>
                            <div><i class="ni business_briefcase-24 mr-2"></i>Язык: {{lang}} <img v-lazy="flagImage()" class="rounded-circle flag-icon flag-image"></div>
                            <div class="h6 mt-2 font-weight-300"><i class="ni location_pin mr-2"></i>Bucharest, Romania</div>
                            <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer</div>
                            <div><i class="ni education_hat mr-2"></i>University of Computer Science</div>
                        </div>
                        <div class="mt-5 py-5 border-top text-center">
                            <div class="row justify-content-center">
                                <div class="col-lg-9">
                                    <p>An artist of considerable range, Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music, giving it a warm, intimate feel with a solid groove structure. An artist of considerable range.</p>
                                    <a href="#">Show more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </card>
        </section>
    </div>
</template>
<script>
export default {
    data() {
        return {
            lang: localStorage.getItem('lang'),
        };
    },
};
</script>
<style scoped>
    .section-profile-cover {
        height: 300px;
    }
    .settings-user {
        position: absolute;
        top: 0;
        font-size: 20px;
        color: #777;
    }
    @media (max-width: 768px) {
        .section-profile-cover {
            height: 150px;
        }

        i.fa.fa-cogs.ml-5 {
            top: 10px;
            right: 5px;
        }
    }
    .flag-image {
        margin-top: -2px;
    }
</style>
