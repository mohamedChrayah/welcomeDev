
// https://github.com/emn178/chartjs-plugin-labels
// documentation https://www.chartjs.org/samples/latest/

/* SOMMAIRE DES FONCTIONS DEJA DEVELOPPE

  1) AFFICHE GRAPHIQUE CLASSIQUE AVEC COULEUR PRES CHARGE
  Nom de la fonction : function insertChart(myGraphF, typeF, labelsF, nameF, dataF, borderWidthF)

  2) AFFICHE UN GRAPHIQUE AVEC UNE SEULE COULEUR
  Nom de la fonction : function insertChartWhitOneColor(myGraphF, typeF, labelsF, nameF, dataF, borderWidthF, fill=false, backgroundColor=null)

  3) AFFICHE UN GRAPHIQUE SANS LES POURCENTAGES
  Nom de la fonction : function insertChartAnyPercentage(myGraphF, typeF, labelsF, nameF, dataF, borderWidthF)

  4) AFFICHE UN GRAPHIQUE AVEC LES POURCENTAGES
  Nom de la fonction : function insertChartWithPercentage(myGraphF, typeF, labelsF, nameF, dataF, borderWidthF)

  5) AFFICHE UN GRAPHIQUE AVEC 5 LIGNES DE COUELEURS
  Nom de la fonction : function insertMixedChartLine(myGraphF, labelsF, nameDataSet1, data1, nameDataSet2, data2, nameDataSet3, data3, nameDataSet4, data4, nameDataSet5, data5)

  6) AFFICHE UN GRAPHIQUE AVEC 2 GRAPHIQUE EN BAR
  Nom de la fonction : function insertDoubleBarChart(myGraphF, labelsF, nameDataSet1, data1, nameDataSet2, data2)

  7) AFFICHE UN GRAPHIQUE AVEC 2 GRAPHIQUE EN LIGNE
  Nom de la fonction : function insertDoubleLineChart(myGraphF, labelsF, nameDataSet1, data1, color1, data2, color2, title)

*/


// Fonction générique d'insertion de graphique
// Paramètres :
// myGraphF -> id du canvas
// typeF -> type du canvas
// labelsF -> Légende
// nameF -> nom du canvas
// dataF -> données du canvas
// borderWidthF -> Longueur
function insertChart(myGraphF, typeF, labelsF, nameF, dataF, borderWidthF, fill=false, title=null, borderColor=null){
  /* AFFECTE UNE COULEUR DE BASE DANS LE CAS OU AUCUN CHOIX N A ETE FAIT */
  backgroundColor = ['rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)', 'rgba(255, 189, 255, 1)'
    , 'rgba(120, 189, 20, 1)', 'rgba(190, 140, 20, 1)', 'rgba(0, 189, 160, 1)', 'rgba(156, 150, 150, 1)', 'rgba(20, 20, 20, 1)'];

  if(title == null){
    title = '';
  }

  if(borderColor == null){
    borderColor = backgroundColor;
  }

  var ctx = document.getElementById(myGraphF).getContext('2d');
  var myChart = new Chart(ctx, {
    type: typeF,
    data: {
      labels: labelsF,
      datasets: [{
        label: nameF,
        data: dataF,
        backgroundColor: backgroundColor,
        borderColor: borderColor,
        borderWidth: borderWidthF,
        fill: fill
      }],
    },
    options: {
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      plugins: {
        labels: {
          render : 'value',
          precision: 2
        }
      },
      legend: {
        display: true,
        position: 'bottom'
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });

  return myChart;
}

// Fonction générique d'insertion de graphique de type pie chart
// Paramètres :
// myGraphF -> id du canvas
// labelsF -> Légende
// nameF -> nom du canvas
// dataF -> données du canvas
// borderWidthF -> Longueur
function insertChartPieChart(myGraphF, labelsF, nameF, dataF, borderWidthF, fill=false, title=null, borderColor=null){
  /* AFFECTE UNE COULEUR DE BASE DANS LE CAS OU AUCUN CHOIX N A ETE FAIT */
  backgroundColor = ['rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)', 'rgba(255, 189, 255, 1)'
    , 'rgba(120, 189, 20, 1)', 'rgba(190, 140, 20, 1)', 'rgba(0, 189, 160, 1)', 'rgba(156, 150, 150, 1)', 'rgba(20, 20, 20, 1)'];

  if(title == null){
    title = '';
  }

  if(borderColor == null){
    borderColor = backgroundColor;
  }

  var ctx = document.getElementById(myGraphF).getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labelsF,
      datasets: [{
        label: nameF,
        data: dataF,
        backgroundColor: backgroundColor,
        borderColor: borderColor,
        borderWidth: borderWidthF,
        fill: fill
      }],
    },
    options: {
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      plugins: {
        labels: {
          render : 'percentage',
          fontColor: 'white',
          precision: 2
        }
      },
      legend: {
        display: true,
        position: 'bottom'
      }
    }
  });

  return myChart;
}

