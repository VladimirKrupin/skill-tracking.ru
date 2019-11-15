<template>
    <div>
        <div class=" pb-4">
            <h4 class="h5 input-margin pl-0 pb-0 mb-0 font-weight-bolder">{{$lang.skill.point_write}}</h4>
            <span class="font-weight-normal font-sm">{{$lang.skill.point_write_description}}</span>
        </div>
        <errors class="col-12 col-md-6 col-xl-4"  :errors="errors"></errors>
        <b-row class="p-0 m-0 mb-1">
            <span class="font-weight-bolder">
                {{$lang.form.date}}
            </span>
        </b-row>
        <date-pick class="mb-3 datepick" :class="validInput(skillPointsData.dateError,'border-red-input')" v-on:input="getPointsValuesByDate()" v-if="skillPointsData.date" v-model="skillPointsData.date"></date-pick>
        <div class="p-0 m-0 mb-3" v-if="skillPointsData.points !== []" v-for="(point,key) in skillPointsData.points" v-bind:key="key">
            <div class="p-0 m-0">
                <label for="" class="font-weight-bolder mb-1">
                    {{point.title}}
                </label>
            </div>
            <div class="p-0 m-0">
                <b-col v-if="point.units_type !== 'time'" class="p-0 col-3 col-md-1">
                    <div class="p-0 point-container  col-xl-6 col-md-10 col-8">
                        <b-form-group class="mb-0 p-0">
                            <b-form-input
                                          :class="validInput(point.error)"
                                          type="number"
                                          class="form-control form-control-sm "
                                          v-on:change="inputHandler(key)"
                                          v-model="point.value"></b-form-input>
                        </b-form-group>
                        <span v-if="point.units_type !== 'quantity'" class="point-units">{{$lang.form.q}}</span>
                        <span v-if="point.units_type !== 'pages'" class="point-units">{{$lang.form.p}}</span>
                    </div>
                </b-col>
                <b-col v-if="point.units_type === 'time'" class="d-flex p-0">
                    <div class="point-container mr-4">
                        <b-form-select class="form-control form-control-sm p-2 "
                                       :id="'hours_'+key"
                                       :plain="true"
                                       :options="hours"
                                       :value="point.hours"
                                       v-model="point.hours"
                        >
                        </b-form-select>
                        <span class="point-units">{{$lang.form.h}}</span>
                    </div>
                    <div class="point-container mr-4">
                        <b-form-select class="form-control form-control-sm p-2 "
                                       :id="'minutes_'+key"
                                       :plain="true"
                                       :options="minutes"
                                       :value="point.minutes"
                                       v-model="point.minutes"
                        >
                        </b-form-select>
                        <span class="point-units">{{$lang.form.m}}</span>
                    </div>
                    <div class="point-container mr-4">
                        <b-form-select class="form-control form-control-sm p-2"
                                       :id="'seconds_'+key"
                                       :plain="true"
                                       :options="seconds"
                                       :value="point.seconds"
                                       v-model="point.seconds"
                        >
                        </b-form-select>
                        <span class="point-units">{{$lang.form.s}}</span>
                    </div>
                </b-col>
            </div>
        </div>

        <b-row class="m-0 mt-2">
            <div class="d-flex">
                <b-button v-on:click="sendSkillPointsValues()"
                          variant="outline-primary"
                          class="mb-4 mr-3"
                          :disabled="disabled"
                >
                    {{$lang.form.save_changes}}
                    <div v-if="loader" class="loader loader-btn"></div>
                </b-button>
            </div>
        </b-row>

        <errors class="col-12 col-md-6 col-xl-4" :errors="errors"></errors>

        {{result}}
        <hr>


    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import DatePick from 'vue-date-pick';
    import axios from 'axios';
    import Errors from "../../parts/errors/Errors.vue";

    export default {
        name: 'WriteSkillData',
        computed: {
            ...mapGetters('skills', {
                skills: 'skills',
                // skillsData: 'skillsData',
            }),
        },
        components: {DatePick,Errors},
        data() {
            return {
                errors: false,
                result: false,
                disabled: false,
                loader: false,
                skill: false,
                skillPointsData: {
                    date: false,
                    dateError: false,
                    points: []
                },
                hours: this.numberGenerator(0,24),
                minutes: this.numberGenerator(0,60),
                seconds: this.numberGenerator(0,60),
                time: {
                    hours: 0,
                    minutes: 0,
                    seconds: 0,
                },
            };
        },
        methods:{
            getPointsValues: function (skillPoints) {
                let newPoints = [];
                let $this = this;
                Object.keys(skillPoints).map(function(objectKey, index) {
                    let value = false;
                    if (skillPoints[objectKey].value !== null){
                        value = skillPoints[objectKey].value.value;
                    }
                    if (skillPoints[objectKey].active === 1){
                        if (skillPoints[objectKey].units_type === 'time'){
                            if (value){
                                let timeValue = {
                                    hours: $this.removeZero(value.slice(0,-4)),
                                    minutes: $this.removeZero(value.slice(2,-2)),
                                    seconds: $this.removeZero(value.slice(4)),
                                };
                                newPoints.push({
                                    id: skillPoints[objectKey].id,
                                    title: skillPoints[objectKey].title,
                                    units_type: skillPoints[objectKey].units_type,
                                    hours: timeValue.hours,
                                    minutes: timeValue.minutes,
                                    seconds: timeValue.seconds,
                                    error: false,
                                });
                            }else {
                                newPoints.push({
                                    id: skillPoints[objectKey].id,
                                    title: skillPoints[objectKey].title,
                                    units_type: skillPoints[objectKey].units_type,
                                    hours: 0,
                                    minutes: 0,
                                    seconds: 0,
                                    error: false,
                                });
                            }
                        }else {
                            if (value){
                                newPoints.push({
                                    id: skillPoints[objectKey].id,
                                    title: skillPoints[objectKey].title,
                                    units_type: skillPoints[objectKey].units_type,
                                    value: value,
                                    error: false,
                                });
                            }else {
                                newPoints.push({
                                    id: skillPoints[objectKey].id,
                                    title: skillPoints[objectKey].title,
                                    units_type: skillPoints[objectKey].units_type,
                                    value: 0,
                                    error: false,
                                });
                            }
                        }
                    }
                });
                return newPoints;
            },
            sendSkillPointsValues: function () {
                console.log(this.skillPointsData);
                this.errors = '';
                this.loader = true;
                this.disabled = true;
                this.success = false;
                const options = {
                    method: 'POST',
                    headers: this.defaultHeaders,
                    data: this.skillPointsData,
                    url: this.apiHost+'/api/sendSkillPointsValues/',
                };
                axios(options)
                    .then(response => {
                        this.loader = false;
                        this.disabled = false;
                        console.log(response.data);
                    })
                    .catch(error => {
                        if (error.response !== undefined){
                            if (error.response.data.errors.date){
                                this.errors = error.response.data.errors.date;
                                this.skillPointsData.dateError = true;
                            }
                        }
                        this.loader = false;
                        this.disabled = false;
                    });
            },
            getPointsValuesByDate: function () {
                this.errors = false;
                this.skillPointsData.dateError = false;
                if (this.validDate()){this.errors = this.validDate();this.skillPointsData.dateError = true;return false;}
                const options = {
                    method: 'POST',
                    headers: this.defaultHeaders,
                    data: {date: this.skillPointsData.date,skill_id: this.skill.id},
                    url: this.apiHost+'/api/getPointsValuesByDate/',
                };
                axios(options)
                    .then(response => {
                        // console.log(response.data);
                        if (response.data.data.points){
                            this.setSkillPointsData(this.skillPointsData.date,response.data.data.points)
                        }
                    })
                    .catch(error => {
                        if (error.response !== undefined){
                            this.errors = error.response.data.error;
                        }
                    });
            },
            validDate: function () {
                return (this.moment().format('YYYY-MM-DD') < this.skillPointsData.date)?this.$lang.errors.date_big:false;
            },
            setSkillPointsData: function (date,points) {
                this.skillPointsData.date = date;
                this.skillPointsData.points = this.getPointsValues(points);
            },
            inputHandler: function (key) {
                this.skillPointsData.points[key].value = parseInt(this.skillPointsData.points[key].value );
            }
        },
        mounted() {
            this.skill = this.getSkill(this.skills);
            this.setSkillPointsData(this.skill.date,this.skill.points);
        },
    }
</script>
<style>
    .point-container {
        position: relative;
    }
    .point-units {
        position: absolute;
        top: 16%;
        width: 25px;
        right: -60%;
    }
    .datepick input{
        color: #5c6873;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #e4e7ea;
        padding: 5px 7px;
        border-radius: 5px;
        font-size: 14px;
    }
</style>