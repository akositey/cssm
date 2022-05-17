const ALPHA_STOPS = ['0.9', '0.5', '0.1'];

function getTransparentColorStops(color) {
  let stops = [];
  for (let i = 0; i < ALPHA_STOPS.length; i++) {
    stops.push(color.replace(new RegExp(/1\)$/), ALPHA_STOPS[i]))
  }
  return stops;
}

export const CHART_COLORS = Object.freeze({
  "#05CBE1": getTransparentColorStops("rgba(0,231,255,1)"),
  "#e36a2b": getTransparentColorStops("rgba(255,155,96,1)"),
  "#41B883": getTransparentColorStops("rgba(96,250,173,1)"),
  "#ea5d5d": getTransparentColorStops("rgba(244,110,110,1)"),
});

export default {
  CHART_COLORS,
}
