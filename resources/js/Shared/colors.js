const ALPHA_STOPS = ['0.9', '0.5', '0']

function getTransparentColorStops(color) {
  let stops = []
  for (let i = 0; i < ALPHA_STOPS.length; i++) {
    stops.push(color.replace(new RegExp(/__ALPHA__/), ALPHA_STOPS[i]))
  }
  return stops
}

export const CHART_COLORS = Object.freeze({
  '#05CBE1': getTransparentColorStops('rgba(0,231,255,__ALPHA__)'),
  '#e36a2b': getTransparentColorStops('rgba(255,155,96,__ALPHA__)'),
  '#ea5d5d': getTransparentColorStops('rgba(244,110,110,__ALPHA__)'),
  '#41B883': getTransparentColorStops('rgba(96,250,173,__ALPHA__)'),
})

export default {
  CHART_COLORS,
}
