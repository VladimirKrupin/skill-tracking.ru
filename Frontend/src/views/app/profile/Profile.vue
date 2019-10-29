<template>
    <div class="profile-page">
        <section class="section-profile-cover">
        </section>
        <section class="section section-skew">
                <card shadow class="card-profile mt--300" no-body>
                    <div class="px-4">
                        <div class="row justify-content-center">
<!--                            <div class="col-lg-3 order-lg-2">-->
<!--                                <div class="card-profile-image">-->
<!--                                    <a href="#">-->
<!--                                        <input class="avatar-uploader" type="file" id="avatar" ref="avatar" v-on:change="handleFileUploads()" >-->
<!--                                        <img v-on:click="avatarUpload()" v-lazy="'img/user/no-pic.png'" class="rounded-circle">-->
<!--                                    </a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">-->
<!--                                <div class="card-profile-actions py-4 mt-lg-0">-->
<!--&lt;!&ndash;                                    <base-button type="info" size="sm" class="mr-md-4 mr-sm-1">Connect</base-button>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <base-button type="default" size="sm" class="float-right">Message</base-button>&ndash;&gt;-->
<!--                                    -->
<!--                                </div>-->
<!--                            </div>-->
                            <i class="fa fa-cogs ml-5 settings-user" v-on:click="settings()"></i>
                            <b-row class="col-12 d-flex justify-content-center">
                                <div class=" " v-if="!setting">
                                    <div class="text-center mt-5 pb-3">
                                        <h3 v-if="nickname">{{nickname}}</h3>
                                        <div><i class="ni business_briefcase-24 mr-2"></i>{{$lang.profile.lang}}: {{lang}} <img v-lazy="flagImage()" class="rounded-circle flag-icon flag-image"></div>
                                    </div>
                                    <!--                            <div class="text-center mt-5" v-bind:class="about?'':'pb-3'">-->
                                    <!--                                <h3 v-if="name || surname">{{name}} {{surname}}<span v-if="age">, {{age}}</span></h3>-->
                                    <!--                                <div><i class="ni business_briefcase-24 mr-2"></i>Язык: {{lang}} <img v-lazy="flagImage()" class="rounded-circle flag-icon flag-image"></div>-->
                                    <!--                                <div class="h6 mt-2 font-weight-300" v-if="country"><i class="ni location_pin mr-2"></i>{{country}}</div>-->
                                    <!--                                <div class="h6 mt-2 font-weight-300" v-if="city"><i class="ni location_pin mr-2"></i>{{city}}</div>-->
                                    <!--                                <div class="h6 mt-4" v-if="work"><i class="ni business_briefcase-24 mr-2"></i>{{work}}</div>-->
                                    <!--                                <div><i class="ni education_hat mr-2" v-if="position"></i>{{position}}</div>-->
                                    <!--                            </div>-->
                                    <!--                            <div class="mt-5 py-5 border-top text-center" v-if="about">-->
                                    <!--                                <div class="row justify-content-center">-->
                                    <!--                                    <div class="col-lg-9">-->
                                    <!--                                        <p>{{about}}</p>-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->
                                    <!--                            </div>-->
                                </div>
                            </b-row>
                            <b-row v-if="!setting">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">0</span>
                                        <span class="description">{{$lang.profile.skills}}</span>
                                    </div>
                                    <div>
                                        <span class="heading">0</span>
                                        <span class="description">{{$lang.profile.subscriptions}}</span>
                                    </div>
                                    <div>
                                        <span class="heading">0</span>
                                        <span class="description">{{$lang.profile.subscribers}}</span>
                                    </div>
                                </div>
                            </b-row>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 pt-5 m-auto" v-if="setting">
                            <b-row>
                                <b-col class="pl-1">
                                    <h3 class="h5 font-sm">{{$lang.profile.nickname}}</h3>
                                </b-col>
                            </b-row>
                            <b-row>
                                <b-col class="mb-4 p-0">
                                    <b-form-group class="mb-0">
                                        <b-form-input type="text" id="name"
                                                      v-bind:class="validInput(err.nickname)"
                                                      :placeholder=$lang.profile.nickname
                                                      class="form-control form-control-lg"
                                                      v-model="userData.nickname"></b-form-input>
                                    </b-form-group>
                                </b-col>
                            </b-row>