// Fonction générique d'insertion de graphique de type pie chart
// Paramètres :
// myGraphF -> id du canvas
// labelsF -> Légende
// nameF -> nom du canvas
// dataF -> données du canvas
// borderWidthF -> Longueur
function insertChartPieChartNumber(myGraphF, labelsF, nameF, dataF, borderWidthF, fill=false, title=null, borderColor=null){
  /* AFFECTE UNE COULEUR DE BASE DANS LE CAS OU AUCUN CHOIX N A ETE FAIT */
  backgroundColor = ['rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)', 'rgba(255, 189, 255, 1)'
    , 'rgba(120, 189, 20, 1)', 'rgba(190, 140, 20, 1)', 'rgba(0, 189, 160, 1)', 'rgba(156, 150, 150, 1)', 'rgba(20, 20, 20, 1)'];

  if(title == null){
    title = '';
  }
  if(borderColor == null){
    borderColor = backgroundColor;
  }

  var ctx = document.getElementById(myGraphF).getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labelsF,
      datasets: [{
        label: nameF,
        data: dataF,
        backgroundColor: backgroundColor,
        borderColor: borderColor,
        borderWidth: borderWidthF,
        fill: fill
      }],
    },
    options: {
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      plugins: {
        labels: {
          render : 'value',
          fontColor: 'white',
          precision: 2
        }
      },
      legend: {
        display: true,
        position: 'bottom'
      }
    }
  });

  return myChart;
}

// Fonction générique d'insertion de graphique de type pie chart
// Paramètres :
// myGraphF -> id du canvas
// labelsF -> Légende
// nameF -> nom du canvas
// dataF -> données du canvas
// borderWidthF -> Longueur
function insertChartPieChartNumberNoAnimation(myGraphF, labelsF, nameF, dataF, borderWidthF, fill=false, title=null, borderColor=null){
  /* AFFECTE UNE COULEUR DE BASE DANS LE CAS OU AUCUN CHOIX N A ETE FAIT */
  backgroundColor = ['rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)', 'rgba(255, 189, 255, 1)'
    , 'rgba(120, 189, 20, 1)', 'rgba(190, 140, 20, 1)', 'rgba(0, 189, 160, 1)', 'rgba(156, 150, 150, 1)', 'rgba(20, 20, 20, 1)'];

  if(title == null){
    title = '';
  }
  if(borderColor == null){
    borderColor = backgroundColor;
  }

  var ctx = document.getElementById(myGraphF).getContext('2d');

  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labelsF,
      datasets: [{
        label: nameF,
        data: dataF,
        backgroundColor: backgroundColor,
        borderColor: borderColor,
        borderWidth: borderWidthF,
        fill: fill
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      plugins: {
        labels: {
          render : 'value',
          fontColor: 'white',
          precision: 2
        }
      },
      legend: {
        display: true,
        position: 'bottom'
      },
      animation : false
    }
  });

  return myChart;
}

// Fonction générique d'insertion de graphique de type pie chart
// Paramètres :
// myGraphF -> id du canvas
// labelsF -> Légende
// nameF -> nom du canvas
// dataF -> données du canvas
// borderWidthF -> Longueur
function insertChartPieChartNumberFormat(myGraphF, labelsF, nameF, dataF, borderWidthF, fill=false, title=null, borderColor=null){
  /* AFFECTE UNE COULEUR DE BASE DANS LE CAS OU AUCUN CHOIX N A ETE FAIT */
  backgroundColor = ['rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)', 'rgba(255, 189, 255, 1)'
    , 'rgba(120, 189, 20, 1)', 'rgba(190, 140, 20, 1)', 'rgba(0, 189, 160, 1)', 'rgba(156, 150, 150, 1)', 'rgba(20, 20, 20, 1)'];

  if(title == null){
    title = '';
  }
  if(borderColor == null){
    borderColor = backgroundColor;
  }

  var ctx = document.getElementById(myGraphF).getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labelsF,
      datasets: [{
        label: nameF,
        data: dataF,
        backgroundColor: backgroundColor,
        borderColor: borderColor,
        borderWidth: borderWidthF,
        fill: fill
      }],
    },
    options: {
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      plugins: {
        labels: {
          render : function(args) {
            return numeral(args.value).format('0,0$');
          },
          fontColor: 'white',
          precision: 2
        },
      },
      legend: {
        display: true,
        position: 'bottom'
      },
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            return `${data.labels[tooltipItem.datasetIndex]} - ${numeral(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]).format('0,0$')}`;
          }
        }
      },
    }
  });

  return myChart;
}

