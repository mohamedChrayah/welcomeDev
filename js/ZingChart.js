



function chartGauge(myChart, range, scaleGraph, scaleR, rules, valueCenter, backgroundColor, styleSize, x, y){
  let chartConfig = {

    globals: {
      color: '#666',
    },

    backgroundColor: 'transparent',

    graphset: [
      {
        type: 'gauge',
        width: '31.5%',
        height: '50%',
        x: '0px',
        y: '0px',

        // PLOT : EPAISSEUR + TAILLE DE LA FLECHE
        plot: {
          csize: '3%',
          size: '100%',
        },

        plotarea: {
          marginTop: '35%',
        },

        // TAILL DU GRAPHIQUE
        scale: {
          sizeFactor: scaleGraph,
          mediaRules: [
            // {
            //   maxWidth: '650px',
            //   sizeFactor: 5,
            // },
          ],
        },

        // ROND AVEC LA VALEUR DE LA FLECHE
        scaleR: {
          aperture: 180,
          values: scaleR,
          center: {
            borderColor: '#23211E',
            borderWidth: '2px',
            mediaRules: [
              {
                //maxWidth: '650px',
                //size: '10px',
              },
            ],
            size: '15px',
          },
          guide: {
            alpha: 1,
            backgroundColor: '#E3DEDA',
          },
          item: {
            offsetR: 0,
          },

          // REGLE COULEUR INTERIEUR DEMI CERCLE
          markers: [
            {
              type: 'area',
              alpha: 0.95,
              backgroundColor: backgroundColor,
              range: range,
            },
          ],

          // REGLE DE GESTION DES COULEUR PAR STEP
          ring: {
            rules: rules
          },

          tick: {
            visible: false,
          },
        },

        tooltip: {
          visible: false,
        },

        // GESTION DE LA POSITION DU GRAPHIQUE TAILLE MAX ET MIN
        mediaRules: [
          {
            maxWidth: '650px',
            width: '100%',
            height: '19%',
            x: x,
            y: y,
          }
        ],

        // VALEUR PLACE AU CENTRE DE LA GAUGE
        series: [
          {
            values: [valueCenter],
            valueBox: {
              text: '%v',
              fontColor: backgroundColor,
              fontSize: '18px',
              mediaRules: [
                {
                  fontSize: '10px',
                  maxWidth: '650px',
                },
              ],
              placement: 'center',
            },
            backgroundColor: '#23211E',
          },
        ],
      }
    ]
  };

  // GESTION DU SPINNER
  var spinner = "#" + myChart + "Spinner";
  if (typeof spinner !== 'undefined') {
    $(spinner).removeClass("d-block");
    $(spinner).addClass("d-none");
  }

  // GESTION DU TITRE
  var title = "#" + myChart + "Title";
  if (typeof title !== 'undefined') {
    $(title).removeClass("d-none");
    $(title).addClass("d-block");
  }

  // GESTION DU GRAPHIQUE
  var graphique = "#" + myChart + "Graphique";
  if (typeof graphique !== 'undefined') {
    $(graphique).removeClass("d-none");
    $(graphique).addClass("d-block");
  }

  zingchart.render({
    id: myChart,
    data: chartConfig,
    events: {
      load: function(p) {
        var svg = "#" + myChart + "-svg";
        $(svg)[0].setAttribute("style", "height: " + styleSize + " !important;");

        var top = "#" + myChart + "-top";
        $(top)[0].setAttribute("style", "height: " + styleSize + " !important;");

        var wrapper = "#" + myChart + "-wrapper";
        $(wrapper)[0].setAttribute("style", "height: " + styleSize + " !important;");

        var graph = "#" + myChart + "-graph-id0-c";
        $(graph)[0].setAttribute("style", "display: none;");
        $(graph).remove();
      }
    },
    width: '100%'
  });

}



