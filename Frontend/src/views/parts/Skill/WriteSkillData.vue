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
        <date-pick class="mb-3 datepick"
                   :class="validInput(skillPointsData.dateError,'border-red-input')"
                   v-on:input="getPointsValuesByDate()"
                   v-if="skillPointsData.date"
                   v-model="skillPointsData.date"></date-pick>
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
                                       :class="validInput(point.errorH)"
                                       :id="'hours_'+key"
                                       :plain="true"
                                       :options="hours"
                                       :value="point.hours"
                                       v-model="point.hours"
                                       v-on:change="checkHour(point.hours,key)"
                        >
                        </b-form-select>
                        <span class="point-units">{{$lang.form.h}}</span>
                    </div>
                    <div class="point-container mr-4">
                        <b-form-select class="form-control form-control-sm p-2 "
                                       :class="validInput(point.errorM)"
                                       :id="'minutes_'+key"
                                       :plain="true"
                                       :options="minutes"
                                       :value="point.minutes"
                                       v-model="point.minutes"
                                       v-on:change="setTimeValue(key)"
                        >
                        </b-form-select>
                        <span class="point-units">{{$lang.form.m}}</span>
                    </div>
                    <div class="point-container mr-4">
                        <b-form-select class="form-control form-control-sm p-2"
                                       :class="validInput(point.errorS)"
                                       :id="'seconds_'+key"
                                       :plain="true"
                                       :options="seconds"
                                       :value="point.seconds"
                                       v-model="point.seconds"
                                       v-on:change="setTimeValue(key)"
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
                skillsData: 'skillsData',
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
                    skill_id: false,
                    date: false,
                    dateError: false,
                    points: []
                },
                hours: this.numberGenerator(0,24),
                minutes: this.numberGenerator(0,59),
                seconds: this.numberGenerator(0,59),
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
                let moment = this.moment;
                Object.keys(skillPoints).map(function(objectKey, index) {
                    let value = false;
                    if (skillPoints[objectKey].value !== null){
                        value = skillPoints[objectKey].value.value;
                    }
                    if (skillPoints[objectKey].active === 1){
                        if (skillPoints[objectKey].units_type === 'time'){
                            if (value){
                                // let timeValue = {
                                //     hours: $this.removeZero(value.slice(0,-4)),
                                //     minutes: $this.removeZero(value.slice(2,-2)),
                                //     seconds: $this.removeZero(value.slice(4)),
                                // };
                                var formatted = moment().startOf('day').seconds(value);
                                let timeValue = {
                                    hours: parseInt(formatted.format('H')),
                                    minutes: parseInt(formatted.format('m')),
                                    seconds: parseInt(formatted.format('s')),
                                };
                                console.log(timeValue);
                                newPoints.push({
                                    id: skillPoints[objectKey].id,
                                    title: skillPoints[objectKey].title,
                                    units_type: skillPoints[objectKey].units_type,
                                    hours: timeValue.hours,
                                    minutes: timeValue.minutes,
                                    seconds: timeValue.seconds,
                                    value: value,
                                    errorH: false,
                                    errorM: false,
                                    errorS: false,
                                });
                            }else {
                                newPoints.push({
                                    id: skillPoints[objectKey].id,
                                    title: skillPoints[objectKey].title,
                                    units_type: skillPoints[objectKey].units_type,
                                    value: value,
                                    hours: 0,
                                    minutes: 0,
                                    seconds: 0,
                                    errorH: false,
                                    errorM: false,
                                    errorS: false,
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
                if (this.valid()){return false;}
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
                        console.log('set skill');
                        this.$emit('changeGraph', {string:111});
                    })
                    .catch(error => {
                        if (error.response !== undefined){
                            if (error.response.data.errors.date){
                                this.errors = error.response.data.errors.date;
                                this.skillPointsData.dateError = true;
                            }else {
                                this.errors = error.response.data.errors.error;
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
                        if (response.data.data.points){
                            this.setSkillPointsData(this.skillPointsData.date,response.data.data.points,this.skill)
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
            setSkillPointsData: function (date,points,skill) {
                this.skillPointsData.date = date;
                this.skillPointsData.skill_id = skill.id;
                this.skillPointsData.points = this.getPointsValues(points);
            },
            inputHandler: function (key) {
                this.skillPointsData.points[key].value = parseInt(this.skillPointsData.points[key].value );
            },
            valid: function () {
                let points = this.skillPointsData.points;
                let result = false;
                Object.keys(points).map(function (key,index) {
                        console.log(points[key]);
                        if (points[key].units_type === 'time'){
                            points[key].errorH = (points[key].hours < 0 || points[key].hours > 24);
                            points[key].errorM = (points[key].minutes < 0 || points[key].minutes > 60);
                            points[key].errorS = (points[key].seconds < 0 || points[key].seconds > 60);
                            if (points[key].errorH || points[key].errorM || points[key].errorS){
                                result = true;
                            }
                        }else {
                            points[key].error = (points[key].value < 0 || points[key].value > 999);
                            if (points[key].error){
                                result = true;
                            }
                        }
                });
                return result;
            },
            checkHour: function (hours,key) {
                if (hours === 24){
                    this.minutes = this.numberGenerator(0,0);
                    this.seconds = this.numberGenerator(0,0);
                    this.skillPointsData.points[key].minutes = 0;
                    this.skillPointsData.points[key].seconds = 0;
                }else if(hours < 24){
                    this.minutes = this.numberGenerator(0,59);
                    this.seconds = this.numberGenerator(0,59);
                }
                this.setTimeValue(key);
            },
            setTimeValue: function (key) {
                let time = this.skillPointsData.points[key].hours+':'+this.skillPointsData.points[key].minutes+':'+this.skillPointsData.points[key].seconds;
                this.skillPointsData.points[key].value = this.moment(time, "HH:mm:ss").diff(this.moment().startOf('day'), 'seconds');
            }
        },
        mounted() {
            this.skill = this.getSkill(this.skills);
            this.setSkillPointsData(this.skill.date,this.skill.points,this.skill);
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