/* AFFICHE UN GRAPHIQUE SANS LES POURCENTAGE */
/* myGraphF = id du CANVA */
/* typeF = le type de graphique attendu (bar, line, pie, ect...) */
/* labelsF = Les labels situé en bas du graphique, sous chaque colonne */
/* nameF = Les labels de la légende */
/* dataF = un tableau de data pour le graphique */
/* borderWidthF = choisir la taille de la bordure */
/* fill = remplir complètement la zone de la couleur choisi */
/* backgroundColor = choisir une couleur de remplissage */
/* title = titre du graphique */
function insertChartWhitOneColor(myGraphF, typeF, labelsF, nameF, dataF, borderWidthF, fill=false, backgroundColor=null, title=null, textColor=null, borderColor=null,renderValue='value'){
  /* AFFECTE UNE COULEUR DE BASE DANS LE CAS OU AUCUN CHOIX N A ETE FAIT */
  if(backgroundColor == null){
    backgroundColor = 'rgba(255, 206, 86, 1)';
  }

  if(borderColor == null){
    borderColor = backgroundColor;
  }

  if(title == null){
    title = '';
  }

  if(textColor == null){
    textColor = 'black';
  }

  var ctx = document.getElementById(myGraphF).getContext('2d');
  var myChart = new Chart(ctx, {
    type: typeF,
    data: {
      labels: labelsF,
      datasets: [{
        label: nameF,
        data: dataF,
        backgroundColor: backgroundColor,
        borderColor: borderColor,
        borderWidth: borderWidthF,
        fill: fill
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      legend: {
        display: true,
        position: 'bottom'
      },
      plugins: {
        labels: {
          render : renderValue,
          fontColor: textColor,
          precision: 1
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }

  });

  return myChart;
}

/* AFFICHE UN GRAPHIQUE SANS LES POURCENTAGE */
/* myGraphF = id du CANVA */
/* typeF = le type de graphique attendu (bar, line, pie, ect...) */
/* labelsF = Les labels situé en bas du graphique, sous chaque colonne */
/* nameF = Les labels de la légende */
/* dataF = un tableau de data pour le graphique */
/* borderWidthF = choisir la taille de la bordure */
function insertChartAnyPercentage(myGraphF, typeF, labelsF, nameF, dataF, borderWidthF, fontColor = 'black'){
  /* VARIABLES DES COUELEURS GENERES POUR LES GRAPHIQUES */
  backgroundColorF = ['rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)', 'rgba(255, 189, 255, 1)'
    , 'rgba(120, 189, 20, 1)', 'rgba(190, 140, 20, 1)', 'rgba(0, 189, 160, 1)', 'rgba(156, 150, 150, 1)', 'rgba(20, 20, 20, 1)'];
  borderColorF = ['rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)', 'rgba(255, 189, 20, 1)'
    , 'rgba(120, 189, 20, 1)', 'rgba(190, 140, 20, 1)', 'rgba(0, 189, 160, 1)', 'rgba(156, 150, 150, 1)', 'rgba(20, 20, 20, 1)'];

  var ctx = document.getElementById(myGraphF).getContext('2d');
  var myChart = new Chart(ctx, {

    type: typeF,
    data: {
      labels: labelsF,
      datasets: [{
        label: nameF,
        data: dataF,
        backgroundColor: backgroundColorF,
        borderColor: borderColorF,
        borderWidth: borderWidthF,
      }],
    },
    options: {
      plugins: {
        labels: {
          fontColor: fontColor
        }
      }
    }
  });
}

/* AFFICHE UN GRAPHIQUE AVEC LES POURCENTAGES EN OPTIONS */
/* myGraphF = id du CANVA */
/* typeF = le type de graphique attendu (bar, line, pie, ect...) */
/* labelsF = Les labels situé en bas du graphique, sous chaque colonne */
/* nameF = Les labels de la légende */
/* dataF = un tableau de data pour le graphique */
/* borderWidthF = choisir la taille de la bordure */
function insertChartWithPercentage(myGraphF, typeF, labelsF, nameF, dataF, borderWidthF){
  var ctx = document.getElementById(myGraphF).getContext('2d');
  var myChart = new Chart(ctx, {
    type: typeF,
    data: {
      labels: labelsF,
      datasets: [{
        label: nameF,
        data: dataF,
        backgroundColor: 'rgba(255, 206, 86, 1)',
        borderColor: 'rgba(255, 206, 86, 1)',
        borderWidth: borderWidthF,
      }],
    },
    options: {
       plugins: {
           labels: {
               render : 'percentage',
               fontColor: 'black',
               precision: 2
           }
       },
       scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
      }
    }
  });
}


/* AFFICHE UN GRAPHIQUE EN BAR ET EN LIGNE */
/* myGraphF = id du CANVA */
/* labelsF = Les labels situé en bas du graphique, sous chaque colonne */
/* dataBar = un tableau de data pour le graphique en BAR */
/* dataLine = un tableau de data pour le graphique en LINE */
/* barColor = couleur des barres initialisé sur une couleur de base (non obligatoire) */
/* lineColor = couleur des lignes initialisé sur une couleur de base (non obligatoire) */
function insertMixedChartBarAndLine(myGraphF, labelsF, dataBar, dataLine, nameDataSet1, nameDataSet2, barColor=null, lineColor=null, title=null){
  if(barColor == null){
    barColor = "rgb(255, 99, 132)";
  }
  if(lineColor == null){
    lineColor = "rgb(255, 99, 132)";
  }
  if(title == null){
    title = "Titre du Graphique";
  }

  var ctx = document.getElementById(myGraphF).getContext('2d');
  var mixedChart = new Chart(ctx,{
    type:"bar",
    data:{
      labels: labelsF,
      datasets:[
      {
        label: nameDataSet1,
        data: dataBar,
        borderColor: barColor,
        backgroundColor: barColor,
        yAxisID: 'A',
      },
      {
        label: nameDataSet2,
        data: dataLine,
        type: "line",
        fill: false,
        yAxisID: 'B',
        borderColor: lineColor,
        backgroundColor: lineColor,
      }]
    },
    options:{
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      legend: {
        display: true,
        position: 'bottom'
      },
      plugins: {
        labels: {
          render : 'value',
          fontColor: 'black',
          precision: 1
        }
      },
      scales: {
        yAxes: [{
          id: 'A',
          type: 'linear',
          position: 'left',
          ticks: {
            beginAtZero: true
          }
        }, {
          id: 'B',
          type: 'linear',
          position: 'right',
          ticks: {
            beginAtZero: true
          }
        }]
     }
    }
  });

  return mixedChart;
}


/* AFFICHE GRAPHIQUE AVEC AUTANT DE LIGNE QUE PRECISE DANS LA DATA */
/* myGraphF = id du CANVA */
/* labelsF = Les labels situé en bas du graphique, sous chaque colonne */
/* data = type array [name, data, color] l'ensemble des données permettant de créer les lignes */
function insertMoreChartLine(myGraphF, labelsF, data){

  var dataSet = [];

  for(i = 0; i < data.length; i++){
    if(i == 0){
      var dataSetChild = {
        label: data[i][0],
        data: data[i][1],
        fill: false,
        borderColor: data[i][2],
        backgroundColor: data[i][2]
      };
    }else{
      var dataSetChild = {
        label: data[i][0],
        data: data[i][1],
        type: "line",
        fill: false,
        borderColor: data[i][2],
        backgroundColor: data[i][2]
      }
    }

    dataSet.push(dataSetChild);
  }

  var ctx = document.getElementById(myGraphF).getContext('2d');
  var mixedChart = new Chart(ctx,{
    type:"line",
    data: {
      labels: labelsF,
      datasets: dataSet
    },
    options:{
      plugins: {
        labels: {
            render : 'value',
            fontColor: 'black',
            precision: 1
        }
      },
      scales: {
       yAxes: [{
           ticks: {
               beginAtZero: true
           }
       }]
     },
     legend: {
       display: true,
       position: 'bottom'
     },
     layout: {
        padding: {
          top: 25
        }
      }
    }
  });

  return mixedChart;
}


/* AFFICHE GRAPHIQUE EN LINE AVEC 5 LINES */
/* myGraphF = id du CANVA */
/* labelsF = Les labels situé en bas du graphique, sous chaque colonne */
/* nameDataSet1 = Les labels de la légende pour la data 1 */
/* data1 = un tableau de data pour la data 1 */
/* nameDataSet2 = Les labels de la légende pour la data 2 */
/* data2 = un tableau de data pour la data 2 */
/* nameDataSet3 = Les labels de la légende pour la data 3 */
/* data3 = un tableau de data pour la data 3 */
/* nameDataSet4 = Les labels de la légende pour la data 4 */
/* data4 = un tableau de data pour la data 4 */
/* nameDataSet5 = Les labels de la légende pour la data 5 */
/* data5 = un tableau de data pour la data 5 */
function insertMixedChartLine(myGraphF, labelsF,
  nameDataSet1, data1, color1='rgb(192, 57, 43)',
  nameDataSet2, data2, color2='rgb(81, 46, 95)',
  nameDataSet3, data3, color3='rgb(21, 67, 96)',
  nameDataSet4, data4, color4='rgb(125, 102, 8)',
  nameDataSet5, data5, color5='rgb(110, 44, 0)'
){
  var ctx = document.getElementById(myGraphF).getContext('2d');
  var mixedChart = new Chart(ctx,{
    type:"line",
    data:{
      labels: labelsF,
      datasets:[{
        label: nameDataSet1,
        data: data1,
        fill: false,
        borderColor: color1,
        backgroundColor: color1
      },{
        label: nameDataSet2,
        data: data2,
        type: "line",
        fill: false,
        borderColor: color2,
        backgroundColor: color2
      },{
        label: nameDataSet3,
        data: data3,
        type: "line",
        fill: false,
        borderColor: color3,
        backgroundColor: color3
      },{
        label: nameDataSet4,
        data: data4,
        type: "line",
        fill: false,
        borderColor: color4,
        backgroundColor: color4
      },{
        label: nameDataSet5,
        data: data5,
        type: "line",
        fill: false,
        borderColor: color5,
        backgroundColor: color5
      }]
    },
    options:{
      plugins: {
        labels: {
            render : 'value',
            fontColor: 'black',
            precision: 1
        }
      },
      scales: {
       yAxes: [{
           ticks: {
               beginAtZero: true
           }
       }]
     }
    }
  });
}

/* AFFICHE GRAPHIQUE EN LINE AVEC 5 BAR */
/* myGraphF = id du CANVA */
/* labelsF = Les labels situé en bas du graphique, sous chaque colonne */
/* nameDataSet1 = Les labels de la légende pour la data 1 */
/* data1 = un tableau de data pour la data 1 */
/* nameDataSet2 = Les labels de la légende pour la data 2 */
/* data2 = un tableau de data pour la data 2 */
/* nameDataSet3 = Les labels de la légende pour la data 3 */
/* data3 = un tableau de data pour la data 3 */
/* nameDataSet4 = Les labels de la légende pour la data 4 */
/* data4 = un tableau de data pour la data 4 */
/* nameDataSet5 = Les labels de la légende pour la data 5 */
/* data5 = un tableau de data pour la data 5 */
function insertMixedChartBar(myGraphF, labelsF, nameDataSet1, data1, nameDataSet2, data2, nameDataSet3, data3, nameDataSet4, data4, nameDataSet5, data5, title){
  var ctx = document.getElementById(myGraphF).getContext('2d');
  var mixedChart = new Chart(ctx,{
    type:"bar",
    data:{
      labels: labelsF,
      datasets:[{
        label: nameDataSet1,
        data: data1,
        fill: false,
        backgroundColor: "rgb(102,153,255)"
      },{
        label: nameDataSet2,
        data: data2,
        type: "bar",
        fill: false,
        backgroundColor: "rgb(212,97,18)"
      },{
        label: nameDataSet3,
        data: data3,
        type: "bar",
        fill: false,
        backgroundColor: "rgb(169,208,142)"
      },{
        label: nameDataSet4,
        data: data4,
        type: "bar",
        fill: false,
        backgroundColor: "rgb(153,153,255)"
      },{
        label: nameDataSet5,
        data: data5,
        type: "bar",
        fill: false,
        backgroundColor: "rgb(102,204,255)"
      }]
    },
    options:{
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      legend: {
        display: true,
        position: 'bottom'
      },
      plugins: {
        labels: {
          render : 'value',
          fontColor: 'black',
          precision: 1
        }
      },
      scales: {
       yAxes: [{
         ticks: {
           beginAtZero: true
         }
       }]
     }
    }
  });
}

/* AFFICHE GRAPHIQUE AVEC 2 BAR */
/* myGraphF = id du CANVA */
/* labelsF = Les labels situé en bas du graphique, sous chaque colonne */
/* nameDataSet1 = Les labels de la légende pour la data 1 */
/* data1 = un tableau de data pour la data 1 */
/* nameDataSet2 = Les labels de la légende pour la data 2 */
/* data2 = un tableau de data pour la data 2 */
function insertDoubleBarChart(myGraphF, labelsF, nameDataSet1, data1, color1, nameDataSet2, data2, color2, title){

  var ctx = document.getElementById(myGraphF).getContext('2d');
  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: labelsF,
      datasets: [{
        label: nameDataSet1,
        data: data1,
        backgroundColor: color1,
        fill: false
      },{
        label: nameDataSet2,
        data: data2,
        type: "bar",
        fill: false,
        backgroundColor: color2
      }],
    },
    options: {
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      legend: {
        display: true,
        position: 'bottom'
      },
      plugins: {
        labels: {
          render : 'value',
          fontColor: 'black',
          precision: 1
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    },


  });

  return myChart;
}

/* AFFICHE GRAPHIQUE AVEC 2 BAR ET 2 AXES VERTICAUX */
/* myGraphF = id du CANVA */
/* labelsF = Les labels situé en bas du graphique, sous chaque colonne */
/* nameDataSet1 = Les labels de la légende pour la data 1 */
/* data1 = un tableau de data pour la data 1 */
/* nameDataSet2 = Les labels de la légende pour la data 2 */
/* data2 = un tableau de data pour la data 2 */
function insertDoubleBarChartAvec2AxesY(myGraphF, labelsF, nameDataSet1, data1, color1, nameDataSet2, data2, color2, title){

  var ctx = document.getElementById(myGraphF).getContext('2d');
  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: labelsF,
      datasets: [{
        label: nameDataSet1,
        yAxisID: 'A',
        data: data1,
        backgroundColor: color1,
        fill: false
      },{
        label: nameDataSet2,
        yAxisID: 'B',
        data: data2,
        type: "bar",
        fill: false,
        backgroundColor: color2
      }],
    },
    options: {
      responsive: true,
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      legend: {
        display: true,
        position: 'bottom'
      },
      plugins: {
        labels: {
          render : 'value',
          fontColor: 'black',
          precision: 1
        }
      },
      scales: {
        yAxes: [
          {
            id: 'A',
            type: 'linear',
            display: true,
            position: 'left',
            scalePositionLeft: true,
            ticks: {
              min: 0,
              callback: function(value) {
                return value;
              }
            }
          },
          {
            id: 'B',
            type: 'linear',
            display: true,
            position: 'right',
            scalePositionRight: true,
            ticks: {
              min: 0,
              callback: function(value) {
                return value;
              }
            }
          }
        ]
      }
    }
  });

  return myChart;
}

