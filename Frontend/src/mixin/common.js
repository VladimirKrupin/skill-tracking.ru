import settings from "../config/settings";
import env from "../config/env";
let appSettings = settings.get(env.get());

export default {
    get: function(){
        return {
            data: function () {
                return {
                    apiHost: appSettings.apiHost,
                    frontHost: appSettings.frontHost,
                    socials: {
                        'git':'https://github.com/VladimirKrupin/skill-tracking.ru',
                        'vk':'https://vk.com/skilltracking',
                        'fb':'https://www.facebook.com/Skill-Tracking-105284594191389/',
                        'inst':'https://www.instagram.com/skill.tracking',
                        'tw':'https://twitter.com/SkillTracking',
                        'coders_link':'https://breeze-team.com',
                        'about_us':'https://breeze-team.com/about',
                        'news':'https://breeze-team.com/news',
                        'mit':'https://github.com/VladimirKrupin/breeze-team.ru/blob/master/LICENSE',
                    },
                    defaultHeaders: {
                        'Lang':localStorage.getItem('lang'),
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
                    }
                }
            },
            methods: {
                validEmail: function (email) {
                    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(email);
                },
                vStr: function (name) {
                    return name.length <= 255 && name.length >= 1;
                },
                vDate: function (name) {
                    return name.length === 8;
                },
                validInput: function(expr){
                    // console.log(expr);
                    return (expr)?'border-red':'';
                },
                logged: function () {
                    return (
                        localStorage.getItem('access_token') !== null &&
                        localStorage.getItem('access_token') !== undefined &&
                        localStorage.getItem('access_token') !== 'undefined'
                    );
                },
                flagImage: function ($lang) {
                    return 'img/flags/'+localStorage.getItem('lang')+'.png';
                },
                langHandler: function (lang){
                    this.$store.dispatch('profile/changeLang',{lang:lang});
                    this.$store.dispatch('profile/setDbLang',{lang:lang});
                },
                returnBack: function (){
                    this.$router.go(-1)
                },
            }
        }
    }
}