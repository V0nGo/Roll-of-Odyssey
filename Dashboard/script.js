// Graphique des visiteurs
var optionsVisiteurs = {
    series: [{
        name: "Visiteurs",
        data: [30, 100, 180, 360, 410, 620, 555, 600]
    }],
    chart: {
        type: 'line',
        height: 300
    },
    xaxis: {
        type: 'datetime',
        categories: ['01/01/2021', '02/01/2021', '03/01/2021', '04/01/2021', '05/01/2021', '06/01/2021', '07/01/2021', '08/01/2021']
    },
    stroke: {
        curve: 'smooth'
    },
};

var chartVisiteurs = new ApexCharts(document.querySelector("#visiteurs"), optionsVisiteurs);
chartVisiteurs.render();


// Graphique des rôles (Joueur ou MJ)
var optionsRole = {
    series: [503, 120], //  données : 503 joueurs, 120 MJ
    chart: {
        type: 'pie',
        height: 300
    },
    labels: ['Joueurs', 'MJ'],
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
};

var chartRole = new ApexCharts(document.querySelector("#role"), optionsRole);
chartRole.render();

// Graphique des problèmes (Tickets résolus ou non par rapport au temps)
var optionsProblemes = {
    series: [{
        name: 'Résolus',
        data: [10, 15, 14, 18, 17, 13, 16] //  tickets résolus
    }, {
        name: 'Non résolus',
        data: [3, 8, 5, 7, 6, 5, 4] // tickets non résolus
    }],
    chart: {
        type: 'bar',
        height: 350
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
        },
    },
    xaxis: {
        categories: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil'],
    }
};

var chartProblemes = new ApexCharts(document.querySelector("#problemes"), optionsProblemes);
chartProblemes.render();


// Graphique des avis (Note sur 5)
var optionsAvis = {
    series: [{
        name: 'Notes',
        data: [4.0, 3.5, 4.0, 4.5, 3.0], //  moyenne des notes
    }],
    chart: {
        height: 350,
        type: 'radar',
    },
    labels: ['Graphisme', 'Jouabilité', 'Histoire', 'Musique', 'Originalité'],
    plotOptions: {
        radar: {
            size: 140,
            polygons: {
                strokeColors: '#e9e9e9',
                fill: {
                    colors: ['#f8f8f8', '#fff']
                }
            }
        }
    },
    title: {
        text: 'Avis sur le jeu (sur 5)'
    },
    markers: {
        size: 4,
        colors: ['#fff'],
        strokeColor: '#FF4560',
        strokeWidth: 2,
    },
    tooltip: {
        y: {
            formatter: function(val) {
                return val;
            }
        }
    },
    yaxis: {
        tickAmount: 5,
        labels: {
            formatter: function(val, i) {
                if (i % 2 === 0) {
                    return val;
                } else {
                    return '';
                }
            }
        }
    }
};

var chartAvis = new ApexCharts(document.querySelector("#avis"), optionsAvis);
chartAvis.render();