<!--                            <b-row>-->
<!--                                <b-col class="pl-1">-->
<!--                                    <h3 class="h5 font-sm">{{$lang.profile.name}}</h3>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="mb-4 p-0">-->
<!--                                    <b-form-group class="mb-0">-->
<!--                                        <b-form-input type="text" id="name"-->
<!--                                                      v-bind:class="validInput(err.name)"-->
<!--                                                      :placeholder=$lang.profile.name-->
<!--                                                      class="form-control form-control-lg"-->
<!--                                                      v-model="userData.name"></b-form-input>-->
<!--                                    </b-form-group>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="pl-1">-->
<!--                                    <h3 class="h5 font-sm">{{$lang.profile.surname}}</h3>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="mb-4 p-0">-->
<!--                                    <b-form-group class="mb-0">-->
<!--                                        <b-form-input type="text" id="surname"-->
<!--                                                      v-bind:class="validInput(err.surname)"-->
<!--                                                      :placeholder=$lang.profile.surname-->
<!--                                                      class="form-control form-control-lg"-->
<!--                                                      v-model="userData.surname"></b-form-input>-->
<!--                                    </b-form-group>-->
<!--                                </b-col>-->
<!--                            </b-row>-->

<!--                            <b-row>-->
<!--                                <b-col class="pl-1">-->
<!--                                    <h3 class="h5 font-sm">{{$lang.profile.gender}}</h3>-->
<!--                                </b-col>-->
<!--                            </b-row>-->