function insertTripleBarChart(myGraphF, labelsF, nameDataSet1, data1, color1, nameDataSet2, data2, color2, nameDataSet3, data3, color3, title){
  var ctx = document.getElementById(myGraphF).getContext('2d');
  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: labelsF,
      datasets: [{
        label: nameDataSet1,
        data: data1,
        backgroundColor: color1,
        fill: false
      },{
        label: nameDataSet2,
        data: data2,
        type: "bar",
        fill: false,
        backgroundColor: color2
      },{
        label: nameDataSet3,
        data: data3,
        type: "bar",
        fill: false,
        backgroundColor: color3
      }],
    },
    options: {
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      legend: {
        display: true,
        position: 'bottom'
      },
      plugins: {
        labels: {
          render : 'value',
          fontColor: 'black',
          precision: 1
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });

  return myChart;
}

/* AFFICHE GRAPHIQUE AVEC 2 BAR */
/* myGraphF = id du CANVA */
/* labelsF = Les labels situé en bas du graphique, sous chaque colonne */
/* nameDataSet1 = Les labels de la légende pour la data 1 */
/* data1 = un tableau de data pour la data 1 */
/* nameDataSet2 = Les labels de la légende pour la data 2 */
/* data2 = un tableau de data pour la data 2 */
function insertTripleStackBarChart(myGraphF, labelsF, nameDataSet1, data1, color1, nameDataSet2, data2, color2, nameDataSet3, data3, color3, title){
  var ctx = document.getElementById(myGraphF).getContext('2d');
  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: labelsF,
      datasets: [
        {
          label: nameDataSet1,
          data: data1,
          backgroundColor: color1,
          stack: 'Stack 0'
        },{
          label: nameDataSet2,
          data: data2,
          backgroundColor: color2,
          stack: 'Stack 0'
        },{
          label: nameDataSet3,
          data: data3,
          backgroundColor: color3,
          stack: 'Stack 0'
        }
      ],
    },
    options: {
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      legend: {
        display: true,
        position: 'bottom'
      },
      plugins: {
        labels: {
          render : 'value',
          fontColor: 'black',
          precision: 1
        },
        datalabels: {
           display: true,
           align: 'center',
           anchor: 'center'
        }
      },
      responsive: true,
      interaction: {
        intersect: false,
      },
      scales: {
        x: {
          stacked: true
        },
        y: {
          stacked: true
        }
      }
    }
  });
}

