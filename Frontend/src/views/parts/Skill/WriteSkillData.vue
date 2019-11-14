<template>
    <div>
        <div class=" pb-4">
            <h4 class="h5 input-margin pl-0 pb-0 mb-0 font-weight-bolder">{{$lang.skill.point_write}}</h4>
            <span class="font-weight-normal font-sm">{{$lang.skill.point_write_description}}</span>
        </div>
        <b-row class="p-0 m-0 mb-1">
            <span class="font-weight-bolder">
                {{$lang.form.date}}
            </span>
        </b-row>
        <date-pick class="mb-3" v-if="skillPointsData.date" v-model="skillPointsData.date"></date-pick>
        <div class="p-0 m-0 mb-3" v-if="skillPointsData.points !== []" v-for="(point,key) in skillPointsData.points" v-bind:key="key">
            <div class="p-0 m-0">
                <label for="" class="font-weight-bolder mb-1">
                    {{point.title}} <span class="font-sm font-weight-bolder">( {{point.units_type}} )</span>
                </label>
            </div>
            <div class="p-0 m-0">
                <b-col v-if="point.units_type !== 'time'" class="p-0 col-3 col-md-1">
                    <div class="p-0 point-container  col-xl-5 col-md-10 col-8">
                        <b-form-group class="mb-0 p-0">
                            <b-form-input
                                          type="text"
                                          class="form-control form-control-sm "
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
                <b-button v-on:click="sendValues()"
                          variant="outline-primary"
                          class="mb-4 mr-3"
                          :disabled="disabled"
                >
                    {{$lang.form.save_changes}}
                    <div v-if="loader" class="loader loader-btn"></div>
                </b-button>
            </div>
        </b-row>
        {{result}}
        <hr>


    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import DatePick from 'vue-date-pick';

    export default {
        name: 'WriteSkillData',
        computed: {
            ...mapGetters('skills', {
                skills: 'skills',
                // skillsData: 'skillsData',
            }),
        },
        components: {DatePick},
        data() {
            return {
                result: false,
                disabled: false,
                loader: false,
                skill: false,
                skillPointsData: {
                    date: false,
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
                            let timeValue = {
                                hours: $this.removeZero(value.slice(0,-4)),
                                minutes: $this.removeZero(value.slice(2,-2)),
                                seconds: $this.removeZero(value.slice(4)),
                            };
                            console.log(timeValue);
                            if (value){
                                newPoints.push({
                                    id: skillPoints[objectKey].id,
                                    title: skillPoints[objectKey].title,
                                    units_type: skillPoints[objectKey].units_type,
                                    hours: timeValue.hours,
                                    minutes: timeValue.minutes,
                                    seconds: timeValue.seconds,
                                });
                            }else {
                                newPoints.push({
                                    id: skillPoints[objectKey].id,
                                    title: skillPoints[objectKey].title,
                                    units_type: skillPoints[objectKey].units_type,
                                    hours: 0,
                                    minutes: 0,
                                    seconds: 0,
                                });
                            }
                        }else {
                            if (value){
                                newPoints.push({
                                    id: skillPoints[objectKey].id,
                                    title: skillPoints[objectKey].title,
                                    units_type: skillPoints[objectKey].units_type,
                                    value: value,
                                });
                            }else {
                                newPoints.push({
                                    id: skillPoints[objectKey].id,
                                    title: skillPoints[objectKey].title,
                                    units_type: skillPoints[objectKey].units_type,
                                    value: '',
                                });
                            }
                        }
                    }
                });
                return newPoints;
            },
            sendValues: function () {
                console.log(this.skillPointsData);
                this.result = this.skillPointsData;
            }
        },
        mounted() {
            this.skill = this.getSkill(this.skills);
            this.skillPointsData.date = this.skill.date;
            this.skillPointsData.points = this.getPointsValues(this.skill.points);
            console.log(this.skill.date);
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
</style>