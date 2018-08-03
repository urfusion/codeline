Vue.component('weather', {
    data: function () {
        return {
            the_temp: 0,
            max_temp: 0,
            min_temp: 0,
            stateImage: '',
            dispaly: false,
        }
    },
    computed: {
        temp: function () {
            var vm = this;
            axios.get('weather.php?command=location&woeid=' + vm.woeid)
                    .then(function (response) {
                        var weather = response.data.consolidated_weather[0];
                        vm.the_temp = weather.the_temp.toFixed(2);
                        vm.max_temp = weather.max_temp.toFixed(2);
                        vm.min_temp = weather.min_temp.toFixed(2);
                        vm.stateImage = 'icons/' + weather.weather_state_abbr + '.svg';
                        vm.dispaly = true;
                        return response.data.consolidated_weather[0].the_temp.toFixed(2);
                    });
        }
    },
    props: ['title', 'woeid'],
    template: `<div>
{{temp}}
<small v-if="!dispaly">Searching..</small> 
<h3 v-if="dispaly">{{ title }}</h3> 
<img v-if="dispaly" :src="stateImage" alt="" width="100"/>
<p v-if="dispaly">Temp. {{the_temp}} °C</p> 
<p v-if="dispaly">Max. {{max_temp}} °C</p>
<p v-if="dispaly">Min. {{min_temp}} °C</p>
</div>`
});
new Vue({
    el: '#cityWeathers'
});

var searchApp = new Vue({
    el: '#search',
    data: {
        place: '',
        searchCity: '',
        temp: '',
        maxTemp: '',
        minTemp: '',
        stateName: '',
        stateAbbr: '',
        stateImg: '',
        applicable_date: '',
        no_results_text: '',
        loading: '',
        view_more: 'View More',
        woeid: false,
        weathers: false,
        displayDetails: false,
    },
    methods: {
        searchPlace: function () {
            var vm = this;
            vm.displayDetails = false;
            vm.loading = 'Searching..';
            vm.temp = false;
            vm.no_results_text = false;
            document.getElementById('cityWeathers').style.display='none';
            
            window.history.pushState('page2', 'Title', '#/search/' + vm.place);
            axios.get('weather.php?command=search&keyword=' + vm.place)
                    .then(function (response) {
                        var location = response.data[0];
                        if (location) {
                            vm.woeid = location.woeid;
                            axios.get('weather.php?command=location&woeid=' + location.woeid)
                                    .then(function (response) {
                                        vm.loading = '';
                                        var weather = response.data.consolidated_weather[0];
                                        vm.searchCity = vm.place;
                                        vm.temp = weather.the_temp.toFixed(2);
                                        vm.maxTemp = weather.max_temp.toFixed(2);
                                        vm.minTemp = weather.min_temp.toFixed(2);
                                        vm.stateName = weather.weather_state_name;
                                        vm.stateAbbr = weather.weather_state_abbr;
                                        vm.stateImg = 'icons/' + weather.weather_state_abbr + '.svg';

                                        var days = [
                                            'Sunday',
                                            'Monday',
                                            'Tuesday',
                                            'Wednesday',
                                            'Thursday',
                                            'Friday',
                                            'Saturday'
                                        ];

                                        var d = new Date(weather.applicable_date);
                                        var dayName = days[d.getDay()];

                                        vm.applicable_date = dayName;

                                        var weathers = [];

                                        for (w in response.data.consolidated_weather) {
                                            var d = new Date(response.data.consolidated_weather[w].applicable_date);
                                            weathers.push({
                                                applicable_day: days[d.getDay()],
                                                stateImg: 'icons/' + response.data.consolidated_weather[w].weather_state_abbr + '.svg',
                                                stateName: response.data.consolidated_weather[w].weather_state_name,
                                                maxTemp: response.data.consolidated_weather[w].max_temp.toFixed(2),
                                                minTemp: response.data.consolidated_weather[w].min_temp.toFixed(2),
                                                
                                            });
                                        }

                                        vm.weathers = weathers;

                                    });
                        } else {
                            vm.loading = '';
                            vm.no_results_text = 'No results were found. Try changing the keyword!';
                        }
                    });
        },
        viewDetails: function () {
            var vm = this;
            vm.loading = '';
            vm.no_results_text = false;
            window.history.pushState('page2', 'Title', '#/weather/' + vm.woeid);
            vm.displayDetails = true;
        }
    }
});

