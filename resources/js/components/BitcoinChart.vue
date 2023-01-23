<template>
    <div>
        <canvas id="bitcoin-chart" class="p-6"></canvas>
    </div>
</template>

<script>
    import Chart from 'chart.js/auto';
    import 'chartjs-adapter-date-fns';
    import { enUS } from 'date-fns/locale'

    export default {
        data() {
            return {
                bitcoinData: []
            }
        },
        async mounted() {
            console.log('Component mounted.')
            await this.getBitcoinData()
        },
        methods: {
            getBitcoinData: function() {
                const vm  = this
                axios({
                    method: 'get',
                    url: '/api/bitcoin-states',
                })
                    .then(function (response) {
                        vm.bitcoinData = response.data.data
                        vm.chart()
                    });
            },
            chart: function() {
                const vm = this
                new Chart(
                    document.getElementById('bitcoin-chart'),
                    {
                        type: 'line',
                        data: {
                            // labels: data.map(row => row.year),
                            datasets: [
                                {
                                    label: null,
                                    data: vm.bitcoinData
                                }
                            ]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: false,
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    type: 'time',
                                    time: {
                                        unit: 'month'
                                    },
                                    adapters: {
                                        date: {
                                            locale: enUS,
                                        },
                                    },
                                },
                                y: {
                                    ticks: {
                                        // Include a dollar sign in the ticks
                                        callback: function(value, index, ticks) {
                                            if(value >= 1000) {
                                                value = value / 1000 + 'k'
                                            }
                                            return value + ' $';
                                        }
                                    }
                                }
                            }
                        }

                    }
                );
            }
        }
    }
</script>