function insertDoubleBarChart2(myGraphF, labelsF, nameDataSet1, data1, color1, nameDataSet2, data2, color2, title){
  var ctx = document.getElementById(myGraphF).getContext('2d');
  var mixedChart = new Chart(ctx,{
    type:"bar",
    data:{
      labels: labelsF,
      datasets:[{
        label: nameDataSet1,
        data: data1,
        fill: false,
        backgroundColor: color1
      },{
        label: nameDataSet2,
        data: data2,
        type: "bar",
        fill: false,
        backgroundColor: color2
      }]
    },
    options:{
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      legend: {
        display: true,
        position: 'bottom'
      },
      plugins: {
        labels: {
          render : 'value',
          fontColor: 'black',
          precision: 1
        }
      },
      scales: {
       yAxes: [{
         ticks: {
           beginAtZero: true
         }
       }]
     }
    }
  });

  return myChart;
}

/* AFFICHE GRAPHIQUE AVEC 2 LIGNE */
/* myGraphF = id du CANVA */
/* labelsF = Les labels situé en bas du graphique, sous chaque colonne */
/* nameDataSet1 = Les labels de la légende pour la data 1 */
/* data1 = un tableau de data pour la data 1 */
/* nameDataSet2 = Les labels de la légende pour la data 2 */
/* data2 = un tableau de data pour la data 2 */
function insertDoubleLineChart(myGraphF, labelsF, nameDataSet1, data1, color1, nameDataSet2, data2, color2, title){
  var ctx = document.getElementById(myGraphF).getContext('2d');
  var mixedChart = new Chart(ctx,{
    type:"line",
    data:{
      labels: labelsF,
      datasets:[{
        label: nameDataSet1,
        data: data1,
        fill: false,
        borderColor: color1,
        backgroundColor: color1
      },{
        label: nameDataSet2,
        data: data2,
        type: "line",
        fill: false,
        borderColor: color2,
        backgroundColor: color2
      }]
    },
    options:{
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      legend: {
        display: true,
        position: 'bottom'
      },
      plugins: {
        labels: {
          render : 'value',
          fontColor: 'black',
          precision: 1
        }
      },
      scales: {
       yAxes: [{
         ticks: {
           beginAtZero: true
         }
       }]
     }
    }
  });
}

