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
                        'vk':'https://vk.com/?id=244842255',
                        'fb':'https://www.facebook.com/profile.php?id=100021975798495',
                        'inst':'https://www.instagram.com/vladimir_togliatti/',
                        'tw':'https://twitter.com/Vladimir_Krpn',
                        'coders_link':'https://vk.com/?id=244842255',
                        'about_us':'https://vk.com/?id=244842255',
                        'news':'https://vk.com/?id=244842255',
                        'mit':'https://github.com/VladimirKrupin/skill-tracking.ru/blob/master/LICENSE',
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
            }
        }
    }
}