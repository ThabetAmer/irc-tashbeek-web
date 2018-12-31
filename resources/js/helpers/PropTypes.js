export default {
  oneOf: (options) => (value) => {
    return options.indexOf(value) !== -1
  }
}