/* AFFICHE GRAPHIQUE AVEC UNE GAUGE */
/* myGraphF = id du CANVA */
/* nameDataSet1 = Les noms situé dans la gauge */
/* needleValueF = Les valeurs situé dans la gauge */
/* colorBack = Les couleurs de la gauge */
function insertGaugeWithoutTitle(myGraphF,LabelsF,nameDataSet1,needleValueF,colorBack,pointerColor = null,fontColor = 'grey'){
  var ctx= document.getElementById(myGraphF);
  if (pointerColor == null) {
    pointerColor = 'black';
  }
  var gaugeChart = new Chart(ctx, {
    type: "doughnut",
    plugins: {
       labels:false,
       afterDraw: chart => {
        var needleValue = chart.chart.config.data.datasets[0].needleValue;
        var dataTotal = chart.chart.config.data.datasets[0].data.reduce((a, b) => a + b, 0);
        var angle = Math.PI + (1 / dataTotal * needleValue * Math.PI);
        var ctx = chart.chart.ctx;
        var cw = chart.chart.canvas.offsetWidth;
        var ch = chart.chart.canvas.offsetHeight;
        var cx = cw / 2;
        var cy = ch - 6;

        ctx.translate(cx, cy);
        ctx.rotate(angle);
        ctx.beginPath();
        ctx.moveTo(0, -3);
        ctx.lineTo(ch - 90, 0);
        ctx.lineTo(0, 3);
        ctx.fillStyle = pointerColor;
        ctx.fill();
        ctx.rotate(-angle);
        ctx.translate(-cx, -cy);
        ctx.beginPath();
        ctx.arc(cx, cy, 5, 0, Math.PI * 2);
        ctx.fill();
      },
    },
    data: {
      labels: LabelsF,
      datasets: [{
        data: nameDataSet1,
        needleValue:needleValueF,
        backgroundColor: colorBack,
        borderColor: ["white","white","white"],
        borderWidth: 1
      }]
    },
     options: {
      title: {
        display: false
      },
        legend: {
        display: false
      },
      maintainAspectRatio: false,
      circumference:  1 * Math.PI,
      rotation:  1 * Math.PI,
      cutoutPercentage: 70,
      animation: {
        animateRotate: true,
        animateScale: false
      },
      plugins: {
        labels: {
          fontColor: fontColor
        }
      }
    }
  });
}