<!--                            <b-row>-->
<!--                                <b-col class="mb-4 p-0 col-6">-->
<!--                                    <b-form-group class="mb-0">-->
<!--                                        <b-form-select id="genderSelect"-->
<!--                                                       :plain="true"-->
<!--                                                       :options="genderSelect"-->
<!--                                                       :value=userData.gender-->
<!--                                                       v-model="userData.gender">-->
<!--                                        </b-form-select>-->
<!--                                    </b-form-group>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="pl-1">-->
<!--                                    <h3 class="h5 font-sm">{{$lang.profile.age}}</h3>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="mb-4 p-0">-->
<!--                                    <b-form-group class="mb-0">-->
<!--                                        <b-form-input type="date"-->
<!--                                                      id="age"-->
<!--                                                      v-bind:class="err.age?'':''"-->
<!--                                                      :placeholder=$lang.profile.age-->
<!--                                                      class="form-control form-control-lg"-->
<!--                                                      v-model="userData.age"></b-form-input>-->
<!--                                    </b-form-group>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="pl-1">-->
<!--                                    <h3 class="h5 font-sm">{{$lang.profile.country}}</h3>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="mb-4 p-0">-->
<!--                                    <b-form-group class="mb-0">-->
<!--                                        <b-form-input type="text" id="address"-->
<!--                                                      v-bind:class="validInput(err.country)"-->
<!--                                                      :placeholder=$lang.profile.country-->
<!--                                                      class="form-control form-control-lg"-->
<!--                                                      v-model="userData.country"></b-form-input>-->
<!--                                    </b-form-group>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="pl-1">-->
<!--                                    <h3 class="h5 font-sm">{{$lang.profile.city}}</h3>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="mb-4 p-0">-->
<!--                                    <b-form-group class="mb-0">-->
<!--                                        <b-form-input type="text" id="address"-->
<!--                                                      v-bind:class="validInput(err.city)"-->
<!--                                                      :placeholder=$lang.profile.city-->
<!--                                                      class="form-control form-control-lg"-->
<!--                                                      v-model="userData.city"></b-form-input>-->
<!--                                    </b-form-group>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="pl-1">-->
<!--                                    <h3 class="h5 font-sm">{{$lang.profile.work}}</h3>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="mb-4 p-0">-->
<!--                                    <b-form-group class="mb-0">-->
<!--                                        <b-form-input type="text" id="work"-->
<!--                                                      v-bind:class="validInput(err.work)"-->
<!--                                                      :placeholder=$lang.profile.work-->
<!--                                                      class="form-control form-control-lg"-->
<!--                                                      v-model="userData.work"></b-form-input>-->
<!--                                    </b-form-group>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="pl-1">-->
<!--                                    <h3 class="h5 font-sm">{{$lang.profile.position}}</h3>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="mb-4 p-0">-->
<!--                                    <b-form-group class="mb-0">-->
<!--                                        <b-form-input type="text" id="position"-->
<!--                                                      v-bind:class="validInput(err.position)"-->
<!--                                                      :placeholder=$lang.profile.position-->
<!--                                                      class="form-control form-control-lg"-->
<!--                                                      v-model="userData.position"></b-form-input>-->
<!--                                    </b-form-group>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="pl-1">-->
<!--                                    <h3 class="h5 font-sm">{{$lang.profile.lang}}</h3>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="mb-4 p-0 col-3">-->
<!--                                    <b-form-group class="mb-0">-->
<!--                                        <b-form-select id="basicSelect"-->
<!--                                                       :plain="true"-->
<!--                                                       :options="allowedLangs"-->
<!--                                                       :value=lang-->
<!--                                                       v-model="userData.lang"-->
<!--                                                       v-on:change="langHandler(userData.lang)"-->
<!--                                        >-->
<!--                                        </b-form-select>-->
<!--                                    </b-form-group>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="pl-1">-->
<!--                                    <h3 class="h5 font-sm">{{$lang.profile.about}}</h3>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                            <b-row>-->
<!--                                <b-col class="mb-4 p-0">-->
<!--                                    <b-form-group class="mb-0">-->
<!--                                        <b-form-textarea type="text" id="lang"-->
<!--                                                      :rows="9"-->
<!--                                                      v-bind:class="validInput(err.about)"-->
<!--                                                      :placeholder=$lang.profile.about-->
<!--                                                      class="form-control form-control-lg"-->
<!--                                                      v-model="userData.about"></b-form-textarea>-->
<!--                                    </b-form-group>-->
<!--                                </b-col>-->
<!--                            </b-row>-->
                                <b-row>
                                    <b-col class="pl-1">
                                        <h3 class="h5 font-sm">{{$lang.profile.lang}}</h3>
                                    </b-col>
                                </b-row>
                                <b-row>
                                    <b-col class="mb-4 p-0 col-3">
                                        <b-form-group class="mb-0">
                                            <b-form-select id="basicSelect"
                                                           :plain="true"
                                                           :options="allowedLangs"
                                                           :value=lang
                                                           v-model="userData.lang"
                                                           v-on:change="langHandler(userData.lang)"
                                            >
                                            </b-form-select>
                                        </b-form-group>
                                    </b-col>
                                </b-row>
                            <b-row>
                                <div class="d-flex">
                                    <b-button  variant="outline-primary" class="mb-4 mr-3" v-on:click="saveSettings()" :disabled="disabled">{{$lang.form.save_changes}}<div v-if="loader" class="loader loader-btn"></div></b-button>
                                </div>
                            </b-row>
                            <b-row>
                                <b-col class="p-0">
                                    <div v-html="errors" class="alert alert-danger alert-dismissable text-dark" v-if="errors">
                                    </div>
                                </b-col>
                            </b-row>
                            <b-row>
                                <b-col class="p-0">
                                    <div class="alert alert-success alert-dismissable text-dark" v-if="success">
                                        {{$lang.form.success}}
                                    </div>
                                </b-col>
                            </b-row>
                        </div>
                    </div>
                </card>
        </section>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import axios from 'axios';
