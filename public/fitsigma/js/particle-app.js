/* -----------------------------------------------
/* How to use? : Check the GitHub README
/* ----------------------------------------------- */

/* To load a config file (particles.json) you need to host this demo (MAMP/WAMP/local)... */
/*
particlesJS.load('particles-js', 'particles.json', function() {
  console.log('particles.js loaded - callback');
});
*/

/* Otherwise just put the config content (json): */

particlesJS('particles-js',

  {
    particles: {
      number: {
        value: 80,
        density: {
          enable: !0,
          value_area: 800
        }
      },
      color: {
        value: "#ffffff"
      },
      shape: {
        type: "circle",
        stroke: {
          width: 0,
          color: "#000000"
        },
        polygon: {
          nb_sides: 5
        },
        image: {
          src: "img/github.svg",
          width: 100,
          height: 100
        }
      },
      opacity: {
        value: .5,
        random: !1,
        anim: {
          enable: !1,
          speed: 1,
          opacity_min: .1,
          sync: !1
        }
      },
      size: {
        value: 2,
        random: !0,
        anim: {
          enable: !1,
          speed: 30,
          size_min: .1,
          sync: !1
        }
      },
      line_linked: {
        enable: !0,
        distance: 135,
        color: "#ffffff",
        opacity: .15,
        width: 1
      },
      move: {
        enable: !0,
        speed: 2.5,
        direction: "none",
        random: !0,
        straight: !1,
        out_mode: "bounce",
        bounce: !1,
        attract: {
          enable: !1,
          rotateX: 600,
          rotateY: 1200
        }
      }
    },
    interactivity: {
      detect_on: "window",
      events: {
        onhover: {
          enable: !0,
          mode: "repulse"
        },
        onclick: {
          enable: !1,
          mode: "push"
        },
        resize: !0
      },
      modes: {
        grab: {
          distance: 400,
          line_linked: {
            opacity: 1
          }
        },
        bubble: {
          distance: 400,
          size: 40,
          duration: 2,
          opacity: 8,
          speed: 3
        },
        repulse: {
          distance: 200,
          duration: .4
        },
        push: {
          particles_nb: 4
        },
        remove: {
          particles_nb: 2
        }
      }
    },
    "retina_detect": true,
    "config_demo": {
      "hide_card": false,
      //"background_color": "#b61924",
      "background_image": "",
      "background_position": "50% 50%",
      "background_repeat": "no-repeat",
      "background_size": "cover"
    }
  }

);