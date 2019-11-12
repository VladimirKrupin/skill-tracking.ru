<template>
    <div>
        <div class=" pb-4">
            <h4 class="h5 input-margin pl-0 pb-0 mb-0 font-weight-bolder">Заполнение данных</h4>
            <span class="font-weight-normal font-sm">Введите значения прогресса по вашим скилам</span>
        </div>

        <div v-if="point.active === 1" v-for="(point,key) in skill.points" v-bind:key="key">
            <b-row class="p-0 m-0">
                <label for="" class="font-weight-bolder">
                    {{point.title}} <span class="font-sm font-weight-bolder">( {{point.units_type}} )</span>
                </label>
            </b-row>
            <b-row class="p-0 m-0">
                <b-col  v-if="point.units_type !== 'time'" class="mb-2 p-0 col-xl-1 col-lg-2 col-md-3 ">
                    <b-form-group class="mb-0 p-0 ">
                        <b-form-input
                                      type="text"
                                      class="form-control form-control-sm"
                                      v-model="skillData.value"></b-form-input>
                    </b-form-group>
                </b-col>
                <b-col v-if="point.units_type === 'time'" class=" col-xl-2 col-lg-4 col-md-4  mb-2 p-0 col-12 d-flex">
                    <b-form-select class="form-control form-control-sm p-2 mr-4"
                                   :id="'hours_'+key"
                                   :plain="true"
                                   :options="hours"
                                   value="0"
                    >
                    </b-form-select>
                    <b-form-select class="form-control form-control-sm p-2 mr-4"
                                   :id="'minutes_'+key"
                                   :plain="true"
                                   :options="minutes"
                                   value="0"
                    >
                    </b-form-select>
                    <b-form-select class="form-control form-control-sm p-2"
                                   :id="'seconds_'+key"
                                   :plain="true"
                                   :options="minutes"
                                   value="0"
                    >
                    </b-form-select>
                </b-col>
            </b-row>
        </div>

        <b-row class="m-0 mt-2">
            <div class="d-flex">
                <b-button  variant="outline-primary" class="mb-4 mr-3" :disabled="disabled">{{$lang.form.save_changes}}<div v-if="loader" class="loader loader-btn"></div></b-button>
            </div>
        </b-row>
        <hr>

    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: 'WriteSkillData',
        computed: {
            ...mapGetters('skills', {
                skills: 'skills',
                skillsData: 'skillsData',
            }),
        },
        data() {
            return {
                disabled: false,
                loader: false,
                skill: false,
                skillData: {
                    id: '',
                    date: '',
                    value: '',
                },
                hours: this.numberGenerator(0,12),
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
        },
        mounted() {
            this.skill = this.getSkill(this.skills);
            let skillPoints = this.skill;
            console.log(this.skillsData);
            Object.keys(skillPoints).map(function(objectKey, index) {
                // console.log(skillPoints[objectKey]);
            });
        },
    }
</script>
<style>
</style>