function insertChartDoughnut(myGraph, title, arrayLabels, arrayValue, arrayColor, fontColorText, activeLegend = true){
  var ctx= document.getElementById(myGraph);
  var gaugeChart = new Chart(ctx, {
    type: "doughnut",
    data: {
      labels: arrayLabels,
      datasets: [{
        data: arrayValue,
        backgroundColor: arrayColor,
        borderWidth: 3
      }]
    },
    options: {
      legend: {
        display: activeLegend,
        position: "left",
        labels:{
          fontColor: fontColorText
        }
      },
      cutoutPercentage: 55,
      animation: {
        animateRotate: true,
        animateScale: false
      },
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18,
        fontColor: fontColorText
      },
      plugins: {
        labels: {
          render : 'value',
          precision: 2,
          fontColor: fontColorText
        }
      },
    }
  });

  return gaugeChart;
}

function insertChartWhitOneColorScale(myGraphF, typeF, labelsF, nameF, dataF, borderWidthF, fill=false, backgroundColor=null, title=null){
  /* AFFECTE UNE COULEUR DE BASE DANS LE CAS OU AUCUN CHOIX N A ETE FAIT */
  if(backgroundColor == null){
    backgroundColor = 'rgba(255, 206, 86, 1)';
  }

  if(title == null){
    title = '';
  }

  var ctx = document.getElementById(myGraphF).getContext('2d');
  var myChart = new Chart(ctx, {
    type: typeF,
    data: {
      labels: labelsF,
      datasets: [{
        label: nameF,
        data: dataF,
        backgroundColor: backgroundColor,
        borderColor: backgroundColor,
        borderWidth: borderWidthF,
        fill: fill
      }],
    },
    options: {
      responsive: false,
      maintainAspectRatio: true,
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      legend: {
        display: true,
        position: 'bottom'
      },
      plugins: {
        labels: {
          render : 'value',
          fontColor: 'black',
          precision: 1
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });

  return myChart;
}




/* AFFICHE GRAPHIQUE AVEC 1 LIGNE */
/* myGraphF = id du CANVA */
/* labelsF = Les labels situé en bas du graphique, sous chaque colonne */
/* nameDataSet1 = Les labels de la légende pour la data 1 */
/* data1 = un tableau de data pour la data 1 */
function insertLineChart(myGraphF, labelsF, nameDataSet1, data1, color1, title){
  var ctx = document.getElementById(myGraphF).getContext('2d');
  var mixedChart = new Chart(ctx,{
    type:"line",
    data:{
      labels: labelsF,
      datasets:[{
        label: nameDataSet1,
        data: data1,
        fill: false,
        backgroundColor: color1
      }]
    },
    options:{
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      legend: {
        display: true,
        position: 'bottom'
      },
      plugins: {
        labels: {
          render : 'value',
          fontColor: 'black',
          precision: 1
        }
      },
      scales: {
       yAxes: [{
         ticks: {
           beginAtZero: true
         }
       }]
     }
    }
  });
}
function insertChartForPartenaireSynthese(myGraphF, typeF, labelsF, nameF, dataF, borderWidthF, fill=false, backgroundColor=null, title=null, textColor=null, borderColor=null,renderValue='value'){
  /* AFFECTE UNE COULEUR DE BASE DANS LE CAS OU AUCUN CHOIX N A ETE FAIT */
  if(backgroundColor == null){
    backgroundColor = 'rgba(255, 206, 86, 1)';
  }

  if(borderColor == null){
    borderColor = backgroundColor;
  }

  if(title == null){
    title = '';
  }

  if(textColor == null){
    textColor = 'black';
  }

  var ctx = document.getElementById(myGraphF).getContext('2d');
  var myChart = new Chart(ctx, {
    type: typeF,
    data: {
      labels: labelsF,
      datasets: [{
        label: nameF,
        data: dataF,
        backgroundColor: backgroundColor,
        borderColor: borderColor,
        borderWidth: borderWidthF,
        fill: fill
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      title: {
        display: true,
        text: title,
        position: 'top',
        fontSize: 18
      },
      legend: {
        display: true,
        position: 'bottom'
      },
      plugins: {
        labels: {
          render : renderValue,
          fontColor: textColor,
          precision: 1
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      tooltips:{
        callbacks:{
          title: function(tooltipItem, data) {
            return data['labels'][tooltipItem[0]['index']];
          },
          label: function(tooltipItem, data) {
            return data['datasets'][0]['data'][tooltipItem['index']]+ ' €';
          },

        }
      }

    }

  });

  return myChart;
}