export default {
    computed: {
        ...mapGetters('profile', {
            email: 'email',
            nickname: 'nickname',
            // name: 'name',
            // surname: 'surname',
            // gender: 'gender',
            // age: 'age',
            // country: 'country',
            // city: 'city',
            // work: 'work',
            // position: 'position',
            // about: 'about',
            data: 'data',
            allowedLangs: 'allowedLangs',
        }),
    },
    data() {
        return {
            avatar: false,
            lang: localStorage.getItem('lang'),
            setting: false,
            errors: false,
            success: false,
            userData: [],
            disabled: false,
            loader: false,
            // genderSelect: [this.$lang.profile.gender_not,this.$lang.profile.gender_male,this.$lang.profile.gender_female],
            err: {
                nickname:false,
                // name:false,
                // surname:false,
                // age:false,
                // country:false,
                // city:false,
                // work:false,
                // position:false,
                // about:false,
            }
        };
    },
    methods: {
        settings: function () {
            this.setting = !this.setting;
        },
        saveSettings: function () {
            this.valid();
            // if (!this.validCheck()){return false;}
            this.errors = '';
            this.loader = true;
            this.disabled = true;
            this.success = false;
            const options = {
                method: 'POST',
                headers: this.defaultHeaders,
                data: this.userData,
                url: this.apiHost+'/api/saveSettings/',
            };
            axios(options)
                .then(response => {
                    this.loader = false;
                    this.disabled = false;
                    this.success = true;
                    this.$store.dispatch('profile/setUserData');
                    this.checkChangeSettings();
                })
                .catch(error => {
                    if (error.response !== undefined){
                        let err = this.err;
                        let errors = this.errors;
                        Object.keys(error.response.data).map(function(objectKey, index) {
                            err[objectKey] = true;
                            errors += error.response.data[objectKey]+"<br>";
                        });
                        this.errors = errors;
                    }
                    this.loader = false;
                    this.disabled = false;
                });
        },
        valid: function() {
            this.err.nickname=(this.userData.nickname)?!(this.vStr(this.userData.nickname)):false;
            // this.err.name=(this.userData.name)?!(this.vStr(this.userData.name)):false;
            // this.err.surname=(this.userData.surname)?!(this.vStr(this.userData.surname)):false;
            // this.err.age=(this.userData.age)?!this.vDate(this.userData.age):false;
            // this.err.country=(this.userData.country)?!this.vStr(this.userData.country):false;
            // this.err.city=(this.userData.city)?!this.vStr(this.userData.city):false;
            // this.err.work=(this.userData.work)?!this.vStr(this.userData.work):false;
            // this.err.position=(this.userData.position)?!this.vStr(this.userData.position):false;
            // this.err.about=(this.userData.about)?!this.vStr(this.userData.about):false;
        },
        validCheck: function() {
            let err = this.err;
            let res = true;
            Object.keys(err).map(function(objectKey, index) {
                if (err[objectKey] === true){
                    res = false;
                }
            });
            return res;
        },
        checkChangeSettings: function () {
            this.setting = this.nickname?false:true;
        },
        handleFileUploads: function () {
            console.log('avatar upload');
            this.avatar = this.$refs.avatar.files[0];
            console.log(this.avatar);
            this.fileUpload();
        },
        avatarUpload: function () {
            this.$refs.avatar.click();
        },
        fileUpload: function () {
            let formData = new FormData();

            formData.append('avatar',this.avatar);

            this.disabled = true;

            axios.post(this.apiHost+'/api/avatarUploader/',
                formData,
                {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(response => {
                console.log(response.data);
            })
            .catch(e => {
                console.log(e.response.data);
            });
        },
        setUserData: function () {
            console.log('this.data',this.data);
            if (this.data){
                this.userData = JSON.parse(JSON.stringify(this.data));
                this.checkChangeSettings();
            }else {
                setTimeout(function () {
                    this.setUserData();
                },500)
            }
        }
    },
    mounted: function () {
        this.setUserData();

    }
};
</script>
<style lang="scss" scoped>
    .section-profile-cover {
        height: 300px;
    }
    .settings-user {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 20px;
        color: #777;
        cursor: pointer;
        z-index: 1;
    }

    .settings-user:hover{
        color: #5a92ff;
        top: 14px;
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
    .rounded-circle {
        z-index: 1;
    }
    .avatar-uploader {
        opacity: 0;
    }
</style>