function chartGauge2(myChart, range, scaleGraph, scaleR, valueCenter, backgroundColor, styleSize, x, y){

  ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
  let chartConfig = {
      globals: {
          color: '#666',
      },
      backgroundColor: 'transparent',
    // backgroundColor: 'transparent',
      graphset: [{
          type: 'gauge',
          width: '31.5%',
          height: '50%',
          x: '0px',
          y: '0px',

          // PLOT : EPAISSEUR + TAILLE DE LA FLECHE
          plot: {
              csize: '3%',
              size: '100%',
          },
          plotarea: {
              marginTop: '35%',
          },

          // TAILL DU GRAPHIQUE
          scale: {
              sizeFactor: scaleGraph, // taille du graphe
              // mediaRules: [{
              //     maxWidth: '650px',
              //     sizeFactor: 1.6,
              // }, ],
          },

          // ROND AVEC LA VALEUR DE LA FLECHE
          scaleR: {
              aperture: 130,
              values: scaleR, // donne de longueur du graphe de 0 à 40 avec un pas de 10
              center: {
                  borderColor: '#23211E',
                  borderWidth: '2px',
                  mediaRules: [{
                      // maxWidth: '650px',
                      // size: '10px',
                  }, ],
                  size: '15px',
              },
              guide: {
                  alpha: 1,
                  backgroundColor: '#E3DEDA',
              },
              item: {
                  offsetR: 0,
              },

              // REGLE COULEUR INTERIEUR DEMI CERCLE
              markers: [{
                  type: 'area',
                  alpha: 0.95,
                  backgroundColor: backgroundColor, // couleur de la zone
                  range: range, // zone coloriée mettre en valeur max la meme que celle de la fleche
              }, ],

              // REGLE DE GESTION DES COULEUR PAR STEP
              ring: {
                  // reprendre les rulesVolumes pour mettre des couleurs sur le cerle externe
                  backgroundColor: '#E3DEDA',
                  mediaRules: [{
                      maxWidth: '650px',
                      visible: true,
                  }, ],
              },
              tick: {
                  visible: false,
              },
          },
          tooltip: {
              visible: false,
          },


          // GESTION DE LA POSITION DU GRAPHIQUE TAILLE MAX ET MIN
          mediaRules: [{
                  maxWidth: '650px',
                  width: '100%',
                  height: '19%',
                  x: x,
                  y: y,
              },
              // {
              //     minWidth: '651px',
              //     width: '31.5%',
              //     height: '50%',
              //     x: '0px',
              //     y: '5%',
              // },
          ],

          // VALEUR PLACE AU CENTRE DE LA GAUGE
          series: [{
              values: [valueCenter], // valeur du pointeur
              valueBox: {
                  text: '%v',
                  fontColor: backgroundColor, // couleur du nombre dans le cercle
                  fontSize: '18px',
                  mediaRules: [{
                      fontSize: '10px',
                      maxWidth: '650px',
                  }, ],
                  placement: 'center',
              },
              backgroundColor: '#23211E',
          }, ],
      }],
  };
  // var myChart = "myChart";
  // var styleSize = "150px";
  zingchart.render({
      id: myChart,
      data: chartConfig,
      height: '100%',
      width: '100%',
      events: {
          load: function(p) {
              var svg = "#" + myChart + "-svg";
              $(svg)[0].setAttribute("style", "height: " + styleSize + " !important;");
              $(svg)[0].setAttribute("style", "backgroundColor: 'transparent';");

              var top = "#" + myChart + "-top";
              $(top)[0].setAttribute("style", "height: " + styleSize + " !important;");
              $(top)[0].setAttribute("style", "backgroundColor: 'transparent';");

              var wrapper = "#" + myChart + "-wrapper";
              $(wrapper)[0].setAttribute("style", "height: " + styleSize + " !important;");
              $(wrapper)[0].setAttribute("style", "backgroundColor: 'transparent';");

              var graph = "#" + myChart + "-graph-id0-c";
              $(graph)[0].setAttribute("style", "display: none;");
              $(graph)[0].setAttribute("style", "backgroundColor: 'transparent';");
              $(graph).remove();
          }
      },
  });

}